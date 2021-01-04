@extends('layouts.app')

@section('content')
    @php
        $design = $product->design;
        $productType = $product->productType;
    @endphp

    <div class="container">


        <div class="row">
            <div class="col">
                <x-design-shirt :design="$design" :productType="$productType">

                </x-design-shirt>
            </div>

            <div class="col">

                <h1>Design Name: <b> {{$design->name}} </b></h1>
                <h6 class="display-100"> Designed By: {{$product->user->name}} </h6>
                <h6>Apparel Type: {{$productType->name}} </h6>
                <br>


                <br>

                <h3> Description: <br> {{$design->description}}</h3>

                <br><br>

                <div class="row">
                    <div class="col">
                        <h3> Add To Cart </h3>
                        <h4 class="text-right"> @ <b> Rp{{number_format($product->price,0,',','.')}}</b></h4>
                    </div>
                </div>

                <form method="post" action="{{route('carts.atc', $product)}}">
                    @csrf
                    <div class="row my-2">
                        <div class="col">
                            <label for="quantity"> Quantity</label>
                            <input class="w-100" type="number" name="quantity" min="1" value="1">
                        </div>


                    </div>
                    <div class="row">
                        <div class="col">

                            <button type="submit" class="btn btn-primary btn-lg btn-block">Add To Cart
                            </button>

                        </div>
                    </div>

                </form>
                <br>

                @can('view',$product)
                    <div class="row">
                        <div class="col">
                            <form method="get" action="{{route('products.edit', $product)}}">
                                @csrf
                                <button type="submit" class="btn btn-outline-primary btn-lg btn-block">Edit
                                    Design
                                </button>
                            </form>
                        </div>
                        <div class="col">
                            <form method="post" action="{{route('products.destroy', $product)}}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-lg btn-block">Delete
                                    Design
                                </button>
                            </form>
                        </div>
                    </div>
                @endcan

            </div>

        </div>


    </div>

    </div>

@endsection
