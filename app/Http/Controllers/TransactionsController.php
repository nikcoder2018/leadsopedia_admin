<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaction;
use App\Http\Resources\Transaction as ResourceTransaction;
use DataTables;
use Gate;
class TransactionsController extends Controller
{
    public function index(){
        abort_unless(Gate::any(['full_access','transactions_show']), 404);

        $data['title'] = 'Transactions';
        return view('contents.transactions', $data);
    }

    public function show($id){
        abort_unless(Gate::any(['full_access','transactions_show']), 404);

        $data['title'] = 'Transaction Details';
        $data['transaction'] = Transaction::with(['customer','subscription', 'method'])->where(['id' => $id])->first();
        #return response()->json($data);
        return view('contents.transactions-details',$data);
    }
    public function archiveslist(){
        abort_unless(Gate::any(['full_access','transactions_archive']), 404);

        $data['title'] = 'Transactions Archived';
        return view('contents.transactions-archives', $data);
    }
    public function getAllTransactions (){
        abort_unless(Gate::any(['full_access','transactions_show']), 404);

        $transactions = Transaction::with(['customer','subscription', 'method'])->where('archived',0)->get();

        return DataTables::of(ResourceTransaction::collection($transactions))->toJson();
    }

    public function getAllTransactionsArchive(){
        abort_unless(Gate::any(['full_access','transactions_archive']), 404);

        $transactions = Transaction::with(['customer','subscription', 'method'])->where('archived',1)->get();
        return DataTables::of(ResourceTransaction::collection($transactions))->toJson();
    }

    public function archive($id){
        abort_unless(Gate::any(['full_access','transactions_archive']), 404);

        $transaction = Transaction::find($id);
        $transaction->archived = 1;
        $transaction->save();

        return response()->json(array('success' => true, 'msg' => 'Transaction Archived.', 'id' => $transaction->id));
    }

    public function restore($id){
        abort_unless(Gate::any(['full_access','transactions_restore']), 404);

        $transaction = Transaction::find($id);
        $transaction->archived = 0;
        $transaction->save();

        return response()->json(array('success' => true, 'msg' => 'Transaction Restored.', 'id' => $transaction->id));
    }

    public function destroy($id){
        abort_unless(Gate::any(['full_access','transactions_delete']), 404);

        $transaction = Transaction::find($id);
        $transaction->delete();

        return response()->json(array('success' => true, 'msg' => 'Transaction Deleted.', 'id' => $transaction->id));
    }
}
