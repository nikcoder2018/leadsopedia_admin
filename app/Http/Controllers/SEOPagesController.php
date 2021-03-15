<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SEOPage;

use DataTables;
class SEOPagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function all()
    {
        $all = SEOPage::all();
        return DataTables::of($all)->toJson();
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
        $validated = $request->validate([
            'path' => 'required|string',
            'title' => 'required|string',
            'description' => 'required|string',
            'keywords' => 'required|string'
        ]);

        $new = SEOPage::create([
            'path' => $validated['path'],
            'title' => $validated['title'],
            'description' => $validated['description'],
            'keywords' => $validated['keywords']
        ]);

        if($new)
        return response()->json(array('success' => true, 'msg' => 'SEO Page Settings Added Successfully.'));
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
        $seo = SEOPage::find($id);
        return response()->json($seo);
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
        $validated = $request->validate([
            'path' => 'required|string',
            'title' => 'required|string',
            'description' => 'required|string',
            'keywords' => 'required|string'
        ]);

        $updated = SEOPage::find($request->id);
        $updated->path = $validated['path'];
        $updated->title = $validated['title'];
        $updated->description = $validated['description'];
        $updated->keywords = $validated['keywords'];
        $updated->save();

        if($updated)
            return response()->json(array('success' => true, 'msg' => 'SEO Page Settings Updated Successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = SEOPage::find($id)->delete();
        if ($delete)
            return response()->json(array('success' => true, 'msg' => 'SEO Page Setting Deleted.', 'id' => $id));
    }
}
