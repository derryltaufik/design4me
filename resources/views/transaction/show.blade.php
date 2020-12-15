@extends('layouts.app')

@section('content')

    <div class="container">
        <h1> Pay your transaction before <b> {{$transaction->created_at->addDays(1)->format('l, j F Y, H:i')}} </b> </h1>
        <br>
        <h1> Total Price : <b> Rp{{number_format($transaction->total*50000,0,',','.')}} </b></h1>
        <h2> Instructions </h2>
        <ol>
            <li> Transfer to BCA Virtual Account: <b>80808081234567890 </b> </li>
            <li> Lorem Ipsum </li>
            <li> Lorem Ipsum </li>
        </ol>

        <h1>Items</h1>
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

                @foreach($transaction->transactionDetails as $transactionDetail)
                    @php
                        $design = $transactionDetail->design;
                    @endphp
                    <tr>
                        <th scope="row">{{$loop->index+1}}</th>
                        <td>{{$design->title}}</td>
                        <td>{{$design->description}}</td>
                        <td><div class="imgContainer">
                                <x-design-shirt :design="$design" ></x-design-shirt>
                            </div>
                        </td>
                        <td>{{$transactionDetail->quantity}}
                        </td>
                    </tr>

                @endforeach
                </tbody>
            </table>
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

