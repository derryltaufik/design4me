@extends('layouts.app')

@section('content')
    <div class="container col-9">
        <div class="row">
            <div class="col">
                <h1 class="text-center"> My Cart</h1>
            </div>
        </div>

        <div class="row align-content-center">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">No.</th>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Apparel Type</th>
                    <th scope="col">Design</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Price</th>
                </tr>
                </thead>
                <tbody>
                @php
                    $total = 0;
                @endphp

                @foreach($carts as $cart)
                    @php
                        $product = $cart->product;
                        $productType = $product->productType;
                        $design = $product->design;
                        $price = $cart->quantity * $product->price;
                        $total = $total + $price;
                    @endphp
                    <tr>
                        <th scope="row">{{$loop->index+1}}</th>
                        <td> <a href="{{route('products.show', $product)}}"> {{$design->name}} </a> </td>
                        <td>{{$design->description}}</td>
                        <td> {{$product->producttype->name}} <br>
                            {{$product->producttype->description}}
                        </td>
                        <td><div class="imgContainer">
                                <x-design-shirt :design="$design" :productType="$productType"></x-design-shirt>
                            </div>
                        </td>
                        <td>
                            <form method= "post" action="{{route('carts.update', $product)}}">
                                @csrf
                                @method('PUT')
                                <label for="quantity"> Quantity</label>
                                <input class="w-100" type="number" name="quantity" min="1" value="{{$cart->quantity}}">
                                <br><br>
                                <button type="submit" class="btn btn-primary btn btn-block">Update Quantity </button>

                            </form>
                            <br>
                            <form method= "post" action="{{route('carts.destroy', $product)}}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-block">Remove From Cart
                                </button>
                            </form>
                        </td>

                        <td> {{$cart->quantity}} pcs x Rp{{number_format($product->price,0,',','.')}} = <b> Rp{{number_format($price,0,',','.')}}</b></td>
                    </tr>

                @endforeach
                </tbody>
            </table>


        </div>
        <div class="row mt-5">
            <div class="col">
                <h1 class="text-lg-right" > Total</h1>
                <h2 class="text-right">  <b> Rp{{number_format($total,0,',','.')}}</b></h2>
            </div>

        </div>
        <div class="row">
            <div class="col text-right">
                <form method= "post" action="{{route('transactions.create')}}">
                    @csrf
                    <button type="submit" class="btn btn-primary btn-lg">Check Out</button>

                </form>
            </div>

        </div>

    </div>
@endsection
@section('styles')
    <style>
        .imgContainer {
            height: 50vh;
            overflow: auto;
        }
    </style>

@endsection
