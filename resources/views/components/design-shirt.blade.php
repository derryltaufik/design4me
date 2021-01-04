<div class="shirt-box bg-white d-inline-flex" >
    <img class="shirt-image" src="{{asset($productType->image)}}"   >

    <div class="design-image-wrapper">
        @if($design)
        <img class="design-image" src="{{asset('storage/'.$design->design_svg)}}">
        @endif
    </div>


</div>

<style>
    .shirt-box{
        position:relative;
    }

    .design-image-wrapper{

        position: absolute;
        top:50%;
        left:50%;
        transform: translate(-50%, -45%);
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
