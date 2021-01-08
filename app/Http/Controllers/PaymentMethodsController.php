<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\PaymentMethod as ResourcePaymentMethod;
use App\PaymentMethod;
use App\PaymentMethodData;

use DataTables;

class PaymentMethodsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function all()
    {
        $payments = PaymentMethod::all();
        return DataTables::of(ResourcePaymentMethod::collection($payments))->toJson();
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
            'name' => 'required:max:64',
            'description' => 'max:64'
        ]);

        $newPaymentMethod = PaymentMethod::create([
            'name' => $validated['name'],
            'description' => $validated['description']
        ]);

        if ($request->get('attributes')) {
            foreach ($request->get('attributes') as $attribute) {
                PaymentMethodData::create([
                    'method_id' => $newPaymentMethod->id,
                    'name' => $attribute['name'],
                    'value' => $attribute['value'],
                    'visibility' => 1
                ]);
            }
        }

        return response()->json(array('success' => true, 'msg' => 'Payment Method Added Successfully.', 'details' => $newPaymentMethod));
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
    public function edit($id)
    {
        $paymentMethod = PaymentMethod::with('details')->where('id', $id)->first();
        return response()->json($paymentMethod);
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
            'name' => 'required:max:64',
            'description' => 'max:64'
        ]);

        $paymentMethod = PaymentMethod::find($request->id);
        $paymentMethod->name = $validated['name'];
        $paymentMethod->description = $validated['description'];
        $paymentMethod->save();

        PaymentMethodData::where('method_id', $paymentMethod->id)->delete();

        if ($request->get('attributes')) {
            foreach ($request->get('attributes') as $attribute) {
                PaymentMethodData::create([
                    'method_id' => $paymentMethod->id,
                    'name' => $attribute['name'],
                    'value' => $attribute['value'],
                    'visibility' => 1
                ]);
            }
        }

        return response()->json(array('success' => true, 'msg' => 'Payment Method Successfully Updated.', 'method' => $paymentMethod));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = PaymentMethod::find($id)->delete();
        if ($delete)
            return response()->json(array('success' => true, 'msg' => 'Payment Method Deleted.', 'id' => $id));
    }
}
