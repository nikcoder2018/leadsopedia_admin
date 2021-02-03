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
use App\CreditPackage;
use Gate;
class SettingsController extends Controller
{
    public function index(){
        abort_unless(Gate::any(['full_access','settings_show']), 404);
        $data['integration_groups'] = IntegrationGroup::all();

        #return response()->json($data); exit;
        return view('contents.settings', $data);
    }

    public function init(Request $request){
        abort_unless(Gate::any(['full_access','settings_show']), 404);

        switch($request->type){
            case 'general': 
                $data['countries'] = Country::all();
                $data['currencies'] = Currency::all();
                $data['languages'] = Language::all();
                $data['timezones'] = TimeZone::all();
                $data['defaults'] = array(
                    'landing_web_title' => Setting::GetValue('landing_web_title'),
                    'front_web_title' => Setting::GetValue('front_web_title'),
                    'backoffice_web_title' => Setting::GetValue('backoffice_web_title'),
                    'language' => Setting::GetValue('language'),
                    'currency' => Setting::GetValue('currency'),
                    'timezone' => Setting::GetValue('timezone')
                );
                return response()->json($data);
            break;
        }
    }   

    public function update_general(Request $request){
        abort_unless(Gate::any(['full_access','settings_update']), 404);

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
