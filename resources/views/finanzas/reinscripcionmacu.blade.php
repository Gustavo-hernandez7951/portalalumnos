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
                <div class="card-header">REINSCRIPCION</div>
                @foreach($dps as $dp => $d)
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
                        <table class="table table-bordered">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="text-center">PERIODO DE INICIO</th>
                                    <th scope="col" class="text-center">INICIO DE CURSOS</th>
                                    <th scope="col" class="text-center">MESES DE REINSCRIPCION</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-center">{{$d['periodo']}}</td>
                                    <td class="text-center">{{$d['inicio']}}</td>
                                    <td class="text-center">ENERO<br>MAYO<br>SEPTIEMBRE</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="alert bg-navy" role="alert">
                            <label class="col-md-12 col-form-label text-md-center">Recuerda que tu pago debe ser realizado en tiempo y forma, dentro del mes correspondiente.</label>
                    </div>

                    <div class="alert bg-navy" role="alert">
                            <label class="col-md-12 col-form-label text-md-center">En caso de realizar Transferencia Bancaria deberá ser realizado 3 días antes del dia 10 del mes correspondiente.</label>
                    </div>

                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection