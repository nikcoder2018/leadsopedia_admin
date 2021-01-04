<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FltrCountry;
use App\Lead;

use DataTables;
class FilterCountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title'] = 'Filters';
        return view('contents.filters-country', $data);
    }

    public function data(Request $request){
        switch($request->type){
            case 'new': 
                $totalData = Lead::select('country')->groupBy('country')->get()->count();
                $totalFiltered = $totalData; 
                $current = FltrCountry::select('name')->get()->map(function($filter){ return $filter['name']; });
                $columns = $request->columns;
                $limit = intval($request->input('length'));
                $start = intval($request->input('start'));
                $order = $columns[intval($request->input('order.0.column'))];
                $dir = $request->input('order.0.dir');

                $search = $request->input('search.value');
                $new = Lead::select('country')
                                ->offset($start)
                                ->limit($limit)
                                ->where('country', '!=', '')
                                ->whereNotIn('country', $current);

                if(!empty($request->input('search.value'))){ 
                    $new = $new->where('country', 'LIKE', $search.'%');
                }

                $new = $new->groupBy('country')->orderBy('country',$dir)->get();

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
                $current = FltrCountry::select('name')
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
        $filter = FltrCountry::where('name', $request->name)->update(['name' => $request->name], ['upsert' => true]);

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
                $country = Lead::select('country')->where('country', $request->name)->first();
                return response()->json($country);
            break;
            case 'current': 
                $filter = FltrCountry::find($request->id);
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
                $leads = Lead::where('country', $request->oldname)->update(['country' => $request->name]);
                $filter = FltrCountry::where('name', $request->name)->update(['name' => $request->name], ['upsert' => true]);

                if($leads && $filter)
                    return response()->json(array('success' => true, 'msg' => 'Country Updated'));
            break;
            case 'current': 
                $fltrCountry = FltrCountry::find($request->id);
                $fltrCountry->name = $request->name;
                $fltrCountry->save();

                if($fltrCountry)
                    return response()->json(array('success' => true, 'msg' => 'Country Filter Updated'));
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
        $delete = FltrCountry::find($id)->delete();
        if($delete)
            return response()->json(array('success' => true, 'msg' => 'Filter Deleted'));
    }
}
