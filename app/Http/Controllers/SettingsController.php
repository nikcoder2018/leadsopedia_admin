<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Country;
use App\Currency;
use App\Language;
use App\TimeZone;
use App\Setting;
use App\PaymentMethod;
use App\Integration;
use App\IntegrationData;
use App\IntegrationDataDefault;
use App\IntegrationGroup;

class SettingsController extends Controller
{
    public function index(){
        $data['countries'] = Country::all();
        $data['currencies'] = Currency::all();
        $data['languages'] = Language::all();
        $data['timezones'] = TimeZone::all();

        $data['payment_methods'] = PaymentMethod::all();
        $data['integrations'] = Integration::with(['group', 'attributes_default'])->get();
        $data['integration_groups'] = IntegrationGroup::all();
        #return response()->json($data); exit;
        return view('contents.settings', $data);
    }

    public function update_general(Request $request){
        foreach($request->input() as $name=>$value){
            if(Setting::where('name',$name)->exists()){
                $setting = Setting::where('name',$name)->first();
                $setting->value = $value;
                $setting->save();
            }
        }

        return response()->json(array('success' => true, 'msg' => 'General Settings Updated.'));
    }
}
