<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Resources\Customer as ResourceCustomer;
use App\Customer;
use App\User;

use DataTables;
use Gate;
class CustomersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_unless(Gate::any(['full_access','customers_show']), 404);

        $data['title'] = 'Customers';
        return view('contents.customers', $data);
    }

    public function all(){
        abort_unless(Gate::any(['full_access','customers_show']), 404);
        $customers = Customer::all();

        return DataTables::of(ResourceCustomer::collection($customers))->toJson();
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
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        abort_unless(Gate::any(['full_access','customers_delete']), 404);

        $user = User::find(auth()->user()->id);
        if(!\Hash::check($request->password, $user->password)){
            return response()->json(['success'=>false,'msg' => trans('passwords.invalid')]);
        }

        Customer::find($id)->delete();

        return response()->json(['success'=>true,'msg' => trans('customers.deleted')]);
    }

    /**
     * Deactivate customer.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deactivate(Request $request, $id)
    {
        abort_unless(Gate::any(['full_access','customers_changestatus']), 404);

        $user = User::find(auth()->user()->id);
        if(!\Hash::check($request->password, $user->password)){
            return response()->json(['success'=>false,'msg' => trans('passwords.invalid')]);
        }

        $customer = Customer::find($id);
        $customer->status = '0';
        $customer->save();

        return response()->json(['success'=>true,'msg' => trans('customers.deactivated')]);
    }

    public function activate(Request $request, $id)
    {
        abort_unless(Gate::any(['full_access','customers_changestatus']), 404);

        $user = User::find(auth()->user()->id);
        if(!\Hash::check($request->password, $user->password)){
            return response()->json(['success'=>false,'msg' => trans('passwords.invalid')]);
        }

        $customer = Customer::find($id);
        $customer->status = '1';
        $customer->save();

        return response()->json(['success'=>true,'msg' => trans('customers.activated')]);
    }
}
