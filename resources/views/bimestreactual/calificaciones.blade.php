@extends('layouts.layout')

@section('content')

@if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
@endif

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-10 col-md-offset-2">
            <div class="card card-navy">
                <div class="card-header">CALIFICACIONES</div>

                <div class="card-body">

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label text-md-right">MATRICULA:</label>
                        <p class="col-md-4 col-form-label text-md-left">{{ Auth::user()->cuenta }}</p>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label text-md-right">NOMBRE:</label>
                        <p class="col-md-4 col-form-label text-md-left">{{ Auth::user()->nombre }}</p>
                    </div>

                    <div class="table-responsive row">
                        <table class="table table-hover table-bordered">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="text-center">#</th>
                                    <th scope="col" class="text-center">CLAVE</th>
                                    <th scope="col" class="text-center">ASIGNATURA</th>
                                    <th scope="col" class="text-center">CALIFICACION</th>
                                    <th scope="col" class="text-center">TIPO EXAMEN</th>
                                    <th scope="col" class="text-center">PERIODO</th>
                                    <th scope="col" class="text-center">DOCENTE</th>
                                    <!-- <th scope="col">Extraordinario</th> -->
                                    <!-- <th scope="col">Evaluacion Docente</th> -->
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
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        <div class="alert alert-warning" role="alert">
                            <label class="col-md-12 col-form-label text-md-center">Esta información es de carácter informativo y carece de validez oficial</label>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection