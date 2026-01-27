@extends('layouts.licu')

@section('content')

<!-- botonModal -->



@if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
@endif


<!-- <div class="container">
    <iframe scrolling="auto" frameborder="0" src="dist/documentos/ESTUDIOSOCIOECONOMICOCUH2021-2.pdf" style = "background: #000;border: none; width: 100%; height: 100vh;" class="responsive-iframe"></iframe> 
</div>  -->


<!-- <div class="d-none d-lg-block">
    Pantalla grande
</div>

<div class="d-lg-none">
    pantalla chica
</div>

<div class="embed-container">
    <iframe src="dist/documentos/ESTUDIOSOCIOECONOMICOCUH2021-2.pdf" frameborder="0" allowfullscreen></iframe>
</div> -->


<div class="d-none d-lg-block">
    <div class="container">
        <div class="jumbotron mt-3">
            <h1>Formato de estudio socio económico</h1>
            <p class="lead" style="text-align: justify;">
                Es un documento que permite conocer el entorno social y económico de una persona en particular, se trata de una investigación que tiene como objetivo dilucidar los aspectos propios de un individuo.
            </p>
            <p style="text-align: justify;">
                Este documento es indispensable cuando se solicite la beca. 
                Una vez descargado, impreso, contestado y firmado es necesario presentarlo al área de administración para continuar con el proceso de solicitud.
            </p>
            <a class="btn btn-lg btn-primary" href="dist/documentos/ESTUDIOSOCIOECONOMICOCUH2021-2.pdf" role="button" download>
                Descargar documento
            </a>
        </div>
    </div>
</div>

<div class="d-lg-none">
    <div class="container">
        <div class="jumbotron mt-3">
            <center><h1>Formato de estudio socio económico</h1></center>
            <p class="lead" style="text-align: justify;">
                Es un documento que permite conocer el entorno social y económico de una persona en particular, se trata de una investigación que tiene como objetivo dilucidar los aspectos propios de un individuo.
            </p>
            <p style="text-align: justify;">
                Este documento es indispensable cuando se solicite la beca. 
                Una vez descargado, impreso, contestado y firmado es necesario presentarlo al área de administración para continuar con el proceso de solicitud.
            </p>
            <center>
                <a class="btn btn-lg btn-primary" href="dist/documentos/ESTUDIOSOCIOECONOMICOCUH2021-2.pdf" role="button" download>
                    Descargar documento
                </a>
            </center>
        </div>
    </div>
</div>



@endsection



