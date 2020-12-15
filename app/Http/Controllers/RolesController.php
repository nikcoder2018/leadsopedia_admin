<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Http\Resources\Role as ResourceRole;

use App\Role;
use App\Permission;

use DataTables;
use Gate;
class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_unless(Gate::any(['full_access','roles_show']), 404);

        $data['title'] = 'Roles';
        $data['permissions'] = Permission::all();
        return view('contents.roles', $data);
    }

    //API
    public function all(){
        abort_unless(Gate::any(['full_access','roles_show']), 404);
        
        $roles = Role::all();
        return DataTables::of(ResourceRole::collection($roles))->toJson();
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
        abort_unless(Gate::any(['full_access','roles_create']), 404);

        $role = Role::create($request->only('title'));
        $role->permissions()->sync($request->input('permissions', []));

        if($role)
        return response()->json(array('success' => true, 'msg' => 'New role created'));
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
    public function edit(Role $role)
    {
        abort_unless(Gate::any(['full_access','roles_edit']), 404);

        $permissions = Permission::all()->pluck('title', 'id');
        $role->load('permissions');

        return response()->json($role);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        abort_unless(Gate::any(['full_access','roles_edit']), 404);

        $role = Role::find($id);
        $role->title = $request->title;
        $role->save();
        $role->permissions()->sync($request->input('permissions', []));
            
        if($role)
            return response()->json(array('success' => true, 'msg' => 'Role Updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        abort_unless(Gate::any(['full_access','roles_delete']), 404);

        $destroy = Role::find($id)->delete();
        if($destroy)
        return response()->json(array('success' => true, 'msg' => 'Role Deleted'));
    }
}
