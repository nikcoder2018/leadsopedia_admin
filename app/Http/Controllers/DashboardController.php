<?php

namespace App\Http\Controllers;
use App\Helpers\ZeroBounce;
use Illuminate\Http\Request;
use App\Lead;
use App\Customer;
use App\Transaction;
use App\Integration;
use App\IntegrationDataDefault;
class DashboardController extends Controller
{
    public function index(){
        $data['totalLeads'] = Lead::count();
        $data['totalSearches'] = 0; //TODO Di pa mugana ang total search
        $data['totalCustomers'] = Customer::count(); 
        $data['totalSales'] = Transaction::sum('amount'); 

        $data['newAccounts'] = Customer::where('email_verified_at','!=',null)->orderBy('created_at','desc')->take(5)->get();
        $data['lastAccountRegisteredDate'] = Customer::where('email_verified_at','!=',null)->orderBy('created_at','desc')->first()->created_at;
        $data['latestTransactions'] = Transaction::with(['customer','subscription','method'])->orderBy('created_at','desc')->take(5)->get();
        
        $total_credits = 0;
        $total_unused_credits = 0;
        $total_used_credits = 0;
        $int_zb = Integration::where('app_key','zero_bounce')->where('scope','backend')->where('status', 'enabled')->first();
        if($int_zb){
            $zp_api_key = IntegrationDataDefault::where('integration_id', $int_zb->id)->where('name', 'api_key')->first()->value;
            $zb = new ZeroBounce($zp_api_key);
            $total_unused_credits += $zb->getCredits()['Credits'];
        }
        $data['totalCredits'] = $total_credits;
        $data['totalUnusedCredits'] = $total_unused_credits;
        $data['totalUsedCredits'] = $total_used_credits;
        #return response()->json($data); exit;
        return view('contents.dashboard', $data);
    }
}
