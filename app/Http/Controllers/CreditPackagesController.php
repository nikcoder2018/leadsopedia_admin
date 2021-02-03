<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CreditPackage;

use DataTables;
class CreditPackagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function all()
    {
        $packages = CreditPackage::all();
        return DataTables::of($packages)->toJson();
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
            'credits' => 'required',
            'price' => 'required'
        ]);

        $create = CreditPackage::create([
            'credits' => $validated['credits'],
            'price' => $validated['price']
        ]);

        if($create)
            return response()->json(array('success' => true, 'msg' => 'Package Created.'));
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
        $cp = CreditPackage::find($id);
        return response()->json($cp);
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
            'credits' => 'required',
            'price' => 'required'
        ]);

        $cp = CreditPackage::find($request->id);
        $cp->credits = $validated['credits'];
        $cp->price = $validated['price'];
        $cp->save();

        if($cp)
            return response()->json(array('success' => true, 'msg' => 'Package Upadated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = CreditPackage::find($id)->delete();
        if($delete)
            return response()->json(array('success' => true, 'Package Deleted', 'id' => $id));
    }
}
