<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FltrCity;
use App\Lead;

use DataTables;
class FilterCityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title'] = 'Filters';
        return view('contents.filters-city', $data);
    }

    public function data(Request $request){
        switch($request->type){
            case 'new': 
                $totalData = Lead::select('city')->groupBy('city')->get()->count();
                $totalFiltered = $totalData; 
                $current = FltrCity::select('name')->get()->map(function($filter){ return $filter['name']; });
                $columns = $request->columns;
                $limit = intval($request->input('length'));
                $start = intval($request->input('start'));
                $order = $columns[intval($request->input('order.0.column'))];
                $dir = $request->input('order.0.dir');

                $search = $request->input('search.value');
                $new = Lead::select('city')
                                ->offset($start)
                                ->limit($limit)
                                ->whereNotIn('city', $current);

                if(!empty($request->input('search.value'))){ 
                    $new = $new->where('city', 'LIKE', $search.'%');
                }

                $new = $new->groupBy('city')->orderBy('city',$dir)->get();

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
                $current = FltrCity::select('name')
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
        $filter = FltrCity::create(['name' => $request->name]);

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
                $city = Lead::select('city')->where('city', $name)->first();
                return response()->json($city);
            break;
            case 'current': 
                $filter = FltrCity::find($id);
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
                $leads = Lead::where('city', $request->city);
                $leads->city = $request->name;
                $leads->save();

                if($leads)
                    return response()->json(array('success' => true, 'msg' => 'City Updated'));
            break;
            case 'current': 
                $fltrCity = FltrCity::find($request->id);
                $fltrCity->name = $request->name;
                $fltrCity->save();

                if($fltrCity)
                    return response()->json(array('success' => true, 'msg' => 'City Filter Updated'));
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
        $delete = FltrCity::find($id)->delete();
        if($delete)
            return response()->json(array('success' => true, 'msg' => 'Filter Deleted'));
    }
}
