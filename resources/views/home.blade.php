@extends('layouts.app')

@section('content')
    <x-home-jumbotron>

    </x-home-jumbotron>

    <div class="container col-11">
        <div class="row">
            <div class="col">
                <h1 class="text-center"> Publicly Available Designs </h1>
            </div>
        </div>

        <div class="row align-content-center">

            @foreach($products as $product)

                @php
                    $design = $product->design;
                    $productType = $product->productType;
                @endphp

                <div class="card shadow m-3" style="width: 19.5rem;">
                    <h2 class="py-4 card-title text-center">{{$design->name}}</h2>

                    <x-design-shirt :design="$design" :productType="$productType">

                    </x-design-shirt>

                    <div class="card-body">
                        <p class="card-text">{{$design->description}}</p>

                    </div>
                    <div class="card-footer">
                        <a href="{{route('products.show',$product)}}" class="btn btn-primary btn-block">View
                            Design</a>
                    </div>
                </div>


            @endforeach
        </div>

    </div>

@endsection
@section('scripts')
    <script>
        $('main').removeClass("py-5");
    </script>

@endsection
