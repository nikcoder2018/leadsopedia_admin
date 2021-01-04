<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\FltrTitle;
use App\FltrTitleGroup;
use App\FltrCountry;
use App\FltrRegion;
use App\FltrState;
use App\FltrCity;
use App\FltrStreet;
use App\Lead;

use DataTables;
class FiltersController extends Controller
{
    public function fltrTitleIndex(){
        // $data['old'] = FltrTitle::select('name')->get()->map(function($filter){
        //     return $filter['name'];
        // });
        // $data['new'] = Lead::select('title')->whereNotIn('title', $data['old'])->groupBy('title')->get()->count();
        $data['title'] = 'Filters';
        $data['groups'] = FltrTitleGroup::all();
        return view('contents.filters-title', $data);
    }
    public function fltrTitleData(Request $request){
        switch($request->type){
            case 'new': 
                $totalData = Lead::select('title')->groupBy('title')->count();
                $totalFiltered = $totalData; 
                $current = FltrTitle::select('name')->get()->map(function($filter){ return $filter['name']; });
                $columns = $request->columns;
                $limit = intval($request->input('length'));
                $start = intval($request->input('start'));
                $order = $columns[intval($request->input('order.0.column'))];
                $dir = $request->input('order.0.dir');
                
                $search = $request->input('search.value');
                $new = Lead::select('title')
                                ->offset($start)
                                ->limit($limit)
                                ->whereNotIn('title', $current);

                if(!empty($request->input('search.value'))){ 
                    $new = $new->where('title', 'LIKE', $search.'%');
                }

                $new = $new->groupBy('title')->orderBy('title',$dir)->get();

                $json_data = array(
                    "draw"            => intval($request->input('draw')),  
                    "recordsTotal"    => intval($totalData),  
                    "recordsFiltered" => intval($totalFiltered), 
                    "data"            => $new
                );
                        
                return response()->json($json_data);
            break;
            case 'current': 
                $columns = $request->columns;
                $limit = intval($request->input('length'));
                $start = intval($request->input('start'));
                $order = $columns[intval($request->input('order.0.column'))];
                $dir = $request->input('order.0.dir');
                $current = FltrTitle::select('name')
                                ->offset($start)
                                ->limit($limit)
                                ->orderBy('name',$dir)
                                ->get();

                return DataTables::of($current)->toJson();
            break;
        }
    }

    public function fltrTitleAdd(Request $request){

        $filter = FltrTitle::where('name', $request->name)->update(['name' => $request->name], ['upsert' => true]);

        if($filter)
            return response()->json(array('success' => true, 'msg' => 'New Filter Added'));
    }
    public function fltrTitleEdit(Request $request){
        switch($request->type){
            case 'new': 
                $title = Lead::select('title')->where('title', $request->name)->first();
                return response()->json($title);
            break;
            case 'current': 
                $filter = FltrTitle::find($request->id);
                return response()->json($filter);
            break;
        }
    }
    public function fltrTitleUpdate(Request $request){
        switch($request->type){
            case 'new': 
                $leads = Lead::where('title', $request->oldname)->update(['title'=>$request->name]);
                $filter = FltrTitle::where('name', $request->name)->update(['name' => $request->name], ['upsert' => true]);
                if($leads && $filter)
                    return response()->json(array('success' => true, 'msg' => 'Title Updated'));
            break;
            case 'current': 
                $fltrTitle = FltrTitle::find($request->id);
                $fltrTitle->name = $request->name;
                $fltrTitle->save();

                if($fltrTitle)
                    return response()->json(array('success' => true, 'msg' => 'Title Filter Updated'));
            break;
        }
    }
    public function fltrTitleDelete($id){
        $delete = FltrTitle::find($id)->delete();
        if($delete)
            return response()->json(array('success' => true, 'msg' => 'Filter Deleted'));
    }
    public function fltrTitleGroupIndex(){
        $data['title'] = 'Filters Group';
        return view('contents.filters-title-groups', $data);
    }

    public function fltrTitleGroupData(Request $request){
        $columns = $request->columns;
        $limit = intval($request->input('length'));
        $start = intval($request->input('start'));
        $order = $columns[intval($request->input('order.0.column'))];
        $dir = $request->input('order.0.dir');
        $current = FltrTitleGroup::select('name')
                        ->offset($start)
                        ->limit($limit)
                        ->orderBy('name',$dir)
                        ->get();

        return DataTables::of($current)->toJson();
    }

    public function fltrTitleGroupStore(Request $request){
        if(!FltrTitleGroup::where(['name' => $request->name])->exists()){
            $group = FltrTitleGroup::create(['name' => $request->name]);
            if($group)
                return response()->json(array('success' => true, 'msg' => 'Group Created'));
        }else{
            return response()->json(array('success' => false, 'msg' => 'Group Exists'));
        }
        
    }
    public function fltrTitleGroupAddFilter(Request $request){
        $group = FltrTitleGroup::find($request->group_id);
        $group->push('filters', $request->id, true);

        if($group)
                return response()->json(array('success' => true, 'msg' => 'Filter Added to Group Selected'));
        
    }
    public function fltrTitleGroupEdit(Request $request, $id){
        $group = FltrTitleGroup::find($id);
        return response()->json($group);
    }
    public function fltrTitleGroupUpdate(Request $request){
        $group = FltrTitleGroup::find($request->id);
        $group->name = $request->name;
        $group->save();

        if($group)
            return response()->json(array('success' => true, 'msg' => 'Group Updated'));
    }
    public function fltrTitleGroupDelete($id){
        $delete = FltrTitleGroup::find($id)->delete();
        if($delete)
            return response()->json(array('success' => true, 'msg' => 'Group Deleted'));
    }

    public function fltrIndustryIndex(){
        
    }

    public function fltrLocationIndex(){
        
    }
    public function fltrLocationEdit(){

    }
    public function fltrLocationUpdate(){
        
    }
}
