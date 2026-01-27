@extends('layouts.licu')

@section('content')

@if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
@endif

<!-- Modal mensaje autoopen -->
<div class="modal fade" id="{{$autoopen}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">AVISO</h5>
            </div>
            <?php if($status=='SR') : ?>
                <div class="modal-body">
                    <p align="justify">Le informamos que su solicitud de renovación anual de beca ha sido rechazada, le sugerimos ponerse en contacto con la Dirección de Administración para mayores informes.</p>
                    <p align="justify"><strong>Contacto</strong><br><a href="mailto:administracion@cuh.edu.mx">administracion@cuh.edu.mx</a><br>771 719 53 00 (01) ext 122</p>    
                </div>
            <?php elseif(($status=='ST')) : ?>
                <div class="modal-body">
                    <p align="justify">Le informamos que su solicitud de otorgamiento de beca ha sido preautorizada, para finalizar su trámite es necesario pasar a Dirección de Administración a firma de documentos.</p>   
                </div>
            <?php else : ?>
                
            <?php endif; ?>
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
                <div class="card-header">OTORGAMIENTO</div>
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

            <div class="card card-navy">
                <!-- MENSAJE BTN RENOVAR -->
                @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
                @endif
                @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif
                <!-- Tabla Datos Beca -->
                <div class="card-header">INFORMACION BECA</div>
                <div class="card-body">
                    <div class="table-responsive row">
                        <table class="table table-sm table-hover table-bordered">
                            <tbody>
                                @foreach($dps as $dp)
                                <tr>
                                    <th style="width:300px" class="text-center table-active">BECA ACTIVA</th>
                                    <td class="text-left">{{$dp['beca']}}</td>
                                </tr>
                                <tr>
                                    <th class="text-center table-active">TIPO DE BECA</th>
                                    <td class="text-left">{{$dp['tipo_beca']}}%</td>
                                </tr>
                                <tr>
                                    <th class="text-center table-active">MODALIDAD BECA</th>
                                    <td class="text-left">{{$dp['modalidadbeca']}}</td>
                                </tr>
                                <tr>
                                    <th class="text-center table-active">VIGENCIA</th>
                                    <td class="text-left">{{$dp['vigencia']}}</td>
                                </tr>
                                <tr>
                                    <th class="text-center table-active">CALIFICACION CONDICIONADA</th>
                                    <td class="text-left">{{$dp['calif_condicionada']}}</td>
                                </tr>
                                <tr>
                                    <th class="text-center table-active">REVISION</th>
                                    <td class="text-left">{{$dp['revision_calif']}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <form method="post" action="{{ route('solicitarbeca') }}">
                    {{ csrf_field() }}
                    <input type="submit" class="btn btn-outline-primary btn-lg btn-block" value="Solicitar otorgamiento de beca" {{$btnBeca}}/>
                    </form>
                </div>
            </div>

            <div class="card card-navy">
                <!-- Tabla Renovacion Beca -->
                <div class="card-header">SOLICITUD OTORGAMIENTO DE BECA</div>
                <div class="card-body">
                    @foreach($smbs as $smb)
                    <div class="info-box mb-3 bg-{{$infobox}}">
                        <span class="info-box-icon"><i class="fas fa-info-circle"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">ESTADO DE SOLICITUD</span>
                            <span class="info-box-number">{{$smb['status_solicitud']}}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <div class="table-responsive row">
                        <table class="table table-sm table-hover table-bordered">
                            <tbody>                              
                                <tr>
                                    <th style="width:300px" class="text-center table-active">FECHA SOLICITUD</th>
                                    <td class="text-left">{{$smb['fecha_solicitud']}}</td>
                                </tr>
                                <tr>
                                    <th class="text-center table-active">TIPO SOLICITUD</th>
                                    <td class="text-left">{{$smb['tipo_solicitud']}}</td>
                                </tr>
                                <tr>
                                    <th class="text-center table-active">MATRICULA</th>
                                    <td class="text-left">{{$smb['matricula']}}</td>
                                </tr>
                                <tr>
                                    <th class="text-center table-active">TIPO BECA</th>
                                    <td class="text-left">{{$smb['tipo_beca']}}</td>
                                </tr>
                                <tr>
                                    <th class="text-center table-active">MODALIDAD BECA</th>
                                    <td class="text-left">{{$smb['modalidadbeca']}}</td>
                                </tr>
                                <tr>
                                    <th class="text-center table-active">CICLO SOLICITUD</th>
                                    <td class="text-left">{{$smb['ciclo_solicitud']}}</td>
                                </tr>                           
                            </tbody>
                        </table>
                    </div>

                    <div align="center">
                        <a href="{{ route('constanciaobPDF') }}"><button type="button" class="btn btn-outline-success btn-lg btn-block" {{$btnConstancia}}><i class="fas fa-download"></i> Descargar Constancia</button></a>
                    </div>
                    @endforeach
                </div>

                <div class="alert bg-navy" role="alert">
                    <label class="col-md-12 col-form-label text-md-center">La Beca entra en vigencia a partir del año en que se otorgo.</label>
                </div>

                <div class="alert bg-navy" role="alert">
                    <label class="col-md-12 col-form-label text-md-center">Dar seguimiento al status de la solicitud y descarga la constancia de beca.</label>
                </div>

                <div class="alert bg-navy" role="alert">
                    <label class="col-md-12 col-form-label text-md-center">Para cualquier aclaración al respecto acudir o llamar a la Dirección de Administración.</label>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection