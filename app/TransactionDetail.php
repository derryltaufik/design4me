<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    protected $guarded = [];

    public function transaction(){
        return $this->belongsTo(Transaction::class);
    }

    public function design(){
        return $this->belongsTo(Design::class);
    }
}
