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
                <div class="card-header">ADEUDOS</div>

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
                                    <th scope="col" class="text-center">FOLIO ADEUDO</th>
                                    <th scope="col" class="text-center">CLAVE SERVICIO</th>
                                    <th scope="col" class="text-center">CONCEPTO ADEUDO</th>
                                    <th scope="col" class="text-center">SUBTOTAL</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $i = 1; ?>
                            @foreach($datostabla as $ade => $a)
                                <tr>
                                    <th scope="row" class="text-center">{{$i++}}</th>
                                    <td class="text-center">{{$a['folioadeudo']}}</td>
                                    <td class="text-center">{{$a['claveservicio']}}</td>
                                    <td class="text-center">{{$a['conceptoadeudo']}}</td>
                                    <td class="text-center">$ {{$a['subtotal']}}</td>                            
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="alert alert-info" role="alert">
                        <div class="row">
                            <label class="col-md-6 col-form-label text-md-right">TOTAL ADEUDO:</label>
                            <p class="col-md-4 col-form-label text-md-left"><strong>$ {{ number_format($total, 2) }}</strong></p>
                        </div>
                    </div>

                    <div class="alert alert-danger" role="alert">
                            <label class="col-md-12 col-form-label text-md-center">Recuerda realizar los depósitos de tu colegiatura del 01 al 20 de cada mes en días hábiles.</label>
                    </div>
			
		    <div class="alert alert-danger" role="alert">
                            <label class="col-md-12 col-form-label text-md-center">En caso de realizar Transferencia Bancaria o Via Telecom deberá ser realizado del 01 al 17 de cada mes en días hábiles.</label>
                    </div>

		    <div class="alert alert-danger" role="alert">
                            <label class="col-md-12 col-form-label text-md-center">Recuerda que los depositos se aplican de 24 a 36 horas despues de haber realizado tu deposito, cualquier duda favor de comunicarse al departamento de Tesoreria del CUH.</label>
                    </div>

		    <div class="alert alert-warning" role="alert">
                            <label class="col-md-12 col-form-label text-md-center">El estado de cuenta mostrado corresponde a la fecha y hora de consulta; En caso de atraso el importe se calcula diariamente, los adeudos pueden cambiar de presentarse situaciones especiales.</label>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection