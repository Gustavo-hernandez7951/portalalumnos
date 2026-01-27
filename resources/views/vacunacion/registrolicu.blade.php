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
                <p align="justify">Se informa que ante la posibilidad de que se implemente un programa nacional de vacunación para estudiantes.</p>
                <p align="justify">Se te invita a participar en el registro interno para validar que los datos personales necesarios estén actualizados y estar en posibilidad de informar a la autoridad que nos rige el total de alumnos candidatos a recibir la vacuna.</p>    
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
                <div class="card-header">REGISTRO DE VACUNACION</div>
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

            <div class="card card-navy">
                <!-- Tabla Datos Beca -->
                <div class="card-header">DATOS REGISTRO</div>
                <div class="card-body">
                    <div class="table-responsive row">
                        <table class="table table-sm table-hover table-bordered">
                            <tbody>
                                @foreach($dps as $dp => $d)
                                <tr>
                                    <th style="width:300px" class="text-center table-active">MATRICULA</th>
                                    <td class="text-left">{{$d['matricula']}}</td>
                                </tr>
                                <tr>
                                    <th class="text-center table-active">RFC</th>
                                    <td class="text-left">{{$d['rfc']}}</td>
                                </tr>
                                <tr>
                                    <th class="text-center table-active">CURP</th>
                                    <td class="text-left">{{$d['curp_alumno']}}</td>
                                </tr>
                                <tr>
                                    <th style="width:300px" class="text-center table-active">NOMBRE</th>
                                    <td class="text-left">{{$d['nombre']}}</td>
                                </tr>
                                <tr>
                                    <th style="width:300px" class="text-center table-active">APELLIDO PATERNO</th>
                                    <td class="text-left">{{$d['paterno']}}</td>
                                </tr>
                                <tr>
                                    <th style="width:300px" class="text-center table-active">APELLIDO MATERNO</th>
                                    <td class="text-left">{{$d['materno']}}</td>
                                </tr> 
                                <tr>
                                    <th class="text-center table-active">DOMICILIO</th>
                                    <td class="text-left">{{$d['domicilio']}}</td>
                                </tr>
                                <tr>
                                    <th style="width:300px" class="text-center table-active">LOCALIDAD</th>
                                    <td class="text-left">{{$d['ciudad']}}</td>
                                </tr>
                                <tr>
                                    <th style="width:300px" class="text-center table-active">MUNICIPIO</th>
                                    <td class="text-left">{{trim($d['nombremunicipio'])}}</td>
                                </tr>
                                <tr>
                                    <th class="text-center table-active">TELEFONO</th>
                                    <td class="text-left">{{$d['celular']}}</td>
                                </tr> 
                                <tr>
                                    <th class="text-center table-active">CORREO</th>
                                    <td class="text-left">{{$d['email_institucional']}}</td>
                                </tr>
                                @endforeach   
                            </tbody>
                        </table>
                    </div>

                    <button type="button" class="btn btn-outline-primary btn-lg btn-block" {{$btnR}} data-toggle="modal" data-target="#confirmar">
                    <i class="fas fa-user-check"></i> Registrarse
                    </button>

                    <div class="modal fade" id="confirmar">
                        <div class="modal-dialog modal-dialog-centered modal-lg ">
                            <div class="modal-content">
                                <form method="POST" action="{{ route('vacunacion-registrar') }}" accept-charset="UTF-8" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <!-- Encabezado -->
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Verificar Datos</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <!-- Cuerpo -->
                                    <div class="modal-body">
                                        @foreach($dps as $dp => $d)
                                        <!-- Input RFC -->
                                        <div class="form-group row">
                                            <label for="rfc" class="col-md-2 col-form-label text-md-right">{{ __('(13) RFC') }}</label>
                                            <div class="input-group mb-3 col-md-10">                           
                                                <input id="rfc" type="text" placeholder="RFC" pattern='[A-Z0-9]{12,13}' class="form-control " name="rfc" value="{{trim($d['rfc'])}}" onkeyup="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" required autocomplete="rfc" autofocus="">
                                            </div>
                                        </div>

                                        <!-- Input Curp -->
                                        <div class="form-group row">
                                            <label for="curp" class="col-md-2 col-form-label text-md-right">{{ __('CURP') }}</label>
                                            <div class="input-group mb-3 col-md-10">                           
                                                <input id="curp" type="text" placeholder="CURP" class="form-control " name="curp" value="{{trim($d['curp_alumno'])}}" onkeyup="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" required autocomplete="curp" autofocus="">
                                            </div>
                                        </div>

                                        <!-- Input Domicilio -->
                                        <div class="form-group row">
                                            <label for="domicilio" class="col-md-2 col-form-label text-md-right">{{ __('DOMICILIO') }}</label>
                                            <div class="input-group mb-3 col-md-10">                           
                                                <input id="domicilio" type="text" placeholder="Domicilio" class="form-control " name="domicilio" value="{{$d['domicilio']}}" onkeyup="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" required autocomplete="domicilio" autofocus="">
                                            </div>
                                        </div>

                                        <!-- Input Localidad -->
                                        <div class="form-group row">
                                            <label for="localidad" class="col-md-2 col-form-label text-md-right">{{ __('LOCALIDAD') }}</label>
                                            <div class="input-group mb-3 col-md-10">                           
                                                <input id="localidad" type="text" placeholder="Localidad" class="form-control " name="localidad" value="{{$d['ciudad']}}" onkeyup="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" required autocomplete="localidad" autofocus="">
                                            </div>
                                        </div>

                                        <!-- Input Municipio -->
                                        <div class="form-group row">
                                            <label for="municipio" class="col-md-2 col-form-label text-md-right">{{ __('MUNICIPIO') }}</label>
                                            <div class="input-group mb-3 col-md-10">                           
                                                <input id="municipio" type="text" placeholder="Municipio" class="form-control " name="municipio" value="{{trim($d['nombremunicipio'])}}" onkeyup="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" required autocomplete="municipio" autofocus="">
                                            </div>
                                        </div>
                                        
                                        <!-- Input Telefono -->
                                        <div class="form-group row">
                                            <label for="telefono" class="col-md-2 col-form-label text-md-right">{{ __('(10) TELEFONO') }}</label>
                                            <div class="input-group mb-3 col-md-10">
                                                <input type="tel" class="form-control" name="telefono" value="{{trim($d['celular'])}}" id="telefono" placeholder="Telefono" pattern="[0-9]{10}" required>
                                            </div>
                                        </div>

                                        <!-- Select Aplicacion -->
                                        <div class="form-group row">
                                            <label for="aplicacion" class="col-md-2 col-form-label text-md-right">{{ __('APLICACION') }}</label>
                                            <div class="input-group mb-3 col-md-10">
                                                <select id="aplicacion" list="Area" class="form-control" name="aplicacion"  required>
                                                <option value="" disabled selected hidden>Ha sido vacunado contra COVID?</option>
                                                <option value="N">Si</option>
                                                <option value="S">No</option>
                                                <option value="R">Rechazo la vacuna</option>
                                                </select>
                                            </div>
                                        </div>

                                        <!-- Textarea Observaciones -->
                                        <div class="form-group row">
                                            <label for="observaciones" class="col-md-2 col-form-label text-md-right">{{ __('OBSERVACION') }}</label>
                                            <div class="input-group mb-3 col-md-10">
                                                <textarea class="form-control" id="observaciones" name="observaciones"  placeholder="Si has sido vacunado, escribe el tipo de vacuna aplicada." rows="2"></textarea>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                    <!-- Pie de pagina -->
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary btn-lg btn-block">
                                        <i class="fas fa-user-check"></i> Confirmar
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>                   
                </div>
            </div>

            <div class="info-box mb-3 bg-{{$infobox}}">
                <span class="info-box-icon"><i class="fas fa-info-circle"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">ESTADO</span>
                    <span class="info-box-number">{{$reg}}</span>
                </div>
                <!-- /.info-box-content -->
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