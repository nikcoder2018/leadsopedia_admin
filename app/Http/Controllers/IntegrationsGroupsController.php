<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\IntegrationGroup;
use DataTables;
class IntegrationsGroupsController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function all(){
        $groups = IntegrationGroup::all();
        return DataTables::of($groups);
    }

    public function store(Request $request)
    {
        $group = IntegrationGroup::create([
            'name' => $request->name
        ]);

        if($group)
            return response()->json(array('success' => true, 'msg' => 'Integration Group Created.', 'group' => $group));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $group = IntegrationGroup::find($request->id);
        return response()->json($group);
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
        $group = IntegrationGroup::find($request->id);
        $group->name = $request->name;
        $group->save();

        if($group)
            return response()->json(array('success' => true, 'msg' => 'Integration Group Updated.', 'group' => $group));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $delete = IntegrationGroup::find($request->id)->delete();
        if($delete) 
            return response()->json(array('success' => true, 'msg' => 'Integration Group Deleted.', 'id' => $request->id));
    }
}
