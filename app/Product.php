<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Product extends Model
{
    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function design(){
        return $this->belongsTo(Design::class);
    }

    public function productType(){
        return $this->belongsTo(ProductType::class);
    }

    public function carts(){
        return $this->hasMany(Cart::class);
    }

    public function transactionDetail(){
        return $this->hasMany(TransactionDetail::class);
    }

    public function getPriceAttribute(){


        if(Auth::user() and Auth::user()->id  == $this->user->id ){
            return $this->productType->base_price;
        }else{
            return $this->productType->base_price + $this->design->commission;
        }

        return $total;
    }
}
