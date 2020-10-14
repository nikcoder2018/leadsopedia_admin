<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lead;
class DashboardController extends Controller
{
    public function index(){
        $data['totalLeads'] = Lead::count();
        return view('contents.dashboard', $data);
    }
}
