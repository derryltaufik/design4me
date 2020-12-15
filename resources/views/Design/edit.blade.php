@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mb-4">
            <h1> Edit Your Design</h1>
        </div>

        <form action="{{route('designs.update', $design)}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-4">

                    <div class ="form-group">
                        <label for="title"> Title </label>
                        <input type="text" name="title" class="form-control" id="title" aria-describedby="" placeholder="Enter Title" value="{{$design->title}}">
                    </div>

                    <div class ="form-group">
                        <label for="description"> Description </label>
                        <textarea name="description" id="body" cols="30" rows="5" class="form-control">{{$design->description}}</textarea>
                    </div>

                    <label class="btn btn-outline-primary btn-lg btn-block for="imgLoader">
                    <input id="imgLoader" type="file" class="d-none form-control-file">
                    Add Image From Computer
                    </label>

                    <button type="button" class="btn btn-outline-primary btn-lg btn-block " id="addText">Add
                        Text
                    </button>

                    <label for="visibility"> Visibility </label>
                    <select name="visibility" class="custom-select">

                        <option selected value ='private'>Private</option>
                        <option value="public">Public</option>
                    </select>

                    <br>
                    <br>

                    <p>Public: Everyone can view and buy your design
                        Private: Only you can view and buy your design </p>
                    <br>

                    <button type="button" class="btn btn-primary btn-lg btn-block" onclick="submitDesign()">Update
                        Design
                    </button>

                </div>
                <div class="col">
                    <x-editable-design-shirt :design="$design"></x-editable-design-shirt>
                </div>
            </div>
        </form>
    </div>

@endsection
