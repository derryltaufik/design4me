@extends('layouts.app')

@section('content')
    <x-home-jumbotron>

    </x-home-jumbotron>

    <div class="container col-11">
        <div class="row">
            <div class="col">
                <h1 class="text-center"> Available Designs </h1>
            </div>
        </div>

        <div class="row align-content-center">
            @foreach($designs as $design)
                <div class="card m-3" style="width: 19.5rem;">
                    <x-design-shirt :design="$design">

                    </x-design-shirt>
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
@section('scripts')
    <script>
        $('main').removeClass("py-5");
    </script>

@endsection
