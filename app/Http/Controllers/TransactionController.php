<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class TransactionController extends Controller
{
    public function index(){
        $transactions = Auth::user()->transactions()
            ->orderBy('updated_at','DESC')
            ->get();

        return view('transaction.index', compact('transactions'));
    }

    public function show(Transaction $transaction){

        $this->authorize('view',$transaction);

        return view('transaction.show',compact('transaction') );
    }

    public function create(){
        $transaction = Auth::user()->transactions()->create(["status"=>"unpaid"]);


        $carts = Auth::user()->carts;
        foreach ($carts as $cart){
            $transaction->transactionDetails()->create(["product_id"=>$cart->product_id, "quantity" => $cart->quantity]);
            $cart->delete();
        }

        return redirect()->route("transactions.show", $transaction);
    }

    public function updateStatus(Request $request, Transaction $transaction){

    }
}
