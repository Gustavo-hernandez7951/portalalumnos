@extends('layouts.layout')

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
                <div class="card-header">CARGA ACADEMICA</div>

                <div class="card-body">

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label text-md-right">MATRICULA:</label>
                        <p class="col-md-4 col-form-label text-md-left">{{ Auth::user()->cuenta }}</p>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label text-md-right">NOMBRE:</label>
                        <p class="col-md-4 col-form-label text-md-left">{{ Auth::user()->nombre }}</p>
                    </div>

                </div>               
            </div>

            <div class="card card-navy collapsed-card">
                <div class="card-header">SABATINO
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-plus"></i>
                    </div>
                </div>

                <div class="card-body">
                    
                    <div class="table-responsive row">
                        <table class="table table-sm table-hover table-bordered">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="text-center">CLAVE</th>
                                    <th scope="col" class="text-center">ASIGNATURA</th>
                                    <th scope="col" class="text-center">DOCENTE</th>
                                    <th scope="col" class="text-center">GRUPO</th>
                                    <th scope="col" class="text-center">DIAS</th>
                                    <th scope="col" class="text-center">HORA</th>
                                    <th scope="col" class="text-center">UBICACION</th>
                                    <th scope="col" class="text-center">INICIO</th>
                                    <th scope="col" class="text-center">TERMINACION</th>
                                    <th scope="col" class="text-center">EXAMEN FINAL</th>
                                    <th scope="col" class="text-center">EXAMEN EXTRA</th>
                                    <th scope="col" class="text-center">PERIODO</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($casbs as $casb)
                                <tr>
                                    <td class="text-center">{{$casb->clave_mat}}</td>
                                    <td class="text-center">{{$casb->asignatura}}</td>
                                    <td class="text-center">{{$casb->nombre_docente}}</td>
                                    <td class="text-center">{{$casb->grupo}}</td>
                                    <td class="text-center">{{substr($casb->dias, 3)}}</td>
                                    <td class="text-center">{{substr($casb->horario, 3)}}</td>
                                    <td class="text-center">{{$casb->ubicacion}}</td>
                                    <td class="text-center">{{$casb->inicio}}</td>
                                    <td class="text-center">{{$casb->termino}}</td>
                                    <td class="text-center">{{$casb->examen_fin}}</td>
                                    <td class="text-center">{{$casb->examen_ext}}</td>
                                    <td class="text-center">{{$casb->calendario_periodo->periodo}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection