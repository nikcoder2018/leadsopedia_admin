<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaction;

use DataTables;
class TransactionsController extends Controller
{
    public function index(){
        return view('contents.transactions');
    }

    public function getAllTransactions(){
        $transactions = Transaction::with(['customer','subscription', 'method'])->get();
        return DataTables::of($transactions)->toJson();
    }
}
