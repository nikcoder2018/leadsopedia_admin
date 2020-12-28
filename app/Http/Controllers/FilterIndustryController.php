<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\FltrIndustry;
use App\FltrIndustryCategory;
use App\Lead;

use DataTables;
class FilterIndustryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title'] = 'Filters';
        $data['categories'] = FltrIndustryCategory::all();
        return view('contents.filters-industry', $data);
    }

    public function data(Request $request){
        switch($request->type){
            case 'new': 
                $totalData = Lead::select('industry')->groupBy('industry')->get()->count();
                $totalFiltered = $totalData; 
                $current = FltrIndustry::select('name')->get()->map(function($filter){ return $filter['name']; });
                $columns = $request->columns;
                $limit = intval($request->input('length'));
                $start = intval($request->input('start'));
                $order = $columns[intval($request->input('order.0.column'))];
                $dir = $request->input('order.0.dir');

                $search = $request->input('search.value');
                $new = Lead::select('industry')
                                ->offset($start)
                                ->limit($limit)
                                ->whereNotIn('industry', $current);

                if(!empty($request->input('search.value'))){ 
                    $new = $new->where('industry', 'LIKE', $search.'%');
                }

                $new = $new->groupBy('industry')->orderBy('industry',$dir)->get();

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
                $current = FltrIndustry::select('name')
                                ->offset($start)
                                ->limit($limit)
                                ->orderBy('name',$dir)
                                ->get();

                return DataTables::of($current)->toJson();
            break;
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
        $filter = FltrIndustry::create(['name' => $request->name]);

        if($filter)
            return response()->json(array('success' => true, 'msg' => 'New Filter Added'));
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
    public function edit(Request $request, $id)
    {
        switch($request->type){
            case 'new': 
                $title = Lead::select('title')->where('title', $name)->first();
                return response()->json($title);
            break;
            case 'current': 
                $filter = FltrIndustry::find($id);
                return response()->json($filter);
            break;
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        switch($request->type){
            case 'new': 
                $leads = Lead::where('title', $request->name);
                $leads->title = $request->name;
                $leads->save();

                if($leads)
                    return response()->json(array('success' => true, 'msg' => 'Industry Updated'));
            break;
            case 'current': 
                $fltrIndustry = FltrIndustry::find($request->id);
                $fltrIndustry->name = $request->name;
                $fltrIndustry->save();

                if($fltrIndustry)
                    return response()->json(array('success' => true, 'msg' => 'Industry Filter Updated'));
            break;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = FltrIndustry::find($id)->delete();
        if($delete)
            return response()->json(array('success' => true, 'msg' => 'Filter Deleted'));
    }
}
