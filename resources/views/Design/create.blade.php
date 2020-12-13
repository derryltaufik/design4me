@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mb-4">
            <h1> Create Your Design</h1>
        </div>

        <form action="{{route('designs.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-4">

                    <div class ="form-group">
                        <label for="title"> Title </label>
                        <input type="text" name="title" class="form-control" id="title" aria-describedby="" placeholder="Enter Title">
                    </div>

                    <div class ="form-group">
                        <label for="description"> Description </label>
                        <textarea name="description" id="body" cols="30" rows="5" class="form-control"></textarea>
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

                    <button type="button" class="btn btn-primary btn-lg btn-block" onclick="submitDesign()">Create
                        Design
                    </button>

                </div>
                <div class="col">
                    <div class="shirt-box bg-white d-inline-flex">
                        <img class="shirt-image" src="{{asset('/images/shirt_template.png')}}"   >
                        <div id="canvas-wrapper">
                            <canvas id="design-canvas"> please use different browser </canvas>
                        </div>

                    </div>
                </div>
                <input type="textarea" name ="design_image" id="design_image" class="d-none">
                <input type="textarea" name ="design_svg" id="design_svg" class="d-none">
                <input type="textarea" name ="design_json" id="design_json" class="d-none">
            </div>
        </form>
    </div>

@endsection

@section('styles')
    <style>
        .shirt-box{
            position:relative;
        }

        #canvas-wrapper{

            position: absolute;
            top:50%;
            left:50%;
            transform: translate(-50%, -70%);
            width: 35%;
        }

        canvas{
            z-index: 1;

            border-style: dotted;
            border-width: 1px;
        }

        .shirt-image {
            max-width: 100%;
            max-height: 100%;
        }
    </style>
@endsection
@section('scripts')
    <script>
        // resize the canvas to A4 size ratio
        let canvasWidth = $('#canvas-wrapper').width();
        $('#canvas-wrapper').height(canvasWidth * 1.4142);
        let canvasHeight =  $('#canvas-wrapper').height();

        let canvas = document.getElementById('design-canvas');
        canvas.width  = canvasWidth;
        canvas.height = canvasHeight;

        // creating fabric canvas

        canvas = new fabric.Canvas('design-canvas');


        document.getElementById('imgLoader').onchange = function handleImage(e) {
            var reader = new FileReader();
            reader.onload = function (event) {
                var imgObj = new Image();
                imgObj.src = event.target.result;
                imgObj.onload = function () {
                    image = new fabric.Image(imgObj);

                    let scale = 0

                    if (image.length > image.width) {
                        scale = canvas.length / (1.2 * image.length);

                    } else {
                        scale = canvas.width / (1.2 * image.width);
                    }

                    image.set({
                        scaleX: scale,
                        scaleY: scale
                    });
                    canvas.centerObject(image);
                    canvas.add(image);
                    canvas.renderAll();
                }
            }
            reader.readAsDataURL(e.target.files[0]);
        }

        $('html').keyup(function (e) {
            if (e.keyCode == 46) {
                canvas.getActiveObjects().forEach((obj) => {
                    canvas.remove(obj)
                });
                canvas.discardActiveObject().renderAll()
            }
        });
        $("#addText").click(function () {

            text = new fabric.IText('Double Click To Edit', {
                fontFamily: 'Helvetica',
                fontSize: 20
            });


            canvas.add(text);
            canvas.centerObject(text);
            canvas.renderAll();

        });

        function submitDesign(){
            let dataURL = canvas.toDataURL("image/png",1.0);
            $('#design_image').val(dataURL);

            let svgData = canvas.toSVG();
            $('#design_svg').val(svgData);

            let jsonData = JSON.stringify(canvas.toJSON());

            console.log(jsonData);
            $('#design_json').val(jsonData);

            $('form').submit();
        }


    </script>
@endsection
