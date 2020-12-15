<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserStore as RequestUserStore;
use App\Http\Resources\User as ResourceUser;
use App\User;
use App\Role;
class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_unless(Gate::any(['full_access','users_show']), 404);

        $data['title'] = 'Users';
        $data['roles'] = Role::all();
        return view('contents.users',$data);
    }
    
    //API
    public function all(){
        abort_unless(Gate::any(['full_access','users_show']), 404);
        
        $users = User::all();
        return ResourceUser::collection($users);
    }

    public function mypermissions(){
        $myroles = auth()->user()->roles;
        foreach($myroles as $myrole){
            $roles = Role::where('id', $myrole->pivot->role_id)->with('permissions')->get();
            foreach($roles as $role){
                foreach($role->permissions as $permissions){
                    $permissionArray[] = $permissions->title;
                }
            }
        }
        
            
        return response()->json($permissionArray);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_unless(Gate::any(['full_access','users_create']), 404);

        $data['title'] = 'Create User';
        return view('contents.users_create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequestUserStore $request)
    {
        abort_unless(Gate::any(['full_access','users_create']), 404);

        $user = User::create($request->only(['username','name','email','password']));
        $user->roles()->sync($request->input('roles', []));
        if($user)
            return response()->json(array('success' => true, 'msg' => 'New user created'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $role)
    {
        abort_unless(Gate::any(['full_access','users_edit']), 404);

        $roles = Role::all()->pluck('title', 'id');
        $user->load('roles');

        return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        abort_unless(Gate::any(['full_access','users_edit']), 404);

        $user->update($request->all());
        $user->roles()->sync($request->input('roles', []));

        if($user)
            return response()->json(array('success' => true, 'msg' => 'User updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        abort_unless(Gate::any(['full_access','users_delete']), 404);

        $destroy = User::find($id)->delete();
        if($destroy)
        return response()->json(array('success' => true, 'msg' => 'User Deleted'));
    }
}
