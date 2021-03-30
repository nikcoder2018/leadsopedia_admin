<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\RequestData;
use App\RequestDataSample;
use App\Http\Resources\SampleData as ResourceSampleData;
use App\Http\Resources\Lead as ResourceLead;
use App\Http\Resources\Filter as FilterResource;
use App\Http\Resources\FilterGroup as FilterGroupResource;

use App\Lead;
use App\FltrTitleGroup;
use App\FltrTitle;
use App\FltrIndustry;
use App\FltrIndustryCategory;
use App\FltrCountry;
use App\FltrRegion;
use App\FltrState;
use App\FltrCity;
use App\FltrStreet;

use DataTables;
use Gate;
use Download;

use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Excel as BaseExcel;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendSampleData;
class SampleDataRequestsController extends Controller
{
    public function index(){
        $data['title'] = 'Sample Data Requests';
        $data['requests'] = RequestData::all();

        return view('contents.datarequests', $data);
    }

    public function all(){
        abort_unless(Gate::any(['full_access','datarequests_show']), 404);
        
        $datarequests = RequestData::all();
        return DataTables::of(ResourceSampleData::collection($datarequests))->toJson();
    }

    public function details($id){
        $rd = RequestData::find($id);
        return response()->json($rd);
    }

    public function deny($id){
        $rd = RequestData::find($id);
        $rd->status = 'denied';
        $rd->save();
    }

    public function process($id){
        $data['rd'] = RequestData::where('id',$id)->with('samples')->first();
        $data['title'] = 'Process Request';

        return view('contents.datarequests-process', $data);
    }

    public function generate(Request $request){
        $filterInput = $request->except(['_token']);
        $rd = RequestData::find($request->request_id);
        $leads = Lead::select('id')->where(function($query) use ($filterInput){
            $query = $query->where(function($q){
                $q = $q->where('name', '!=', '');
                $q = $q->where('name', '!=', null);

                return $q;
            });
            $query = $query->where(function($q) use ($filterInput){
                foreach($filterInput as $key=>$value){
                    switch($key){
                        case 'keyword': 
                            if($value != ''){
                                $kwArray = explode(PHP_EOL, $value);
                                $q = $q->where(function($qq) use ($kwArray){
                                    $qq = $qq->whereRaw(['$text' => ['$search' => join(" ",$kwArray)]]);
                                    return $qq;
                                });
                            }
                        break;
        
                        case 'group': 
                            $q = $q->where(function($qq) use ($value){
                                foreach($value as $id){
                                    $group = FltrTitleGroup::find($id)->append('filtersName');
                                    $qq = $qq->whereIn('title', $group['filtersName']);
                                }

                                return $qq;
                            });
                        break;
        
                        case 'industry':
                            
                            $q = $q->where(function($qq) use ($value){
                                foreach($value as $industry){
                                    $qq = $qq->orWhere('industry', $industry); 
                                }

                                return $qq;
                            });
                            
                        break;
        
                        case 'industry_category': 
                            $q = $q->where(function($qq) use ($value){
                                foreach($value as $id){
                                    $category = FltrIndustryCategory::find($id)->append('filtersName');
                                    $qq = $qq->whereIn('industry', $category['filtersName']);
                                }

                                return $qq;
                            });
                            
                        break; 
                    }
                }

                $q = $q->where(function($q1) use ($filterInput){
                    foreach($filterInput as $key=>$value){
                        switch($key){
                            case 'country': 
                                $q = $q1->orWhere(function($qq) use ($value){
                                    foreach($value as $country){
                                        $qq = $qq->orWhere('country', $country);
                                    }
    
                                    return $qq;
                                });
                            break;
            
                            case 'region': 
                                $q = $q1->orWhere(function($qq) use ($value){
                                    foreach($value as $region){
                                        $qq = $qq->orWhere('region', $region);
                                    }
    
                                    return $qq;
                                });
                                
                            break;
            
                            case 'state': 
                                $q = $q1->orWhere(function($qq) use ($value){
                                    foreach($value as $state){
                                        $qq = $qq->orWhere('state', $state);
                                    }
    
                                    return $qq;
                                });
                                
                            break;
            
                            case 'city': 
                                $q = $q1->orWhere(function($qq) use ($value){
                                    foreach($value as $city){
                                        $qq = $qq->orWhere('city', $city);
                                    }
    
                                    return $qq;
                                });
                            break;
            
                            case 'street': 
                                $q = $q1->orWhere(function($qq) use ($value){
                                    foreach($value as $street){
                                        $qq = $qq->orWhere('street', $street);
                                    }
    
                                    return $qq;
                                });
                            break;
                        }
                    }

                    return $q1;
                });
                
                return $q;
            });
            
        })->take(10)->get();
        
        $leads_ids = array();

        if(isset($leads[0])){
            $leads_ids = array_map(function($data){
                return $data['_id'];
            },$leads->toArray());
        }else{
            return response()->json(array('success' => false, 'msg' => 'No results found, try change your filter!'));
        }

        $rds = RequestDataSample::create([
            'request_data_id' => $rd->id,
            'data' => json_encode($leads_ids)
        ]);

        if($rds){
            return response()->json([
                'success' => true,
                'msg' => 'Sample Data Successfully Generated.',
                'sample_id' => $rds->id
            ]);
        }
    }

    public function previewData($sample_id){
        $rds = RequestDataSample::find($sample_id);
        $leads = Lead::whereIn('_id',json_decode($rds->data))->get();
        return DataTables::of(ResourceLead::collection($leads))->toJson();
    }
    public function preview($sample_id){
        $data['title'] = 'Sample Data Preview';
        $data['sample_data_id'] = $sample_id;
        return view('contents.datarequests-preview', $data);
    }

    public function send(Request $request){
        $rd = RequestData::find($request->request_id);
        $rds = RequestDataSample::find($request->sample_id);
        $leads = Lead::whereIn('_id',json_decode($rds->data))->get();
        $header = ['name','title','company','email','phone','industry','website','street','city','state','region','country', 'linkedin','facebook','messenger','instagram','twitter','google_search','google_map'];
        $filename = 'Leadsopedia Sample Data '.date('d-m-Y').'.csv';
        $download = new Download($filename, $header, $leads);
        $result = $download->csv();
        $attachment = Excel::raw($result->callback, BaseExcel::CSV);
 
        Mail::to($rd->email)->queue(new SendSampleData('emails.sample-data', [
            'subject' => 'Leadsopedia - Sample Date Request',
            'message' => $request->message,
        ],$attachment, $filename));

        $rds->sent = 1;
        $rds->save();

        return response()->json([
            'success' => true,
            'msg' => 'Sample Successfully Sent'
        ]);
    }

    public function deleteSample($sample_id){
        $rds = RequestDataSample::find($sample_id);
        $rds->delete();

        if($rds)
            return response()->json([
                'success' => true,
                'msg' => 'Sample Successfully Deleted.'
            ]);
    }
    public function filters(Request $request, $filter){
        switch($filter){
            case 'title_group': 
                $group = FltrTitleGroup::orderBy('name','ASC')->get();
                return response()->json(array('results' => FilterGroupResource::collection($group)));
            break;
            case 'industry': 
                $industry = FltrIndustry::where('name', 'like', '%'.$request->search)->orderBy('name','ASC')->take(100)->get();
                return response()->json(array('results' => FilterResource::collection($industry)));
            break;
            case 'industry_category': 
                $category = FltrIndustryCategory::orderBy('name','ASC')->get();
                return response()->json(array('results' => FilterGroupResource::collection($category)));
            break;
            case 'country': 
                $country = FltrCountry::where('name', 'like', '%'.$request->search)->orderBy('name','ASC')->get();
                return response()->json(array('results' => FilterResource::collection($country)));
            break;
            case 'region': 
                $region = FltrRegion::where('name', 'like', '%'.$request->search)->orderBy('name','ASC')->get();
                return response()->json(array('results' => FilterResource::collection($region)));
            break;
            case 'state': 
                $state = FltrState::where('name', 'like', '%'.$request->search)->orderBy('name','ASC')->get();
                return response()->json(array('results' => FilterResource::collection($state)));
            break;
            case 'city': 
                $city = FltrCity::where('name', 'like', '%'.$request->search)->orderBy('name','ASC')->get();
                return response()->json(array('results' => FilterResource::collection($city)));
            break;
            case 'street': 
                $street = FltrStreet::where('name', 'like', '%'.$request->search)->orderBy('name','ASC')->get();
                return response()->json(array('results' => FilterResource::collection($street)));
            break;
        }
        
    }
}
