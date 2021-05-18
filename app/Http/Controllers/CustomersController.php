<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreUser as StoreUserRequest;
use App\Http\Requests\UpdateUser as UpdateUserRequest;

use App\Http\Resources\Customer as ResourceCustomer;
use App\Customer;
use App\User;
use App\Result;
use App\Subscription;
use Carbon\Carbon;

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
        $customers = Customer::all()->append('referrals')->append('countReferrals');

        //return response()->json($customers);
        return DataTables::of(ResourceCustomer::collection($customers))->toJson();
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = 'Create Customer Account';
        $data['subscription_plans'] = Subscription::all();
        return view('contents.customers-create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        $customer = Customer::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'company' => $request->company,
            'name' => $request->name,
            'birthday' => $request->birthday,
            'mobile' => $request->mobile,
            'gender' => $request->gender, 
            'address' => $request->address,
            'social_twitter' => $request->social_twitter,
            'social_facebook' => $request->social_facebook,
            'social_instagram' => $request->social_instagram,
            'social_google' => $request->social_google,
            'social_linkedin' => $request->social_linkedin,
            'social_qoura' => $request->social_qoura
        ]);

        if($request->subscription_id == '-1'){
            $customer->subscription_id = $request->subscription_id;
            $customer->subscription_starts = Carbon::now()->toDateString();
            $customer->subscription_ends = Carbon::parse($request->date_ends)->toDateString();
            $customer->search_limits = $request->search_limits;
            $customer->search_leads_limits = $request->search_leads_limits;
            $customer->credits = $request->credits;
            $customer->save();
        }else{
            $subscription = Subscription::find($subscription_id);
            $customer->subscription_id = $subscription->subscription_id;
            $customer->subscription_starts = Carbon::now()->toDateString();
            $customer->subscription_ends = Carbon::parse($subscription->months)->toDateString();
            $customer->search_limits = $subscription->search_limits;
            $customer->search_leads_limits = $subscription->search_leads_limits;
            $customer->credits = $subscription->credits;
            $customer->save();
        }
        
        if($customer)
            return response()->json(['success' => true, 'msg' => 'Customer Account Created.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customer = Customer::where('id',$id)->with('subscription')->first()->toArray();
        //$searches = Result::select('type', 'count', 'created_at')->where('user_id', $customer->id)->orderBy('created_at', 'desc')->take(10)->get();

        if($customer['subscription'] == null && $customer['subscription_id'] == -1){
            $subscription = new Subscription;
            $subscription->id = -1;
            $subscription->title = 'Enterprise Plan';
            $customer['subscription'] = $subscription;
        }

        if($customer['subscription'] == null){
            $subscription = new Subscription;
            $subscription->title = 'No Subscription Plan';
            $customer['subscription'] = $subscription;
        }
        
        $data['customer'] = $customer;
        //$data['searches'] = $searches;
        
        //return $data;

        return view('contents.customers-view', $data);
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
    public function update(UpdateUserRequest $request, $id)
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

    public function addCredits(Request $request, $id){
        abort_unless(Gate::any(['full_access','customers_add_credits']), 404);

        $customer = Customer::find($id);
        $customer->credits_extra = $customer->credits_extra + $request->amount;
        $customer->save();

        return response()->json(['success'=>true,'msg' => trans('customers.addcredits.success')]);
    }

    public function addSubscription(Request $request, $id){
        abort_unless(Gate::any(['full_access','customers_add_subscription']), 404);

        $customer = Customer::find($id);

        $subs_ends = Carbon::parse($customer->subscription_ends);
        $customer->subscription_ends = $subs_ends->addMonths($request->months)->toDateString();
        $customer->save();

        return response()->json(['success'=>true,'msg' => trans('customers.addsubscriptions.success')]);
    }
}
