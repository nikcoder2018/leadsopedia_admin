<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lead;
use App\Customer;
use App\Transaction;
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
        #return response()->json($data); exit;
        return view('contents.dashboard', $data);
    }
}
