<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Design;
use App\Product;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function index(){
        $carts = Auth()->user()->carts;
        return view('cart.index',compact('carts'));
    }

    public function addToCart(Request $request, Product $product){

        $cart = Cart::where('user_id','=',Auth::user()->id)
            ->where('product_id','=', $product->id)
            ->first();
        //if cart exist
        if($cart){
            $cart->quantity = $cart->quantity + $request->quantity;
            $cart->update();
        }else{
            $inputs = [];
            $inputs['product_id'] = $product->id;
            $inputs['quantity'] = $request->quantity;

            $id = Auth::user()->carts()->create($inputs)->id;
        }

        Session::flash('success','Product Added to Cart Successfully');

        return redirect()->back();
    }

    public function update(Request $request, Product $product){

        $cart = Cart::where('user_id','=',Auth::user()->id)
            ->where('product_id','=', $product->id)
            ->first();
        //if cart exist
        $this->authorize('update',$cart);

        $cart->quantity = $request->quantity;
        $cart->update();

        Session::flash('success','Cart Successfully Updated');

        return redirect()->back();
    }

    public function destroy(Request $request, Product $product){




        $cart = Cart::where('user_id','=',Auth::user()->id)
            ->where('product_id','=', $product->id)
            ->first();

        $this->authorize('delete',$cart);

        //if cart exist
        $cart->delete();

        Session::flash('success','Product Removed From The Cart');

        return redirect()->back();

    }
}
