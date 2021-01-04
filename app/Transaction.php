<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function transactionDetails(){
        return $this->hasMany(TransactionDetail::class);
    }

    public function getTotalAttribute(){
        $transactionDetails = $this->transactionDetails;

        $total = 0;
        foreach ($transactionDetails as $transactionDetail){
            $product = $transactionDetail->product;
            $total += $transactionDetail->quantity * $product->price;
        }

        return $total;
    }
}
