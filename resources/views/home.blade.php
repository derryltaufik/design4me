@extends('layouts.app')

@section('content')
    <div class="jumbotron">
        <div class="container">
            <h1 class="display-4">Create Your Own Design</h1>
            <p class="lead">This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
            <hr class="my-4">
            <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
            <p class="lead">
                <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>
            </p>
        </div>

    </div>

    <div class="container col-11">
        <div class="row">
            <div class="col">
                <h1 class="text-center"> Available Designs </h1>
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
