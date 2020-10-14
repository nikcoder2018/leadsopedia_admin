<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lead;
use PDF;
class LeadsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['allLeads'] = Lead::all();
   
        return view('contents.leads', $data);
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
    public function destroy(Request $request)
    {
        $lead = Lead::find($request->id);
        $lead->delete();

        if($lead){
            return response()->json(array('success' => true, 'msg' => 'Data has been deleted!'));
        }else{
            return response()->json(array('success' => false, 'msg' => 'We cant delete this Product, please try again!'));
        }
    }

    public function import(){

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
