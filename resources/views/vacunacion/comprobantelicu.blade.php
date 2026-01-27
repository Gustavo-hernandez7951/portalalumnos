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
                <div class="card-header">COMPROBANTE DE VACUNACION</div>
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
                <div class="card-header">DATOS COMPROBANTE</div>
                <div class="card-body">
                    <div class="table-responsive row">
                        <table class="table table-sm table-hover table-bordered">
                            <tbody>

                                <tr>
                                    <th style="width:300px" class="text-center table-active">FECHA DE VACUNACION</th>
                                    <td class="text-left">{{$cv['fecha_vacunacion']}}</td>
                                </tr>
                                <tr>
                                    <th class="text-center table-active">MARCA DE VACUNA</th>
                                    <td class="text-left">{{$cv['marca_vacuna']}}</td>
                                </tr>
                                <tr>
                                    <th class="text-center table-active">LOTE</th>
                                    <td class="text-left">{{$cv['lote_vacuna']}}</td>
                                </tr>
                                <tr>
                                    <th class="text-center table-active">DOSIS</th>
                                    <td class="text-left">{{$cv['dosis_vacuna']}}</td>
                                </tr>
                                  
                            </tbody>
                        </table>
                    </div>

                    <a href="#" class="btn btn-outline-primary btn-lg btn-block {{$btns}}" data-toggle="modal" data-target="#subir">
                    <i class="fas fa-upload"></i>&nbsp; Subir comprobante de vacunación
                    </a>

                    <div class="modal fade" id="subir">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <form method="POST" action="{{ route('vacunacion-subircomprobante') }}" accept-charset="UTF-8" enctype="multipart/form-data">
                                {{ method_field('PUT') }}
                                {{ csrf_field() }}
                                <!-- Encabezado -->
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Subir comprobante de vacunación</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <!-- Cuerpo -->
                                <div class="modal-body">
                                        
                                        <!-- Input Fecha -->
                                        <div class="input-group mb-3">
                                            <label class="col-md-3 col-form-label text-md-right">Fecha de vacunación:</label>
                                            <input id="fechav" type="date" placeholder="Fecha de vacunación *" min='' max='' class="form-control" name="fechav" value="" required autocomplete="fechav" autofocus="">                        
                                        </div>

                                        <!-- Input Razon social -->
                                        <div class="input-group mb-3">
                                            <label class="col-md-3 col-form-label text-md-right">Marca de vacuna:</label>
                                            <select id="vacuna" list="Area" class="form-control" name="vacuna"  required>
                                                <option value="" disabled selected hidden>Marca de vacuna</option>
                                                <option value="PFIZER">PFIZER</option>
                                                <option value="CANSINO">CANSINO</option>
                                                <option value="SINOVAC">SINOVAC</option>
                                                <option value="ASTRAZENECA">ASTRAZENECA</option>
                                                <option value="SPUTNIK">SPUTNIK</option>
                                                <option value="MODERNA">MODERNA</option>
                                                <option value="SINOPHARM">SINOPHARM</option>
                                                <option value="JOHNSON AND JOHNSON">JOHNSON AND JOHNSON</option>
                                                <option value="NOVAVAX">NOVAVAX</option>
                                                <option value="CUREVAC">CUREVAC</option>
                                                <option value="BHARAT BIOTECH">BHARAT BIOTECH</option>
                                                <option value="ABDALA">ABDALA</option>
                                            </select>
                                        </div>

                                        <!-- Input Domicilio fiscal -->
                                        <div class="input-group mb-3">
                                        <label class="col-md-3 col-form-label text-md-right">Lote:</label>                            
                                            <input id="lote" type="text" placeholder="Lote" class="form-control " name="lote" value="" onkeyup="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" required="" autocomplete="lote" autofocus="">
                                        </div>

                                        <!-- Input Correo -->
                                        <div class="input-group mb-3">
                                            <label class="col-md-3 col-form-label text-md-right">Dosis:</label>                            
                                            <select id="dosis" list="Area" class="form-control" name="dosis"  required>
                                                <option value="" disabled selected hidden>Dosis</option>
                                                <option value="PRIMERA">PRIMERA</option>
                                                <option value="SEGUNDA">SEGUNDA</option>
                                                <option value="UNICA">UNICA</option>
                                                
                                            </select>
                                        </div>

                                        <!-- Input Constancia de situación fiscal -->
                                        <div class="input-group mb-3">
                                            <label class="col-md-7 col-form-label text-md-right">Comprobante de vacunación:</label>
                                            <!-- <input type="file" name="constanciasf" class="form-control-file" id="constanciasf" required> -->
                                            <input type="file" id="archivo" name="archivo" accept="application/pdf" required>
                                        </div>
                                         
                                </div>
                                <!-- Pie de pagina -->
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary btn-lg btn-block">
                                        <i class="fas fa-upload"></i>&nbsp; Subir
                                    </button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                  
                </div>
            </div>

            <div class="alert bg-navy" role="alert">
                <label class="col-md-12 col-form-label text-md-center">Para poder subir tu comprobante debes de estar registrado.</label>
            </div>

        </div>
    </div>
</div>
@endsection

@section('script')
<!-- cargar archivos solo pdf -->
Este script 
<script>
$('input[type="file"]').on('change', function(){
  var ext = $( this ).val().split('.').pop();
  if ($( this ).val() != '') {
    if(ext == "pdf"){
      // alert("La extensión es: " + ext);
      if($(this)[0].files[0].size > 40000000){
        console.log("El documento excede el tamaño máximo");
        // $('#modal-title').text('¡Precaución!');
        // $('#modal-msg').html("Se solicita un archivo no mayor a 40MB. Por favor verifica.");
        // $("#modal-gral").modal();           
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