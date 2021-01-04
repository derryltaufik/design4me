@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mb-4">
            <h1> Create Your Design</h1>
        </div>

        <form action="{{route('products.store',$productType) }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-4">

                    <label class="btn btn-outline-primary btn-lg btn-block for="imgLoader">
                    <input id="imgLoader" type="file" class="d-none form-control-file">
                    Add Image From Computer
                    </label>

                    <button type="button" class="btn btn-outline-primary btn-lg btn-block " id="addText">Add
                        Text
                    </button>
                    <br>

                    <div class ="form-group">
                        <label for="name"> Name </label>
                        <input type="text" name="name" class="form-control" id="name" aria-describedby="" placeholder="Enter Design Name">
                    </div>

                    <div class ="form-group">
                        <label for="description"> Description </label>
                        <textarea name="description" id="body" cols="30" rows="5" class="form-control"></textarea>
                    </div>

                    <label for="visibility"> Visibility </label>
                    <select name="visibility" class="custom-select">

                        <option selected value ='private'>Private</option>
                        <option value="public">Public</option>
                    </select>

                    <br>
                    <br>

                    <p>Public: Everyone can view and buy your design. You get commission when someone bought your design
                        Private: Only you can view and buy your design
                        You can change it anytime.
                    </p>

                    <div class ="form-group">
                        <label for="Commission"> Commission (Rp.)</label>
                        <input class="w-100" type="number" name="commission" min="0" step= "1000" max="1000000" value="20000">
                    </div>


                    <button type="button" class="btn btn-primary btn-lg btn-block" id='submitBtn' onclick="submitDesign()">Create
                        Design
                    </button>

                </div>
                <div class="col">
                    @php
                    $design = null;
                    @endphp
                    <x-editable-design-shirt :design="$design" :productType="$productType"></x-editable-design-shirt>
                </div>

            </div>
        </form>
    </div>

@endsection

<style>
    label{
        font-weight: bold;
    }
</style>
