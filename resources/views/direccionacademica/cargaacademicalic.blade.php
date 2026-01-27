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
                <div class="card-header">MATUTINO
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
                            @foreach($camts as $camt)
                                <tr>
                                    <td class="text-center">{{$camt->clave_mat}}</td>
                                    <td class="text-center">{{$camt->asignatura}}</td>
                                    <td class="text-center">{{$camt->nombre_docente}}</td>
                                    <td class="text-center">{{$camt->grupo}}</td>
                                    <td class="text-center">{{substr($camt->dias, 3)}}</td>
                                    <td class="text-center">{{substr($camt->horario, 3)}}</td>
                                    <td class="text-center">{{$camt->ubicacion}}</td>
                                    <td class="text-center">{{$camt->inicio}}</td>
                                    <td class="text-center">{{$camt->termino}}</td>
                                    <td class="text-center">{{$camt->examen_fin}}</td>
                                    <td class="text-center">{{$camt->examen_ext}}</td>
                                    <td class="text-center">{{$camt->calendario_periodo->periodo}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="card card-navy collapsed-card">
                <div class="card-header">VESPERTINO
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
                                    <th scope="col" class="text-center">DIA 2</th>
                                    <th scope="col" class="text-center">HORA 2</th>
                                    <th scope="col" class="text-center">UBICACION 2</th>
                                    <th scope="col" class="text-center">INICIO</th>
                                    <th scope="col" class="text-center">TERMINACION</th>
                                    <th scope="col" class="text-center">EXAMEN FINAL</th>
                                    <th scope="col" class="text-center">EXAMEN EXTRA</th>
                                    <th scope="col" class="text-center">PERIODO</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($cavss as $cavs)
                                <tr>
                                    <td class="text-center">{{$cavs->clave_mat}}</td>
                                    <td class="text-center">{{$cavs->asignatura}}</td>
                                    <td class="text-center">{{$cavs->nombre_docente}}</td>
                                    <td class="text-center">{{$cavs->grupo}}</td>
                                    <td class="text-center">{{substr($cavs->dias, 3)}}</td>
                                    <td class="text-center">{{substr($cavs->horario, 3)}}</td>
                                    <td class="text-center">{{$cavs->ubicacion}}</td>
                                    <td class="text-center">{{substr($cavs->dias2, 3)}}</td>
                                    <td class="text-center">{{substr($cavs->horario2, 3)}}</td>
                                    <td class="text-center">{{$cavs->ubicacion2}}</td>
                                    <td class="text-center">{{$cavs->inicio}}</td>
                                    <td class="text-center">{{$cavs->termino}}</td>
                                    <td class="text-center">{{$cavs->examen_fin}}</td>
                                    <td class="text-center">{{$cavs->examen_ext}}</td>
                                    <td class="text-center">{{$cavs->calendario_periodo->periodo}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="card card-navy collapsed-card">
                <div class="card-header">MIXTO
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
                                    <th scope="col" class="text-center">DIA 2</th>
                                    <th scope="col" class="text-center">HORA 2</th>
                                    <th scope="col" class="text-center">UBICACION 2</th>
                                    <th scope="col" class="text-center">INICIO</th>
                                    <th scope="col" class="text-center">TERMINACION</th>
                                    <th scope="col" class="text-center">EXAMEN FINAL</th>
                                    <th scope="col" class="text-center">EXAMEN EXTRA</th>
                                    <th scope="col" class="text-center">PERIODO</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($camxs as $camx)
                                <tr>
                                    <td class="text-center">{{$camx->clave_mat}}</td>
                                    <td class="text-center">{{$camx->asignatura}}</td>
                                    <td class="text-center">{{$camx->nombre_docente}}</td>
                                    <td class="text-center">{{$camx->grupo}}</td>
                                    <td class="text-center">{{substr($camx->dias, 3)}}</td>
                                    <td class="text-center">{{substr($camx->horario, 3)}}</td>
                                    <td class="text-center">{{$camx->ubicacion}}</td>
                                    <td class="text-center">{{substr($camx->dias2, 3)}}</td>
                                    <td class="text-center">{{substr($camx->horario2, 3)}}</td>
                                    <td class="text-center">{{$camx->ubicacion2}}</td>
                                    <td class="text-center">{{$camx->inicio}}</td>
                                    <td class="text-center">{{$camx->termino}}</td>
                                    <td class="text-center">{{$camx->examen_fin}}</td>
                                    <td class="text-center">{{$camx->examen_ext}}</td>
                                    <td class="text-center">{{$camx->calendario_periodo->periodo}}</td>
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