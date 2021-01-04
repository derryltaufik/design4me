<?php

namespace App\Http\Controllers;

use App\ProductType;
use Illuminate\Http\Request;

class ProductTypeController extends Controller
{
    public function index(){
        $productTypes = ProductType::all();

        return view('ProductType.index', compact('productTypes'));
    }
}
