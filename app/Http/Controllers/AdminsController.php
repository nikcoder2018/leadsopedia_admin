<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use App\Http\Requests\StoreAdmin as StoreAdminRequest;
use App\Http\Requests\UpdateAdmin as UpdateAdminRequest;

use App\Http\Resources\Admin as ResourceAdmin;
use App\User;
use App\Role;
use App\RoleUser;

use DataTables;

class AdminsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title'] = 'Users';
        $data['roles'] = Role::all();
        return view('contents.users',$data);
    }

    public function all(){ //API
        $admins = User::all();
        return DataTables::of(ResourceAdmin::collection($admins))->toJson();
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Str::random(80)
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAdminRequest $request)
    {
        $validated = $request->validated();
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'status' => 1,
            'api_token' => Str::uuid()
        ]);

        $user->roles()->sync($request->input('roles', []));
        
        if($user)
            return response()->json(array('success' => true, 'msg' => 'New user created'));
    }

    public function changePassword(Request $request){
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);
   
        User::find($request->id)->update(['password'=> Hash::make($request->new_password)]);

        return response()->json(array('success' => true,'msg' => 'Password successfully changed.'));
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['title'] = 'User Details';
        $data['user'] = User::find($id);
        return view('contents.users_view', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $user = User::find($request->id);
        return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAdminRequest $request)
    {
        $validated = $request->validated();

        $user = User::find($request->id);
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->save();

        if($user)
            return response()->json(array('success' => true, 'msg' => 'User successfully updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $destroy = User::find($id)->delete();
        if($destroy)
        return response()->json(array('success' => true, 'msg' => 'User Deleted'));
    }
}
