<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subscription as Plan;
use App\SubscriptionPriviledge as Priviledge;
use App\Setting;

use App\Http\Requests\SubscriptionStoreRequest as StoreRequest;
use App\Http\Requests\SubscriptionUpdateRequest as UpdateRequest;
class SubscriptionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['plans'] = Plan::with('priviledges')->get();
        return view('contents.subscriptions',$data);
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
        $newsubplan = Plan::create([
            'title' => $request->title,
            'description' => $request->description,
            'months' => $request->months,
            'price' => $request->price,
            'css_class' => $request->css_class,
            'css_btn_class' => $request->css_btn_class
        ]);

        
        if(count($request->priviledges) > 0){
            foreach($request->priviledges as $priviledge){
                Priviledge::create([
                    'subplan_id' => $newsubplan->id,
                    'description' => $priviledge['description'],
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
    public function edit(Request $request)
    {
        $subscription = Plan::with('priviledges')->where('id',$request->id)->first();
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
        $subscription = Plan::find($request->id);
        $subscription->title = $request->title;
        $subscription->description = $request->description;
        $subscription->months = $request->months;
        $subscription->price = $request->price;
        $subscription->css_class = $request->css_class;
        $subscription->css_btn_class = $request->css_btn_class;
        $subscription->save();


        if(count($request->priviledges) > 0){
            //delete all existing priviledges
            Priviledge::where('subplan_id', $subscription->id)->delete();
            foreach($request->priviledges as $priviledge){
                Priviledge::create([
                    'subplan_id' => $subscription->id,
                    'description' => $priviledge['description'],
                    'enabled' => isset($priviledge['enabled']) ? 1 : 0
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
    public function destroy(Request $request)
    {
        $subplan = Plan::find($request->id);
        $subplan->delete();

        if($subplan){
            return response()->json(array('success' => true, 'msg' => 'Subscription Plan has been deleted!', 'id' => $subplan->id));
        }else{
            return response()->json(array('success' => false, 'msg' => 'We cant delete this Subscription Plan, please try again!'));
        }
    }
}
