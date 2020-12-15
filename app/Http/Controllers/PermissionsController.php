<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Http\Resources\Permission as ResourcePermission;
use App\Permission;

use DataTables;
use Gate;
class PermissionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_unless(Gate::any(['full_access','permissions_show']), 404);

        $data['title'] = 'Permissions';
        return view('contents.permissions', $data);
    }

    //API
    public function all(){
        abort_unless(Gate::any(['full_access','permissions_show']), 404);

        $permissions = Permission::all();
        return DataTables::of(ResourcePermission::collection($permissions))->toJson();
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
        abort_unless(Gate::any(['full_access','permissions_create']), 404);

        $new_permission = Permission::create($request->only('title'));
        if($new_permission)
        return response()->json(array('success' => true, 'msg' => 'New permission created'));
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
        abort_unless(Gate::any(['full_access','permissions_edit']), 404);

        $permission = Permission::find($id);
        return response()->json($permission);
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
        abort_unless(Gate::any(['full_access','permissions_edit']), 404);

        $permission = Permission::where('id', $request->id)->update(['title' => $request->title]);
        if($permission)
        return response()->json(array('success' => true, 'msg' => 'Permission Updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        abort_unless(Gate::any(['full_access','permissions_delete']), 404);

        $destroy = Permission::find($id)->delete();
        if($destroy)
        return response()->json(array('success' => true, 'msg' => 'Permission Deleted'));
    }
}
