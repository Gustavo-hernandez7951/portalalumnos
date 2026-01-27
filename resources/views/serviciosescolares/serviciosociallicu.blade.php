@extends('layouts.licu')

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
                <div class="card-header">SERVICIO SOCIAL</div>
                @foreach($serviciosocial as $sersoc => $ss)
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
                        <table class="table table-sm table-hover table-bordered">
                            <tbody>

                                <tr>
                                    <th style="width:200px" class="text-center table-active">TIPO</th>
                                    <td class="text-left">{{$ss['tipo']}}</td>
                                </tr>
                                <tr>
                                    <th class="text-center table-active">DEPENDENCIA</th>
                                    <td class="text-left">{{$ss['dependencia']}}</td>
                                </tr>
                                <tr>
                                    <th class="text-center table-active">PROGRAMA</th>
                                    <td class="text-left">{{$ss['programa']}}</td>
                                </tr>
                                <tr>
                                    <th class="text-center table-active">EJERCICIO</th>
                                    <td class="text-left">{{$ss['ejercico']}}</td>
                                </tr>
                                <tr>
                                    <th class="text-center table-active">INICIO</th>
                                    <td class="text-left">{{$ss['inicio']}}</td>
                                </tr>
                                <tr>
                                    <th class="text-center table-active">TERMINO</th>
                                    <td class="text-left">{{$ss['termino']}}</td>
                                </tr>
                                <tr>
                                    <th class="text-center table-active">ESTADO</th>
                                    <td class="text-left">{{$ss['status']}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="table-responsive row">
                        <table class="table table-bordered">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="text-center ">SOLICITUD</th>
                                    <th scope="col" class="text-center">HISTORIAL ACADEMICO</th>
                                    <th scope="col" class="text-center">CONSTANCIA NO ADEUDO</th>
                                    <th scope="col" class="text-center">CARTA PRESENTACION</th>
                                    <th scope="col" class="text-center">CARTA ACEPTACION</th>
                                    <th scope="col" class="text-center">CARTA ASIGNACION</th>
                                    <th scope="col" class="text-center">CARTA TERMINACION</th>
                                    <th scope="col" class="text-center">CONSTANCIA ACREDITACION</th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <td class="text-center">{{$ss['solicitud']}}</td>
                                    <td class="text-center">{{$ss['historialacademico']}}</td>
                                    <td class="text-center">{{$ss['constancianoadeudo']}}</td>
                                    <td class="text-center">{{$ss['cartapresentacion']}}</td>
                                    <td class="text-center">{{$ss['cartaaceptacion']}}</td>
                                    <td class="text-center">{{$ss['cartaasignacion']}}</td>
                                    <td class="text-center">{{$ss['cartaterminacion']}}</td>
                                    <td class="text-center">{{$ss['constanciaacreditacion']}}</td>
                                </tr>

                            </tbody>
                        </table>
                    </div>

                    <div class="table-responsive row">
                        <table class="table table-bordered">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="text-center">REPORTE 1</th>
                                    <th scope="col" class="text-center">REPORTE 2</th>
                                    <th scope="col" class="text-center">REPORTE 3</th>
                                    <th scope="col" class="text-center">REPORTE 4</th>
                                    <th scope="col" class="text-center">REPORTE 5</th>
                                    <th scope="col" class="text-center">REPORTE 6</th>
                                    <th scope="col" class="text-center">REPORTE FINAL</th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <td class="text-center">{{$ss['reporte1']}}</td>
                                    <td class="text-center">{{$ss['reporte2']}}</td>
                                    <td class="text-center">{{$ss['reporte3']}}</td>
                                    <td class="text-center">{{$ss['reporte4']}}</td>
                                    <td class="text-center">{{$ss['reporte5']}}</td>
                                    <td class="text-center">{{$ss['reporte6']}}</td>
                                    <td class="text-center">{{$ss['reportefinal']}}</td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection