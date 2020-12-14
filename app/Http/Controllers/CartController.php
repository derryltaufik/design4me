<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Design;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index(){
        $carts = Auth()->user()->carts;
        return view('cart.index',compact('carts'));
    }

    public function addToCart(Request $request, Design $design){
//        dd($request, Auth::user(), $design);

        $cart = Cart::where('user_id','=',Auth::user()->id)
            ->where('design_id','=', $design->id)
            ->first();
        //if cart exist
        if($cart){
            $cart->quantity = $cart->quantity + $request->quantity;
            $cart->update();
        }else{
            $inputs = [];
            $inputs['design_id'] = $design->id;
            $inputs['quantity'] = $request->quantity;

            $id = Auth::user()->carts()->create($inputs)->id;
        }

        return redirect()->back();
    }

    public function update(Request $request, Design $design){

        $cart = Cart::where('user_id','=',Auth::user()->id)
            ->where('design_id','=', $design->id)
            ->first();
        //if cart exist
        $cart->quantity = $request->quantity;
        $cart->update();

        return redirect()->back();
    }
}
