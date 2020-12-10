@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h1> Create Your Design</h1>
        </div>
        <div class="row">
            <div class="col">
                <div class="shirt-box bg-white d-inline-flex">
                    <img class="shirt-image" src="{{asset('/images/shirt_template.png')}}" alt="asfd" >
                    <canvas id="customDesign"> please use different browser </canvas>
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

        canvas{
            position: absolute;

            top:50%;
            left:50%;
            transform: translate(-50%, -50%);

            z-index: 1;
            width: 35%;
            border-style: dotted;
            border-width: 2px;
        }

        .shirt-image {
            max-width: 100%;
            max-height: 100%;
        }
    </style>
@endsection
@section('scripts')
    <script>
        let canvas = new fabric.Canvas("customDesign");
        console.log(canvas.width);
        canvas.setHeight(canvas.width * 1.4142);
        canvas.renderAll();
    </script>
@endsection
