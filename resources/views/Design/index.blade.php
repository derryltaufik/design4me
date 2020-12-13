@extends('layouts.app')

@section('content')
    <div class="container col-11">
        <div class="row">
            <div class="col">
                <h1 class="text-center"> My Designs</h1>
            </div>
        </div>

        <div class="row align-content-center">
            @foreach($designs as $design)
                <div class="card m-3" style="width: 19.5rem;">
                    <div class="shirt-box bg-white d-inline-flex">
                        <img class="shirt-image" src="{{asset('/images/shirt_template.png')}}"   >
                        <div class="design-image-wrapper">
                            <img class="design-image" src="{{asset('storage/'.$design->design_svg)}}">
                        </div>

                    </div>
                    <div class="card-body">
                        <h2 class="card-title text-center">{{$design->title}}</h2>
                        <p class="card-text">{{$design->description}}</p>
                        <a href="{{route('designs.show',$design)}}" class="btn btn-outline-primary btn-block">View Design</a>
                    </div>
                </div>
            @endforeach
        </div>

    </div>

@endsection

@section('styles')
    <style>
        .shirt-box{
            position:relative;
        }

        .design-image-wrapper{

            position: absolute;
            top:50%;
            left:50%;
            transform: translate(-50%, -70%);
            width: 35%;
        }

        .design-image{
            z-index: 1;
            max-width: 100%;
            max-width: 100%;
        }

        .shirt-image {
            max-width: 100%;
            max-height: 100%;
        }
    </style>
@endsection
