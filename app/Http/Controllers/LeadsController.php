<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

use App\Http\Resources\Lead as ResourceLead;
use App\Http\Resources\LeadCompany as ResourceLeadCompany;
use App\Lead;
use App\File;
use App\User;
use MongoDB\BSON\ObjectID;
use DataTables;
use Gate;
class LeadsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        abort_unless(Gate::any(['full_access','leads_show']), 404);

        $data['title'] = 'Contacts Leads Data';

        return view('contents.leads', $data);
    }

    public function statsData(){
        $results = Lead::where('country', '!=', '')->raw(function($collection){
            return $collection->aggregate(array(
                array(
                    '$group' => array(
                        '_id' => array(
                            'country' => '$country'
                        ),
                        'total' => array('$sum' => 1)
                    )
                ),
                array('$sort' => array(
                    'country' => 1
                ))
            ));
        });

        $countries = array();
        $data = array();
        foreach($results as $result){
            array_push($countries, $result['_id']['country'] != "" ? $result['_id']['country'] : "No Country");
            array_push($data, $result['total'] > 1 ? $result['total'] : 0);
        }
        return [
            'countries' => $countries,
            'data' => $data
        ];
    }

    public function stats(){
        $data['title'] = 'Leads Statistics';
        $data['total_leads'] = Lead::count();
        return view('contents.leadstat', $data);
    }

    public function company(Request $request)
    {
        abort_unless(Gate::any(['full_access','leads_show']), 404);

        $data['title'] = 'Company Leads Data';

        return view('contents.leads-company', $data);
    }

    public function all(Request $request){
        abort_unless(Gate::any(['full_access','leads_show']), 404);

        $leadModel = new Lead;
        $columns = $request->columns;
        $lastId = $request->last_id;
        $limit = intval($request->input('length'));
        $start = intval($request->input('start'));
        $order = $columns[intval($request->input('order.0.column'))];
        $dir = $request->input('order.0.dir');
        switch($request->type){
            case 'contacts':
                $totalData = Lead::where('name','!=','')->count();
                $totalFiltered = $totalData; 
                if(empty($request->input('search.value')))
                {            
                    if($lastId == ''){
                        $leads = Lead::offset($start)
                                ->limit($limit)
                                ->where('name','!=',' ')
                                ->orderBy($order['data'],$dir)
                                ->get();
                    }else{
                        $leads = Lead::whereRaw([
                            '_id' => ['$gt' => new ObjectID($lastId)]
                        ])->where('name','!=',' ')->limit($limit)->orderBy($order['data'],$dir)->get();
                    }
                }else {
                    $search = $request->input('search.value'); 
                    
                    $leads = Lead::orderBy($order['data'],$dir);

                    foreach($columns as $index=>$column){
                        if($leadModel->isInFillable($column['data'])){
                            if($index == 0){
                                $leads = $leads->where($column['data'], 'LIKE', $search.'%');
                            }else{
                                $leads = $leads->orWhere($column['data'], 'LIKE', $search.'%');
                            }
                            
                        }
                    }

                    $leads = $leads->where('name','!=','');

                    $totalFiltered = $leads->get()->count();
                    $leads = $leads->limit($limit)->offset($start)->get();
                }


                $data = ResourceLead::collection($leads);
            break;
            case 'company': 
                $totalData = Lead::where('company', '!=', '')->count();
                $totalFiltered = $totalData; 
                if(empty($request->input('search.value')))
                {            
                    if($lastId == ''){
                        $leads = Lead::offset($start)
                                ->limit($limit)
                                ->where('company', '!=', '')
                                ->orderBy($order['data'],$dir)
                                ->get();
                    }else{
                        $leads = Lead::whereRaw([
                            '_id' => ['$gt' => new ObjectID($lastId)]
                        ])->where('company', '!=', '')->limit($limit)->orderBy($order['data'],$dir)->get();
                    }
                }else {
                    $search = $request->input('search.value'); 
                    
                    $leads = Lead::orderBy($order['data'],$dir);

                    foreach($columns as $index=>$column){
                        if($leadModel->isInFillable($column['data'])){
                            if($index == 0){
                                $leads = $leads->where($column['data'], 'LIKE', $search.'%');
                            }else{
                                $leads = $leads->orWhere($column['data'], 'LIKE', $search.'%');
                            }
                            
                        }
                    }

                    $leads->where('company', '!=', '');

                    $totalFiltered = $leads->get()->count();
                    $leads = $leads->limit($limit)->offset($start)->get();
                }

                
                $data = ResourceLeadCompany::collection($leads);
            break;
        }

        
        $json_data = array(
            "draw"            => intval($request->input('draw')),  
            "recordsTotal"    => intval($totalData),  
            "recordsFiltered" => intval($totalFiltered), 
            "data"            => $data   
        );

        return response()->json($json_data);
    }


    public function uploadcsv(Request $request){
        abort_unless(Gate::any(['full_access','leads_create']), 404);

        if($request->hasFile('csv')){
            if($request->file('csv')->isValid()){
                // Get csv file
                $file = $request->file('csv');
                
                // Make a image name based on user name and current timestamp
                $filename = Str::slug(auth()->user()->name).'_'.time();
                $extension = $file->getClientOriginalExtension();
                $fileSize = $file->getSize();

                $request->csv->storeAs('/public/files/csv', $filename.'.'.$extension);
                $url = Storage::url('files/csv/'.$filename.'.'.$extension);
            
                $newfile = File::create([
                    'user_id' => auth()->user()->id,
                    'name' => $filename,
                    'path' => $url,
                    'extension' => $extension,
                    'size' => $fileSize
                ]);

                if($newfile)
                    return response()->json(array('success' => true, 'file_id' => $newfile->id));
            }
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        abort_unless(Gate::any(['full_access','leads_delete']), 404);

        $user = User::find(auth()->user()->id);
        if(!\Hash::check($request->password, $user->password)){
            return response()->json(['success'=>false,'msg' => trans('passwords.invalid')]);
        }

        $lead = Lead::find($id);
        $lead->delete();

        if($lead){
            return response()->json(array('success' => true, 'msg' => 'Data has been deleted!'));
        }else{
            return response()->json(array('success' => false, 'msg' => 'We cant delete this Product, please try again!'));
        }
    }

    public function importBody($id){
        $file = File::find($id);
        $body = array();
        
        if($file->status != 'imported'){
            $filepath = storage_path('/app/public/files/csv/'.$file->name.'.'.$file->extension);
            $file = fopen($filepath,"r");

            $i = 0;
                
            while (($filedata = fgetcsv($file)) !== FALSE) {
                $num = count($filedata);
                
                // Skip first row (Remove below comment if you want to skip the first row)
                if($i == 0){
                    for ($c=0; $c < $num; $c++) {
                        $header[$c] = Str::slug($filedata[$c], '_');
                    }
                    $i++;
                    continue; 
                }

                for ($c=0; $c < $num; $c++) {
                    $body[$i][$header[$c]] = mb_convert_encoding($filedata[$c], 'UTF-8', 'UTF-8');
                }

                $i++;
            }

            fclose($file);
        }

        return response()->json($body);
    }
    public function import($id){
        $file = File::find($id);
        $leadModel = new Lead();
        $headerOptions = $leadModel->getFillable();
        $header = array();
        
        if($file->status != 'imported'){
            $filepath = storage_path('/app/public/files/csv/'.$file->name.'.'.$file->extension);
            $file = fopen($filepath,"r");

            $i = 0;
                
            while (($filedata = fgetcsv($file)) !== FALSE) {
                $num = count($filedata);
                // Skip first row (Remove below comment if you want to skip the first row)
                if($i == 0){
                    for ($c=0; $c < $num; $c++) {
                        $header[$c] = Str::slug($filedata[$c], '_');
                    }
                    $i++;
                    break;
                }
                $i++;
            }

            fclose($file);
        }

        $data['title'] = 'Leads Import';
        $data['header_options'] = $headerOptions;
        $data['header'] = $header;
        $data['file_id'] = $id;
        //return response()->json($data);
        return view('contents.leads-import', $data);
    }

    public function importData(Request $request){
        if(Lead::where('email',$request->email)->exists()){
            return response()->json(array('success' => false, 'msg' => 'Data email address already exists in the database!'));
        }else{
            $lead = Lead::create($request->except('_token'));
            return response()->json(array('success' => true, 'msg' => 'Data Imported Successfully'));
        }
        
    }
    public function exportcsv(){
        $fileName = 'leads.csv';
        $leads = Lead::all();

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('first_name','last_name','title','company_name','email','phone','website','address','city','state','country', 'linkedin','facebook','messenger','instagram','twitter','google_search','google_map','category');

        $callback = function() use($leads, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($leads as $lead) {
                $data['first_name']  = $lead->first_name;
                $data['last_name']    = $lead->last_name;
                $data['title']    = $lead->title;
                $data['company_name']  = $lead->company_name;
                $data['email']  = $lead->email;
                $data['phone']  = $lead->phone;
                $data['website']  = $lead->website;
                $data['address']  = $lead->address;
                $data['city']  = $lead->city;
                $data['state']  = $lead->state;
                $data['country']  = $lead->country;
                $data['linkedin']  = $lead->linkedin;
                $data['facebook']  = $lead->facebook;
                $data['messenger']  = $lead->messenger;
                $data['instagram']  = $lead->instagram;
                $data['twitter']  = $lead->twitter;
                $data['google_search']  = $lead->google_search;
                $data['google_map']  = $lead->google_map;
                $data['category']  = $lead->category;
                fputcsv($file, $data);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
    
    public function exportpdf(){
        // retreive all records from db
      $data = Lead::take(20)->get();

      // share data to view
      view()->share('leads',$data);
      $pdf = PDF::loadView('pdf.pdf-leads', $data);

      // download PDF file with download method
      return $pdf->download('pdf_file.pdf');
    }
}
