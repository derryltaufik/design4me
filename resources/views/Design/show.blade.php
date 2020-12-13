@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mb-4">
            <h1> Edit Your Design</h1>
        </div>


        <div class="row">
            <div class="col">
                <div class="shirt-box bg-white d-inline-flex">
                    <img class="shirt-image" src="{{asset('/images/shirt_template.png')}}"   >
                    <div class="design-image-wrapper">
                        <img class="design-image" src="{{asset('storage/'.$design->design_svg)}}">
                    </div>

                </div>
            </div>

            <div class="col">

                <h1> Title </h1>
                <p >{{$design->title}}</p>

                <h1> Description </h1>
                <p>{{$design->description}}</p>

                <h1> Visibility </h1>
                <p>{{$design->visibility}}</p>

                <p>Public: Everyone can view and buy your design <br>
                    Private: Only you can view and buy your design </p>
                <br>

                <div class="row">
                    <div class="col">
                        <form method= "get" action="{{route('designs.edit', $design)}}">
                            @csrf
                            <button type="submit" class="btn btn-primary btn-lg btn-block">Edit
                                Design
                            </button>
                        </form>
                    </div>
                    <div class="col">
                        <form method= "post" action="{{route('designs.destroy', $design)}}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-lg btn-block">Delete
                                Design
                            </button>
                        </form>
                    </div>
                </div>

            </div>

        </div>


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
        }

        .shirt-image {
            max-width: 100%;
            max-height: 100%;
        }
    </style>
@endsection
@section('scripts')
    <script>

    </script>
@endsection
