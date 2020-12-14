@extends('layouts.app')

@section('content')
    <div class="container col-9">
        <div class="row">
            <div class="col">
                <h1 class="text-center"> Cart Items</h1>
            </div>
        </div>

        <div class="row align-content-center">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">No.</th>
                    <th scope="col">Title</th>
                    <th scope="col">Description</th>
                    <th scope="col">Design</th>
                    <th scope="col">Quantity</th>
                </tr>
                </thead>
                <tbody>
                @php
                    $total = 0;
                @endphp

                @foreach($carts as $cart)
                    @php
                        $design = $cart->design;
                        $total = $total + $cart->quantity;
                    @endphp
                    <tr>
                        <th scope="row">{{$loop->index+1}}</th>
                        <td>{{$design->title}}</td>
                        <td>{{$design->description}}</td>
                        <td><div class="imgContainer">
                                <x-design-shirt :design="$design" ></x-design-shirt>
                            </div>
                        </td>
                        <td>
                            <form method= "post" action="{{route('carts.update', $design)}}">
                                @csrf
                                @method('PUT')
                                <label for="quantity"> Quantity</label>
                                <input class="w-100" type="number" name="quantity" min="1" value="{{$cart->quantity}}">
                                <br><br>
                                <button type="submit" class="btn btn-primary btn btn-block">Update Quantity </button>

                            </form>
                        </td>
                    </tr>

                @endforeach
                </tbody>
            </table>


        </div>
        <div class="row mt-5">
            <div class="col">
                <h1 > Total</h1>
                <h2 class="text-right"> {{$total}} items x Rp50.000 = <b> Rp{{number_format($total*50000,0,',','.')}}</b></h2>
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
