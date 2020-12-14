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
        $items = $this->transactionDetails;

        $total = 0;
        foreach ($items as $item){
            $total = $total + $item->quantity;
        }

        return $total;
    }
}
