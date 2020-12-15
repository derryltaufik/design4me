@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mb-4">
            <h1> My Design</h1>
        </div>


        <div class="row">
            <div class="col">
                <x-design-shirt :design="$design">

                </x-design-shirt>
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
                            <button type="submit" class="btn btn-outline-primary btn-lg btn-block">Edit
                                Design
                            </button>
                        </form>
                    </div>
                    <div class="col">
                        <form method= "post" action="{{route('designs.destroy', $design)}}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger btn-lg btn-block">Delete
                                Design
                            </button>
                        </form>
                    </div>
                </div>

                <div class="row">
                    <div class = "col">
                        <p> <h2> Add To Cart </h2> </p>
                    </div>
                </div>

                <form method= "post" action="{{route('carts.atc', $design)}}">
                    @csrf
                    <div class="row my-2">
                        <div class="col">
                            <label for="quantity"> Quantity</label>
                            <input class="w-100" type="number" name="quantity" min="1" value="1">
                        </div>


                    </div>
                    <div class="row">
                        <div class="col">

                            <button type="submit" class="btn btn-primary btn-lg btn-block">Add To Cart
                            </button>

                        </div>
                    </div>

                </form>

            </div>

        </div>


    </div>

    </div>

@endsection
