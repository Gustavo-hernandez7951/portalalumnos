@extends('layouts.licu')

@section('content')

@if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
@endif

<!-- Modal mensaje autoopen -->
<div class="modal fade" id="autoopen" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">AVISO</h5>
            </div>
            <div class="modal-body">
                <p align="justify">
                    A través de este medio se les informa que <strong>la fecha límite para el pago de la colegiatura del mes correspondiente</strong> será la siguiente:
                </p>
                <p align="justify">
                    <strong>• Pagos mediante transferencia bancaria:</strong> del dia 1 hasta el <strong>día 17</strong> del mes correspondiente.<br>
                    <strong>• Pagos realizados directamente en ventanilla bancaria:</strong> hasta el <strong>día 20</strong> del mes correspondiente. <br>
                    <strong>Si la fecha límite es un día inhábil bancario, el pago deberá realizarse con anticipación.</strong> 
                </p>
                <p align="justify">
                    Con el fin de mejorar el servicio y respetar las becas otorgadas a los alumnos que cuentan con este beneficio, 
                    <strong>les solicitamos realizar sus pagos en tiempo y forma</strong>, preferentemente 
                    <strong>a través de depósitos o transferencias bancarias.</strong>
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info btn-lg btn-block" data-dismiss="modal">Aceptar</button>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12 col-md-offset-2">
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

                    <div class="alert bg-navy" role="alert">
                            <label class="col-md-12 col-form-label text-md-center">Recuerda realizar los depósitos de tu colegiatura del 01 al 20 de cada mes en días hábiles.</label>
                    </div>
			
            <div class="alert bg-navy" role="alert">
                <label class="col-md-12 col-form-label text-md-center">En caso de realizar Transferencia Bancaria o Via Telecom deberá ser realizado del 01 al 17 de cada mes en días hábiles.</label>
            </div>

            <div class="alert bg-navy" role="alert">
                    <label class="col-md-12 col-form-label text-md-center">Recuerda que los depositos se aplican de 24 a 36 horas despues de haber realizado tu deposito, cualquier duda favor de comunicarse al departamento de Tesoreria del CUH.</label>
            </div>

            <div class="alert bg-navy" role="alert">
                    <label class="col-md-12 col-form-label text-md-center">El estado de cuenta mostrado corresponde a la fecha y hora de consulta; En caso de atraso el importe se calcula diariamente, los adeudos pueden cambiar de presentarse situaciones especiales.</label>
            </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection