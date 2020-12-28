<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\FltrIndustryCategory;

use DataTables;
class FilterIndustryCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title'] = 'Industry Category';
        return view('contents.filters-industry-category', $data);
    }

    public function data(Request $request){
        $columns = $request->columns;
        $limit = intval($request->input('length'));
        $start = intval($request->input('start'));
        $order = $columns[intval($request->input('order.0.column'))];
        $dir = $request->input('order.0.dir');
        $current = FltrIndustryCategory::select('name')
                        ->offset($start)
                        ->limit($limit)
                        ->orderBy('name',$dir)
                        ->get();

        return DataTables::of($current)->toJson();
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

    public function addindustry(Request $request){
        $category = FltrIndustryCategory::find($request->category_id);
        $category->push('filters', $request->id, true);

        if($category)
                return response()->json(array('success' => true, 'msg' => 'Filter Added to Category Selected'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!FltrIndustryCategory::where(['name' => $request->name])->exists()){
            $category = FltrIndustryCategory::create(['name' => $request->name]);
            if($category)
                return response()->json(array('success' => true, 'msg' => 'Category Created'));
        }else{
            return response()->json(array('success' => false, 'msg' => 'Category Exists'));
        }
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
        $category = FltrIndustryCategory::find($id);
        return response()->json($category);
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
        $category = FltrIndustryCategory::find($request->id);
        $category->name = $request->name;
        $category->save();

        if($category)
            return response()->json(array('success' => true, 'msg' => 'Category Updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = FltrIndustryCategory::find($id)->delete();
        if($delete)
            return response()->json(array('success' => true, 'msg' => 'Category Deleted'));
    }
}
