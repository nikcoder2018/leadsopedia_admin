<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subscription as Plan;
use App\SubscriptionPriviledge as Priviledge;
use App\Setting;

use App\Http\Requests\SubscriptionStoreRequest as StoreRequest;
use App\Http\Requests\SubscriptionUpdateRequest as UpdateRequest;

use App\Http\Resources\Subscription as ResourceSubscription;

use DataTables;
use Gate;
class SubscriptionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_unless(Gate::any(['full_access','subsplan_show']), 404);

        $data['title'] = 'Subscription Plans';
        return view('contents.subscriptions',$data);
    }

    public function all(){
        abort_unless(Gate::any(['full_access','subsplan_show']), 404);

        $plans = Plan::all();
        return DataTables::of(ResourceSubscription::collection($plans))->toJson();
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
    public function store(StoreRequest $request)
    {
        abort_unless(Gate::any(['full_access','subsplan_create']), 404);

        $newsubplan = Plan::create([
            'title' => $request->title,
            'description' => $request->description,
            'months' => $request->months,
            'price' => $request->price,
            'price_annual' => $request->price_annual,
            'search_limits' => $request->search_limits,
            'search_leads_limits' => $request->search_leads_limits,
            'credits' => $request->credits,
            'css_class' => $request->css_class,
            'css_btn_class' => $request->css_btn_class
        ]);

        
        if($request->get('attributes')){
            foreach($request->get('attributes') as $priviledge){
                Priviledge::create([
                    'subplan_id' => $newsubplan->id,
                    'description' => $priviledge['text'],
                    'enabled' => isset($priviledge['enabled']) ? 1 : 0
                ]);
            }
        }

        return response()->json(array('success' => true, 'msg' => 'Subscription Plan Created.', 'details' => $newsubplan, 'currency' => Setting::GetValue('currency_symbol')));
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
        abort_unless(Gate::any(['full_access','subsplan_edit']), 404);

        $subscription = Plan::with('priviledges')->where('id',$id)->first();
        return response()->json($subscription);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request)
    {
        abort_unless(Gate::any(['full_access','subsplan_edit']), 404);

        $subscription = Plan::find($request->id);
        $subscription->title = $request->title;
        $subscription->description = $request->description;
        $subscription->months = $request->months;
        $subscription->price = $request->price;
        $subscription->price_annual = $request->price_annual;
        $subscription->search_limits = $request->search_limits;
        $subscription->search_leads_limits = $request->search_leads_limits;
        $subscription->credits = $request->credits;
        $subscription->css_class = $request->css_class;
        $subscription->css_btn_class = $request->css_btn_class;
        $subscription->save();

        Priviledge::where('subplan_id', $subscription->id)->delete();
        
        if($request->get('attributes')){
            foreach($request->get('attributes') as $priviledge){
                Priviledge::create([
                    'subplan_id' => $subscription->id,
                    'description' => $priviledge['text'],
                    'enabled' => 1
                ]);
            }
        }

        return response()->json(array('success' => true, 'msg' => 'Subscription Plan Updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        abort_unless(Gate::any(['full_access','subsplan_delete']), 404);

        $subplan = Plan::find($id);
        $subplan->delete();

        if($subplan){
            return response()->json(array('success' => true, 'msg' => 'Subscription Plan has been deleted!', 'id' => $subplan->id));
        }else{
            return response()->json(array('success' => false, 'msg' => 'We cant delete this Subscription Plan, please try again!'));
        }
    }
}
