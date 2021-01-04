<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FltrStreet;
use App\Lead;

use DataTables;
class FilterStreetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title'] = 'Filters';
        return view('contents.filters-street', $data);
    }

    public function data(Request $request){
        switch($request->type){
            case 'new': 
                $totalData = Lead::select('street')->groupBy('street')->count();
                $totalFiltered = $totalData; 
                $current = FltrStreet::select('name')->get()->map(function($filter){ return $filter['name']; });
                $columns = $request->columns;
                $limit = intval($request->input('length'));
                $start = intval($request->input('start'));
                $order = $columns[intval($request->input('order.0.column'))];
                $dir = $request->input('order.0.dir');

                $search = $request->input('search.value');
                $new = Lead::select('street')
                                ->offset($start)
                                ->limit($limit)
                                ->where('street', '!=', '')
                                ->whereNotIn('street', $current)->groupBy('street')->orderBy('street',$dir);
                                return response()->json($new->get());               
                exit;
                if(!empty($request->input('search.value'))){ 
                    $new = $new->where('street', 'LIKE', $search.'%');
                }

                $new = $new->groupBy('street')->orderBy('street',$dir)->get();

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
                $current = FltrStreet::select('name')
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
        $filter = FltrStreet::create(['name' => $request->name]);

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
                $title = Lead::select('street')->where('street', $name)->first();
                return response()->json($title);
            break;
            case 'current': 
                $filter = FltrStreet::find($id);
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
                $leads = Lead::where('street', $request->oldname)->update(['street' => $request->name]);

                if($leads)
                    return response()->json(array('success' => true, 'msg' => 'Street Updated'));
            break;
            case 'current': 
                $fltrStreet = FltrStreet::find($request->id);
                $fltrStreet->name = $request->name;
                $fltrStreet->save();

                if($fltrStreet)
                    return response()->json(array('success' => true, 'msg' => 'Street Filter Updated'));
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
        $delete = FltrStreet::find($id)->delete();
        if($delete)
            return response()->json(array('success' => true, 'msg' => 'Filter Deleted'));
    }
}
