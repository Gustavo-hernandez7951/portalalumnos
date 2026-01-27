@extends('layouts.macu')

@section('content')

@if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
@endif

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12 col-md-offset-2">
            <div class="card card-navy">
                <div class="card-header">
                    <label class="col-md-12 col-form-label text-md-center"> <h3><strong>CALIFICACIONES</strong></h3> <br> 
                    Esta información es de carácter informativo y carece de validez oficial
                    </label>
                </div>

                <div class="card-body">

                    <div class="row">
                        <div class="col-md-6 col-lg-6">
                            <!-- Correo Programa academico -->
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right">MATRICULA:</label>
                                <p class="col-md-8 col-form-label text-md-left">{{ Auth::user()->cuenta }}</p>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right">NOMBRE:</label>
                                <p class="col-md-8 col-form-label text-md-left">{{ Auth::user()->nombre }}</p>
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-6">
                            <!-- Correo Programa academico -->
                            <div class="info-box mb-3 bg-navy">
                                <span class="info-box-icon"><i class="fas fa-calendar-check"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">SISTEMA MODULAR</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive row">
                        <table class="table table-hover table-bordered">
                            <thead class="thead-light" style="text-align:center;">
                                <tr>
                                    <th class="align-middle">#</th>
                                    <th class="align-middle">CLAVE</th>
                                    <th class="align-middle">ASIGNATURA</th>
                                    <th class="align-middle">CALIFICACIÓN</th>
                                    <th class="align-middle">TIPO EXAMEN</th>
                                    <th class="align-middle">PERIODO</th>
                                    <th class="align-middle">DOCENTE</th>
                                    <th class="align-middle">DESCARGAR BOLETA</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $i = 1; ?>
                            @foreach($calificaciones as $calificacion)
                                <tr>
                                    <th scope="row" class="text-center">{{$i++}}</th>
                                    <td class="text-center">{{$calificacion->clave_mat}}</td>
                                    <td class="text-center">{{$calificacion->asignatura}}</td>
                                    <td class="text-center">{{$calificacion->calificacion}}</td>
                                    <td class="text-center">{{$calificacion->catalogo_tipoexamen->descripcion_tipoexamen}}</td>
                                    <td class="text-center">{{$calificacion->periodo}}</td>
                                    <td class="text-center" style="text-transform:uppercase">{{$calificacion->catalogo_docente->siglas_titulo}}
                                                            {{$calificacion->catalogo_docente->nombre}}
                                                            {{$calificacion->catalogo_docente->paterno}}
                                                            {{$calificacion->catalogo_docente->materno}}</td>
                                    <td class="text-center">
                                        <a href="{{ route('boletaPDFindividual', $calificacion->idcalificacion) }}" 
                                        class="btn btn-sm btn-success">
                                            <i class="fas fa-download"></i>
                                        </a>
                                    </td>                                     
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        <!-- Correo Programa academico 
                        <a href="{{ ($btnDescargar != 'disabled') ? route('boletaPDF') : 'javascript:void(0);' }}"
                            class="btn btn-outline-success btn-lg btn-block"
                            @if($btnDescargar == 'disabled') style="pointer-events: none; opacity: 0.5;" @endif>
                            <i class="fas fa-download"></i> Descargar Boleta
                        </a> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection