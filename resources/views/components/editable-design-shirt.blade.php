<div class="shirt-box bg-white d-inline-flex">
    <img class="shirt-image" src="{{asset('/images/shirt_template.png')}}"   >
    <div id="canvas-wrapper">
        <canvas id="design-canvas"> please use different browser </canvas>
    </div>

</div>
<input type="textarea" name ="design_image" id="design_image" class="d-none">
<input type="textarea" name ="design_svg" id="design_svg" class="d-none">
<input type="textarea" name ="design_json" id="design_json" class="d-none">

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

<script>
    let canvas;
    $().ready( function(){
// resize the canvas to A4 size ratio
        let canvasWidth = $('#canvas-wrapper').width();
        $('#canvas-wrapper').height(canvasWidth * 1.4142);
        let canvasHeight =  $('#canvas-wrapper').height();

        canvas = document.getElementById('design-canvas');
        canvas.width  = canvasWidth;
        canvas.height = canvasHeight;

        // creating fabric canvas

        canvas = new fabric.Canvas('design-canvas');

        // inserting saved design
        @if( $design )
        fabric.loadSVGFromURL('{{asset('storage/'.$design->design_svg)}}', function(objects, options) {
            let obj = fabric.util.groupSVGElements(objects, options);
            canvas.add(obj).renderAll();
        });

        function callback(objects, options) {
            canvas.add.apply(canvas, objects);
            canvas.renderAll();
        }
        @endif

    });

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
