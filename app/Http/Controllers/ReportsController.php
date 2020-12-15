<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaction;
use Gate;
class ReportsController extends Controller
{
    public function salesnew(){
        abort_unless(Gate::any(['full_access','reports_show']), 404);

        $data['title'] = 'Sales';
        return view('contents.reports.salesnew', $data);
    }
    public function salesrenew(){
        abort_unless(Gate::any(['full_access','reports_show']), 404);

        return view('contents.reports.salesrenew');
    }

    public function salesnewAPI(Request $request){
        abort_unless(Gate::any(['full_access','reports_show']), 404);

    }
    public function salesrenewAPI(Request $request){
        abort_unless(Gate::any(['full_access','reports_show']), 404);
        
    }
}
