@extends('layouts.app')

@section('content')
    <div class="container col-9">
        <h1> My Transactions </h1>

        <div class="row align-content-center">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">No.</th>
                    <th scope="col">Transaction Date</th>
                    <th scope="col">Total</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>

                @foreach($transactions as $transaction)
                    <tr>
                        <th scope="row">{{$loop->index+1}}</th>
                        <td>{{$transaction->created_at}}, {{$transaction->created_at->diffForHumans()}}</td>
                        <td><b>Rp{{number_format($transaction->total,0,',','.')}} </b></td>
                        <td> {{$transaction->status }}</td>
                        <td>
                            <a href="{{route('transactions.show', $transaction)}}">
                                <button class="btn btn-primary btn btn-block">View Details </button>
                            </a>
                        </td>

                    </tr>

                @endforeach
                </tbody>
            </table>


        </div>

    </div>
@endsection
