<div class="jumbotron text-center jumbotron-fluid bg-dark">

    <div class="jumbotron-background">
        <img src="{{asset('images/jumbotron-bg.jpg')}}" class="blur ">
    </div>

    <div class="container text-white">

        <h1 class="display-2"> <b> Design4Me </b>  </h1>
        <h1 class="display-4"> Buy your own customized T-shirt, starting from Rp50.000 </h1>

        <hr class="my-4">

        <a class="btn btn-outline-light btn-lg" href="{{route('productTypes.index')}}" role="button">Create Design</a>

    </div>
    <!-- /.container -->


</div>


<style>


    .jumbotron {
        padding-top: 8%;
        padding-bottom: 12%;
        position:relative;
        overflow:hidden;
    }

    .jumbotron .container {
        position:relative;
        z-index:2;

        background:rgba(0,0,0,0.5);
        padding:2rem;
        border:1px solid rgba(0,0,0,0.1);
        border-radius:3px;
    }

    .jumbotron-background {
        object-fit:cover;
        font-family: 'object-fit: cover;';
        position:absolute;
        top:0;
        z-index:1;
        width:100%;
        height:100%;
        opacity:0.5;
    }

    img.blur {
        -webkit-filter: blur(4px);
        filter: blur(4px);
        filter:progid:DXImageTransform.Microsoft.Blur(PixelRadius='4');
        max-width: 100%;
        height: auto;

    }

</style>
