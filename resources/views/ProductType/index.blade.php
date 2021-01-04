@extends('layouts.app')

@section('content')
    <div class="container col-11">
        <div class="row">
            <div class="col">
                <h1 class="text-center"> Choose Apparel Type</h1>
            </div>
        </div>

        <div class="row align-content-center">


            @foreach($productTypes as $productType)
                @if($loop->index %4 == 0)
                    <div class="card-deck">
                        @endif

                        @php
                            $design = null;
                        @endphp

                        <div class="card shadow m-3" style="width: 19.5rem;">
                            <h2 class="py-4 card-title text-center">{{$productType->name}}</h2>

                            <x-design-shirt :design="$design" :productType="$productType">

                            </x-design-shirt>

                            <div class="card-body">
                                <p class="card-text">{{$productType->description}}</p>
                                <p class="card-text">Base Price:
                                    Rp{{number_format($productType->base_price,0,',','.')}}</p>
                            </div>
                            <div class="card-footer">
                                <a href="{{route('products.create',$productType)}}" class="btn btn-primary btn-block">Create
                                    Design</a>
                            </div>
                        </div>
                        @if($loop->index %4 == 0)
                    </div>
                @endif
            @endforeach

        </div>

    </div>

@endsection

