<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Design extends Model
{
    protected $guarded = [];

    public function product(){
        return $this->hasOne(Product::class);
    }
}
