<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaction;
use App\User;
use App\Subscription;
use App\Http\Resources\Transaction as ResourceTransaction;
use DataTables;
use Gate;
use PDF;
use Carbon\Carbon;
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
        $transaction = Transaction::with(['customer','subscription', 'method'])->where(['id' => $id])->first();
        #return response()->json($data);
        $description = '';
        $qty = 0;
        if($transaction->subscription){
            $description = $transaction->subscription->title;
            $qty = $transaction->subscription->months;
        }elseif($transaction->credits != ''){
            $description = 'Credits';
            $qty = $transaction->credits;
        }

        $data['item'] = (object) [
            'description' => $description,
            'amount' => $transaction->amount,
            'qty' => $qty,
        ];
        $data['transaction'] = $transaction;
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

    public function download($id){
        $transaction = Transaction::with(['customer','subscription', 'method'])->where(['id' => $id])->first();
        $items = array();
        if($transaction->subscription_id == ''){
            $items = array(
                'name' => $transaction->credits.' Credits',
                'period' => '',
                'vat' => 0,
                'price' => $transaction->amount
            );
        }else{
            $subs = Subscription::find($transaction->subscription_id);
            $items = array(
                'name' => @$subs->title,
                'period' => '',
                'vat' => 0,
                'price' => $transaction->amount
            );
        }

        $data = array(
            'subject' => 'Your Payment Receipt',
            'order_number' => $transaction->invoice_number,
            'billing_date' => Carbon::parse($transaction->paid_at)->format('d M Y'),
            'to' => array(
                'name' => $transaction->customer->name,
                'email' => $transaction->customer->email,
                'address' => $transaction->customer->address,
                'website' => $transaction->customer->website,
                'company' => $transaction->customer->company,
            ),
            'items' => $items,
            'status' => $transaction->status,
            'method' => $transaction->method->name,
            'total' => $transaction->amount
        );

        //return $data;
        $pdf = PDF::loadView('pdf.receipt', $data);

        //return view('pdf.receipt', $data);
        return $pdf->download('Receipt#'.$transaction->invoice_number.'.pdf');
    }
}
