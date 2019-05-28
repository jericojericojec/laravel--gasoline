<?php

namespace App\Http\Controllers;

use App\tbl_transactions as Transactions;

use App\Http\Requests\transactionRequest;
use Illuminate\Http\Request;

use Carbon\Carbon;
use Barryvdh\DomPDF\Facade as PDF;
use App\Exports\TransactionsExport;
use Maatwebsite\Excel\Facades\Excel;

use App;

class TransactionController extends Controller
{

    public function index(){
        return $this->homepage();
    }

    public function homepage(){
        return view('gasoline.index');
    }

    public function view(){
        $this->data['transactions'] = Transactions::orderBy('created_at',"ASC")->get();
        return view('gasoline.transactions', $this->data);
    }

    public function store(transactionRequest $request){
        try{
            
            $total_computed = $this->computePurchase(round($request->price_per_ltr), round($request->number_of_liters));
            $transaction = new Transactions;
            $transaction->fill($request->only('fuel_type', 'price_per_ltr', 'purchase_amount', 'vat'));
            $transaction->total_amount = $total_computed;

            if($transaction->save()) {
                $this->data['transaction'] = $transaction;
                $this->data['transaction_liters'] = $request->number_of_liters;
                $pdf = App::make('dompdf.wrapper');
                $pdf->loadView('gasoline.receipt',$this->data);
                return $pdf->download('gasoline_receipt_' .date('d-m-Y', strtotime(Carbon::now())) . '.pdf');
            }

            session()->flash('notification-status','failed');
            session()->flash('notification-msg','Oops something is wrong.');
            return redirect()->back();

        } catch (Exception $e){
			session()->flash('notification-status','failed');
			session()->flash('notification-msg',$e->getMessage());
			return redirect()->back();
        }
    }

    public function export() {
        return Excel::download(new TransactionsExport, 'transactions_export_' .date('d-m-Y', strtotime(Carbon::now())) . '.csv');
    }

    public function computePurchase($fuel_price, $total_liters){
        return $fuel_price * $total_liters;
    }
}
