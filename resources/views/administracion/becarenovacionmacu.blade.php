@extends('layouts.macu')

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
            <div class="modal-body">
                <p align="justify">Le informamos que su solicitud de renovación anual de beca ha sido rechazada, le sugerimos ponerse en contacto con el Departamento de Tesorería Posgrado para mayores informes.</p>
                <p align="justify"><strong>Contacto</strong><br><a href="mailto:finanzas.posgrado@cuh.edu.mx">finanzas.posgrado@cuh.edu.mx</a><br>771 221 3248</p>    
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
                <div class="card-header">RENOVACION ANUAL</div>
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
                    <div class="jumbotron mt-3">
                                <h1>Renovación Anual de Beca</h1>
                                <p class="lead" style="text-align: justify;">
                                    Este documento es un formato que deberás llenar con tus datos personales y subir nuevamente al portal en un formato PDF.
                                </p>

                                <p style="text-align: justify; font-size: x-large;">
                                    Pasos a seguir para solicitar la renovación de beca:
                                </p>
                                <p style="text-align: justify;">
                                    1. Descarga el documento al hacer clic en el botón de Solicitud.
                                </p>
                                <p style="text-align: justify;">
                                    2. Llena el documento a puño y letra con tus datos (FIRMADO EN LA POSICION CORRESPONDIENTE).
                                </p>
                                <p style="text-align: justify;">
                                    3. Escanea el documento y guárdalo en un formato PDF.
                                </p>
                                <p style="text-align: justify;">
                                    3. Sube el documento ".pdf" en la nueva sección que se te desplegara al hacer la descarga.
                                </p>
                                <?php
                                    echo $btnRenovar;
                                ?>

                                <?php
                                    if ($subirArchivo > 0){
                                        echo    '<a href="#" class="btn btn-outline-primary btn-lg btn-block mt-4" data-toggle="modal" data-target="#subir">
                                                <i class="fas fa-upload"></i>&nbsp; Subir documento escaneado
                                                </a>';
                                    } 
                                ?>


                                <div class="modal fade" id="subir">
                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                        <div class="modal-content">
                                            <form method="POST" action="{{ route('subiarchivo') }}" accept-charset="UTF-8" enctype="multipart/form-data">
                                                {{ method_field('PUT') }}
                                                {{ csrf_field() }}
                                                <!-- Encabezado -->
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Subir documento de renovación de beca</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <!-- Cuerpo -->
                                                <div class="modal-body">

                                                        <!-- Input Constancia de situación fiscal -->
                                                        <div class="input-group mb-3">
                                                            <label class="col-form-label text-md-right">Documento PDF:&nbsp;&nbsp;</label>
                                                            <!-- <input type="file" name="constanciasf" class="form-control-file" id="constanciasf" required> -->
                                                            <input type="file" id="archivo" name="archivo" accept="application/pdf" required>
                                                            <?php 
                                                                // $dir_subida = '/dist/documentos/Subidos/';
                                                                // $fichero_subido = $dir_subida . basename($_FILES['archivo']['SA'.$matricula]);
                                                                // move_uploaded_file($_FILES['archivo']['tmp_name'], $fichero_subido);
                                                                // header("Location: subeArchivo.php");
                                                            ?>
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
            </div>
                </div>
            </div>

            <div class="card card-navy">

                <!-- Tabla Renovacion Beca -->
                <div class="card-header">SOLICITUD RENOVACION ANUAL DE BECA</div>

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
                        <a href="{{ route('constanciaPDF') }}"><button type="button" class="btn btn-outline-success btn-lg btn-block {{$btnConstancia}}"><i class="fas fa-download"></i> Descargar Constancia</button></a>
                    </div>
                @endforeach
                </div>

                <div class="alert bg-navy" role="alert">
                    <label class="col-md-12 col-form-label text-md-center">La beca entra en vigencia a partir del año en que quedó autorizada.</label>
                </div>
                <div class="alert bg-navy" role="alert">
                    <label class="col-md-12 col-form-label text-md-center">Para cualquier aclaración al respecto contactar al Departamento de Tesorería Posgrado.</label>
                </div>

                <div class="alert alert-light" role="alert">
                    <label class="col-md-12 col-form-label text-md-center" style="color:#00bb2d;">Contacto: 771 221 3248 <i class="fab fa-whatsapp"></i></label>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    function lopoldo(){
        $token =  '{{ csrf_token() }}';
        fetch("{{ route('statustabla') }}", {
                        method: 'POST',
                        headers: {
                            "Content-Type": "application/json",
                            'X-CSRF-TOKEN': $token// <--- token generado
                        },
                        method: "POST",
                        body: JSON.stringify('bandera')
                    })
                    .then(res => res.json())
                    .then(res=> {
                        if((res["msj"]).toString() == "guardado"){
                            Swal.fire({
                                icon: 'success',
                                title: 'Espere',
                                text: 'Espere fechas habiles de subida del documento',
                                footer: '',
                                confirmButtonColor: "#001f3f"
                            }).then((result) => {
                                /* Read more about isConfirmed, isDenied below */
                                if (result.isConfirmed) {
                                    window.location.reload();
                                } else if (result.isDenied) {
                                    
                                }
                            })
                        }
                    }).catch((error) => {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Algo salio mal!',
                            footer: 'Por favor comunicate al área de sistemas (7711120269)'
                        })
                    });
    }
</script>
@endsection