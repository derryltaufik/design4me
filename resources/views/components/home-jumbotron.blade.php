<div class="jumbotron text-center jumbotron-fluid bg-dark">

    <div class="jumbotron-background">
        <img src="{{asset('images/jumbotron-bg.jpg')}}" class="blur ">
    </div>

    <div class="container text-white">

        <h1 class="display-4">Design4Me <br> Create your own design for just Rp50.000 </h1>
        <p class="lead">This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
        <hr class="my-4">
        <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
        <a class="btn btn-outline-light btn-lg" href="{{route("designs.create")}}" role="button">Create Design</a>

    </div>
    <!-- /.container -->


</div>
<!-- /.jumbotron -->

<!--
For IE support of object-fit add this to your document
&lt;script src="https://cdnjs.cloudflare.com/ajax/libs/object-fit-images/3.2.4/ofi.min.js"&gt;&lt;/script&gt;
-->





<style>


    .jumbotron {
        padding-top: 12%;
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
