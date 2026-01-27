@extends('layouts.licu')

@section('content')

<style>
    .titulo-privacidad {
        font-size: 28px;
        font-weight: bold;
        color: #001f3f;
        text-align: center;
    }

    .texto-privacidad {
        font-size: 16px;
        text-align: justify;
        line-height: 1.6;
    }

    .header-doc {
        background-color: #001f3f;
        color: white;
        text-align: center;
        font-weight: bold;
        padding: 10px;
    }

    .card-doc {
        border-radius: 6px;
        overflow: hidden;
        border: 1px solid #1b2a41;
    }
</style>

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-10 col-md-offset-2">
            
            <div class="card card-navy">
                <div class="card-header text-center">
                    <strong>AVISO DE PRIVACIDAD</strong>
                </div>

                <div class="card-body">
                    <p class="texto-privacidad mb-4">
                        El Aviso de Privacidad del Centro Universitario Hidalguense (CUH) establece las bases y procedimientos para el tratamiento lícito, controlado e informado de los datos personales recabados por la institución. 
                        En él se detallan las finalidades del uso de la información, las medidas de seguridad implementadas para su protección
                        y los mecanismos mediante los cuales los titulares pueden ejercer sus Derechos ARCO, conforme a la normativa aplicable en materia de protección de datos personales.
                    </p>

                    <div class="row mt-3">

                        <!-- Aviso de Privacidad -->
                        <div class="col-md-6 mb-4">
                            <div class="card card-doc shadow">
                                <div class="header-doc">Aviso de Privacidad</div>
                                <iframe src="https://drive.google.com/file/d/1ygFP5adR4YHFU_UpRVZrs250PV4IJ4lh/preview"
                                        width="100%" height="480" allow="autoplay">
                                </iframe>
                            </div>
                        </div>

                        <!-- Solicitud ARCO -->
                        <div class="col-md-6 mb-4">
                            <div class="card card-doc shadow">
                                <div class="header-doc">Solicitud de Derechos ARCO</div>
                                <iframe src="https://drive.google.com/file/d/1HeTPoncsEHcdtL2HC3Bl_F-DF5AnqTlX/preview"
                                        width="100%" height="480" allow="autoplay">
                                </iframe>
                            </div>
                        </div>

                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

@endsection