<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FltrRegion;
use App\Lead;

use DataTables;

class FilterRegionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title'] = 'Filters';
        return view('contents.filters-region', $data);
    }

    public function data(Request $request){
        switch($request->type){
            case 'new': 
                $totalData = Lead::select('region')->groupBy('region')->count();
                $totalFiltered = $totalData; 
                $current = FltrRegion::select('name')->get()->map(function($filter){ return $filter['name']; });
                $columns = $request->columns;
                $limit = intval($request->input('length'));
                $start = intval($request->input('start'));
                $order = $columns[intval($request->input('order.0.column'))];
                $dir = $request->input('order.0.dir');

                $search = $request->input('search.value');
                $new = Lead::select('country','region')
                                ->offset($start)
                                ->limit($limit)
                                ->where('region', '!=', '')
                                ->whereNotIn('region', $current);

                if(!empty($request->input('search.value'))){ 
                    $new = $new->where('region', 'LIKE', $search.'%');
                }

                $new = $new->groupBy('region')->orderBy('region',$dir)->get();

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
                $current = FltrRegion::select('name')
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
        $filter = FltrRegion::where('name',$request->name)->update(['name' => $request->name],['upsert' => true]);

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
    public function edit(Request $request)
    {
        switch($request->type){
            case 'new': 
                $region = Lead::select('region')->where('region', $request->name)->first();
                return response()->json($region);
            break;
            case 'current': 
                $filter = FltrRegion::find($request->id);
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
                $leads = Lead::where('region', $request->oldname)->update(['region'=>$request->name]);
                $filter = FltrRegion::where('name',$request->name)->update(['name' => $request->name],['upsert' => true]);

                if($leads && $filter)
                    return response()->json(array('success' => true, 'msg' => 'Region Updated'));
            break;
            case 'current': 
                $fltrRegion = FltrRegion::find($request->id);
                $fltrRegion->name = $request->name;
                $fltrRegion->save();

                if($fltrRegion)
                    return response()->json(array('success' => true, 'msg' => 'Region Filter Updated'));
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
        $delete = FltrRegion::find($id)->delete();
        if($delete)
            return response()->json(array('success' => true, 'msg' => 'Filter Deleted'));
    }
}
