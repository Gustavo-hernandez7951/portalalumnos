@extends('layouts.licu')

@section('content')

@if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
@endif

<!-- Modal mensaje autoopen -->
<div class="modal fade" id="" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">AVISO</h5>
            </div>
            <div class="modal-body">
                <p align="justify">Le informamos que su solicitud de renovación anual de beca ha sido rechazada, le sugerimos ponerse en contacto con la Dirección de Administración para mayores informes.</p>
                <p align="justify"><strong>Contacto</strong><br><a href="mailto:administracion@cuh.edu.mx">administracion@cuh.edu.mx</a><br>771 719 53 00 (01) ext 122</p>    
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
                <div class="card-header">DATOS FISCALES</div>
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
                <div class="card-header">DATOS FACTURACION</div>
                <div class="card-body">
                    <div class="table-responsive row">
                        <table class="table table-sm table-hover table-bordered">
                            <tbody>
                                @foreach($datosfacturacion as $dfs => $df) 
                                <tr>
                                    <th style="width:300px" class="text-center table-active">FECHA REGISTRO</th>
                                    <td class="text-left">{{$df['fecha_solicitud']}}</td>
                                </tr>
                                <tr>
                                    <th class="text-center table-active">RFC</th>
                                    <td class="text-left">{{$df['rfc']}}</td>
                                </tr>
                                <tr>
                                    <th class="text-center table-active">RAZON SOCIAL</th>
                                    <td class="text-left">{{$df['razonsocial']}}</td>
                                </tr>
                                <tr>
                                    <th class="text-center table-active">DOMICILIO FISCAL</th>
                                    <td class="text-left">{{$df['domiciliofiscal']}}</td>
                                </tr>
                                <tr>
                                    <th class="text-center table-active">CORREO</th>
                                    <td class="text-left">{{$df['correo']}}</td>
                                </tr>
                                <tr>
                                    <th class="text-center table-active">TELEFONO</th>
                                    <td class="text-left">{{$df['telefono']}}</td>
                                </tr>
                                @endforeach   
                            </tbody>
                        </table>
                    </div>

                    <a href="#" class="btn btn-outline-primary btn-lg btn-block {{$array['btn1']}}" data-toggle="modal" data-target="#create">
                    <i class="fas fa-plus"></i>&nbsp; Agregar datos de facturación
                    </a>

                    <a href="#" class="btn btn-outline-primary btn-lg btn-block {{$array['btn2']}}" data-toggle="modal" data-target="#editar">
                        <i class="fas fa-edit"></i> Editar datos de facturación
                    </a>

                    <div class="modal fade" id="create">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <form method="POST" action="{{ route('creardatosfiscales') }}" accept-charset="UTF-8" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <!-- Encabezado -->
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Agregar datos de facturación</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <!-- Cuerpo -->
                                <div class="modal-body">
                                        
                                        <!-- Input RFC -->
                                        <div class="input-group mb-3">                           
                                            <input id="rfc" type="text" placeholder="RFC" pattern='[A-Z0-9]{12,13}' class="form-control " name="rfc" value="" onkeyup="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" required="" autocomplete="rfc" autofocus="">
                                        </div>

                                        <!-- Input Razon social -->
                                        <div class="input-group mb-3">                           
                                            <input id="razonsocial" type="text" placeholder="Razon social" class="form-control " name="razonsocial" value="" onkeyup="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" required="" autocomplete="razonsocial" autofocus="">
                                        </div>

                                        <!-- Input Domicilio fiscal -->
                                        <div class="input-group mb-3">                           
                                            <input id="domiciliofiscal" type="text" placeholder="Domicilio fiscal" class="form-control " name="domiciliofiscal" value="" onkeyup="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" required="" autocomplete="domiciliofiscal" autofocus="">
                                        </div>

                                        <!-- Input Correo -->
                                        <div class="input-group mb-3">                           
                                            <input id="correo" type="email" placeholder="Correo" class="form-control " name="correo" value="" onkeyup="document.getElementById(this.id).value=document.getElementById(this.id).value.toLowerCase()" required="" autocomplete="correo" autofocus="">
                                        </div>
                                        
                                        <!-- Input Telefono -->
                                        <div class="input-group mb-3">
                                            <input type="tel" class="form-control" name="telefono" id="telefono" placeholder="Telefono" pattern="[0-9]{10}" required="">
                                        </div>

                                        <!-- Input Constancia de situación fiscal -->
                                        <div class="input-group mb-3">
                                            <label for="exampleFormControlFile1">Constancia de situación fiscal</label>
                                            <!-- <input type="file" name="constanciasf" class="form-control-file" id="constanciasf" required> -->
                                            <input type="file" id="archivo" name="archivo" accept="application/pdf" required>
                                        </div>
                                         
                                </div>
                                <!-- Pie de pagina -->
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary btn-lg btn-block">
                                        <i class="fas fa-plus"></i>&nbsp; Agregar
                                    </button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="editar">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <form method="POST" action="{{ route('editardatosfiscales') }}" accept-charset="UTF-8" enctype="multipart/form-data">
                                {{ method_field('PUT') }}
                                {{ csrf_field() }}
                                <!-- Encabezado -->
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Editar datos de facturación</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <!-- Cuerpo -->
                                <div class="modal-body">
                                        @foreach($datosfacturacion as $dfs => $df)
                                        <!-- Input RFC -->
                                        <div class="input-group mb-3">                           
                                            <input id="rfc" type="text" placeholder="RFC" pattern='[A-Z0-9]{12,13}' class="form-control " name="rfc" value="{{trim($df['rfc'])}}" onkeyup="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" required="" autocomplete="rfc" autofocus="">
                                        </div>

                                        <!-- Input Razon social -->
                                        <div class="input-group mb-3">                           
                                            <input id="razonsocial" type="text" placeholder="Razon social" class="form-control " name="razonsocial" value="{{trim($df['razonsocial'])}}" onkeyup="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" required="" autocomplete="razonsocial" autofocus="">
                                        </div>

                                        <!-- Input Domicilio fiscal -->
                                        <div class="input-group mb-3">                           
                                            <input id="domiciliofiscal" type="text" placeholder="Domicilio fiscal" class="form-control " name="domiciliofiscal" value="{{trim($df['domiciliofiscal'])}}" onkeyup="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" required="" autocomplete="domiciliofiscal" autofocus="">
                                        </div>

                                        <!-- Input Correo -->
                                        <div class="input-group mb-3">                           
                                            <input id="correo" type="email" placeholder="Correo" class="form-control " name="correo" value="{{trim($df['correo'])}}" onkeyup="document.getElementById(this.id).value=document.getElementById(this.id).value.toLowerCase()" required="" autocomplete="correo" autofocus="">
                                        </div>
                                        
                                        <!-- Input Telefono -->
                                        <div class="input-group mb-3">
                                            <input type="tel" class="form-control" name="telefono" value="{{trim($df['telefono'])}}" id="telefono" placeholder="Telefono" pattern="[0-9]{10}" required="">
                                        </div>

                                        <!-- Input Constancia de situación fiscal -->
                                        <div class="input-group mb-3">
                                            <label for="exampleFormControlFile1">Constancia de situación fiscal</label>
                                            <!-- <input type="file" name="constanciasf" class="form-control-file" id="constanciasf" required> -->
                                            <input type="file" id="archivo" name="archivo" accept="application/pdf" required>
                                        </div>
                                        @endforeach
                                </div>
                                <!-- Pie de pagina -->
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary btn-lg btn-block">
                                    <i class="fas fa-edit"></i> Editar
                                    </button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>

            <div class="card card-navy">

                <!-- Tabla Renovacion Beca -->
                <div class="card-header">SOLICITAR FACTURA</div>

                <div class="card-body">
                @foreach($sfacturacion as $sfs => $sf)
                    <form method="post" action="{{ route('solicitarfactura') }}">
                    {{ csrf_field() }}
                    <div class="form-check" align="center" >
                    <input type="checkbox"  class="form-check-input" value="1" onclick="{{$array['btnS']}}" >
                    <label class="form-check-label" for="flexCheckDefault">
                        Datos fiscales correctos
                    </label>
                    </div>
                        <br>
                        <input type="submit" class="btn btn-outline-primary btn-lg btn-block" value="Solicitar factura" name="btnSolicitar" disabled>
                    </form>
                    <br>
                    <div class="info-box mb-3 bg-{{$array['infobox']}}">
                        <span class="info-box-icon"><i class="fas fa-info-circle"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">ESTADO DE SOLICITUD</span>
                            <span class="info-box-number">{{$sf['status_solicitud']}}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>

                    <div class="table-responsive row">
                        <table class="table table-sm table-hover table-bordered">
                            <tbody>
                                
                                <tr>
                                    <th style="width:300px" class="text-center table-active">FECHA SOLICITUD</th>
                                    <td class="text-left">{{$sf['fecha_solicitud']}}</td>
                                </tr>
                                <tr>
                                    <th class="text-center table-active">RFC</th>
                                    <td class="text-left">{{$sf['rfc']}}</td>
                                </tr>
                                <tr>
                                    <th class="text-center table-active">MATRICULA</th>
                                    <td class="text-left">{{$sf['matricula']}}</td>
                                </tr>
                            
                            </tbody>
                        </table>
                    </div>
                @endforeach
                </div>

                <div class="alert bg-navy" role="alert">
                    <label class="col-md-12 col-form-label text-md-center">Enviar solicitud el día que realizas tu pago.</label>
                </div>

                <div class="alert bg-navy" role="alert">
                    <label class="col-md-12 col-form-label text-md-center">Se factura solo el mes actual.</label>
                </div>

                <div class="alert bg-navy" role="alert">
                    <label class="col-md-12 col-form-label text-md-center">Enviar solicitud entre los días 2 y 27 de cada mes.</label>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<!-- cargar archivos solo pdf -->
<script>
$('input[type="file"]').on('change', function(){
  var ext = $( this ).val().split('.').pop();
  if ($( this ).val() != '') {
    if(ext == "pdf"){
      // alert("La extensión es: " + ext);
      if($(this)[0].files[0].size > 1048576){
        console.log("El documento excede el tamaño máximo");
        $('#modal-title').text('¡Precaución!');
        $('#modal-msg').html("Se solicita un archivo no mayor a 1MB. Por favor verifica.");
        $("#modal-gral").modal();           
        $(this).val('');
      }else{
        $("#modal-gral").hide();
      }
    }
    else
    {
      $( this ).val('');
      alert("Extensión no permitida: " + ext);
    }
  }
});
</script>
@endsection