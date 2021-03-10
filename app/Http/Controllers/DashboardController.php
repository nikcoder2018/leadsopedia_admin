<?php

namespace App\Http\Controllers;
use App\Helpers\ZeroBounce;
use Illuminate\Http\Request;

use App\Http\Resources\DashboardTransaction as ResourceDashboardTransactions;
use App\Setting;
use App\Lead;
use App\Customer;
use App\Transaction;
use App\Integration;
use App\IntegrationDataDefault;
use App\Result;

use Carbon\Carbon;
use Gate;
class DashboardController extends Controller
{
    public function index(){
        abort_unless(Gate::any(['full_access','dashboard_access']), 404);

        $data['greetings'] = $this->greetings();
        
        return view('contents.dashboard', $data);
    }

    public function data(Request $request){
        abort_unless(Gate::any(['full_access','dashboard_access']), 404);

        switch($request->type){
            case 'statistics': 
                $data['totalData'] = $this->simplifyCount(Lead::count());
                $data['totalSearches'] = $this->simplifyCount(Result::count());
                $data['totalCustomers'] = $this->simplifyCount(Customer::count()); 
                $data['totalSales'] = Setting::GetValue('currency_symbol').$this->simplifyCount(Transaction::where(function($q){ 
                    $q->orWhere('status','succeeded');
                    $q->orWhere('status', 'approved');
                })->sum('amount')); 
                $data['todaySales'] = Setting::GetValue('currency_symbol').$this->simplifyCount(Transaction::where(function($q){ 
                    $q->orWhere('status','succeeded');
                    $q->orWhere('status', 'approved');
                })->where('created_at', '>', Carbon::now()->startOfDay())->sum('amount'));

                return response()->json($data);
            break;

            case 'credits': 
                $total_unused_credits = 0;
                $total_used_credits = 0;
                $int_zb = Integration::where('app_key','zero_bounce')->where('scope','backend')->where('status', 'enabled')->first();
                if($int_zb){
                    $zp_api_key = IntegrationDataDefault::where('integration_id', $int_zb->id)->where('name', 'api_key')->first()->value;
                    $zb = new ZeroBounce($zp_api_key);
                    $total_unused_credits += $zb->getCredits()['Credits'];
                    $total_used_credits += $zb->getAPIUsage('2021-01-01',date('Y-m-d'))['total'];
                }
                $data['totalUnusedCredits'] = $total_unused_credits;
                $data['totalUsedCredits'] = $total_used_credits;
                
                $total_credits = $total_unused_credits+$total_used_credits;
                $data['totalCredits'] = $total_credits;

                $data['percentage'] = $total_credits > 0 ? number_format((100)-(($total_used_credits/$total_credits)*100),0) : 0;
                return response()->json($data);
            break;

            case 'sales_report': 
                $numberOfMonths = 7;
                $months = array();
                $data = array();
                for($i = $numberOfMonths; $i >= 0; $i--){
                    $month = Carbon::now()->subMonths($i)->format('M');
                    $sMonth = Carbon::now()->subMonths($i)->startOfMonth()->format('Y-m-d H:i:s');
                    $eMonth = Carbon::now()->subMonths($i)->endOfMonth()->format('Y-m-d H:i:s');
                    $transaction = Transaction::where(function($q){ 
                        $q->orWhere('status','succeeded');
                        $q->orWhere('status', 'approved');
                    })->whereBetween('created_at', [$sMonth, $eMonth])->sum('amount');
                    array_push($data, $transaction);
                    array_push($months, $month);
                }

                return [
                    'categories' => $months,
                    'data' => $data
                ];
            break;

            case 'transactions': 
                $transactions = Transaction::with(['customer','subscription','method'])->orderBy('created_at','desc')->take(7)->get();
                $data['transactions'] = ResourceDashboardTransactions::collection($transactions);
                return response()->json($data);
            break;

            case 'newaccounts': 
                $data['accounts'] = Customer::with('subscription')->where('email_verified_at','!=',null)->orderBy('created_at','desc')->take(5)->get()->append('dateregistered');
                
                return response()->json($data);
            break;
        }
    }

    public function greetings(){
        $hrs =  date('H:i:s');
        if ($hrs >=  0 && $hrs < 12) return "Good morning!";      // After 6am
        if ($hrs >= 12 && $hrs < 17) return "Good afternoon";    // After 12pm
        if ($hrs >= 17 && $hrs < 22) return "Good evening!";      // After 5pm
        if ($hrs >= 22) return "Time to Bed!";        // After 10pm
    }

    public function simplifyCount($count){
        if ($count >= 1000 && $count < 1000000) {
            return round($count/1000, 1) . "K";
        } elseif($count >= 1000000 && $count < 1000000000) {
            return round($count/1000000, 1) . "M";
        } elseif($count >= 1000000000) {
            return round($count/1000000000, 1) . "B";
        }else{
            return $count;
        }
    }
}
