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
    public function archiveslist(){
        return view('contents.transactions-archives');
    }
    public function getAllTransactions(){
        $transactions = Transaction::with(['customer','subscription', 'method'])->where('archived',0)->get();
        return DataTables::of($transactions)->toJson();
    }

    public function getAllTransactionsArchive(){
        $transactions = Transaction::with(['customer','subscription', 'method'])->where('archived',1)->get();
        return DataTables::of($transactions)->toJson();
    }

    public function archive(Request $request){
        $transaction = Transaction::find($request->id);
        $transaction->archived = 1;
        $transaction->save();

        return response()->json(array('success' => true, 'msg' => 'Transaction Archived.', 'id' => $transaction->id));
    }

    public function restore(Request $request){
        $transaction = Transaction::find($request->id);
        $transaction->archived = 0;
        $transaction->save();

        return response()->json(array('success' => true, 'msg' => 'Transaction Restored.', 'id' => $transaction->id));
    }
}
