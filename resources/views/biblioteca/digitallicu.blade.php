@extends('layouts.licu')
@section('content')
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-navy">
                    <div class="card-header"><h5>BIBLIOTECA DIGITAL</h5></div>
                    <div class="card-body">
                        <!-- Datos de Alumno -->
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label text-left">MATRÍCULA:</label>
                            <p class="col-md-4 col-form-label text-left">{{ Auth::user()->cuenta }}</p>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label text-left">NOMBRE:</label>
                            <p class="col-md-4 col-form-label text-left">{{ Auth::user()->nombre }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid mt-4">
        <div class="row justify-content-center">
            <div class="col-md-12 col-md-offset-2">
                <div class="card card-navy">
                    <div class="card-header">DIGITALIA</div>
                    <div class="card-body">
                        <!-- Mensaje -->
                        <div class="alert alert-light" role="alert">
                            <h4 class="alert-heading">DATOS PARA ACCEDER A LA PLATAFORMA</h4>
                            <p>
                                <strong>CORREO O NOMBRE DE USUARIO:</strong> El correo institucional otorgado por la institución.<br><br>
                                <strong>CONTRASEÑA:</strong> Introducir los caracteres <strong>Biblioteca123</strong> que forman una clave provisional, posteriormente se podrá personalizar en el perfil del usuario por una clave propia.
                            </p>
                        </div>
                        <div class="form-group row">
                            <a href="https://www.digitaliapublishing.com/novedades" class="btn btn-outline-primary btn-lg btn-block" role="button" aria-pressed="true">
                                <i class="fas fa-users"></i> &nbsp;Ir a biblioteca digital
                            </a>
                        </div>
                        <!-- Mensaje -->
                        <div class="alert alert-light" role="alert">
                            <p>
                                <strong>&raquo;</strong> Se recomienda cambiar la contraseña de acceso por una personalizada.<br><br>
                                <strong>&raquo;</strong> Para restablecimiento de contraseña, aclaración de dudas, orientación en el manejo de la biblioteca digital, dirigirse al Área de Biblioteca en los teléfonos de la institución 771 719 53 00 y 01 ext. 116 o a través del correo <i><strong>biblioteca@cuh.edu.mx</strong></i>.<br><br>
                                <strong>&raquo;</strong> El Centro Universitario Hidalguense se reserva el derecho de restringir el acceso a la biblioteca digital en virtud de causar baja temporal o definitiva, estar suspendido por adeudo, o ser egresado de la institución.<br><br>
                                <strong>&raquo;</strong> En el caso de ser alumno egresado de posgrado, su acceso estará vigente durante el periodo de elaboración de tesis. En caso de ser alumno de licenciatura y que vaya a presentar examen de CENEVAL, deberá acudir a biblioteca para reactivar el acceso a la biblioteca digital en el periodo de preparación previo al examen.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Tutorials Section -->
    <div class="container-fluid mt-4">
        <div class="row justify-content-center">
            <div class="col-md-12 col-md-offset-2">
                <div class="card card-navy">
                    <div class="card-header">TUTORIALES DE DIGITALIA HISPÁNICA</div>
                    <div class="card-body">
                        <div class="row">
                            <!-- Tutorial Button 1 -->
                            <div class="col-md-4 mb-3">
                                <button class="btn btn-outline-primary btn-block" data-toggle="modal" data-target="#modal1">
                                    <i class="fas fa-play-circle"></i> Como Registrarse
                                </button>
                            </div>
                            <!-- Tutorial Button 2 -->
                            <div class="col-md-4 mb-3">
                                <button class="btn btn-outline-primary btn-block" data-toggle="modal" data-target="#modal2">
                                    <i class="fas fa-search"></i> Realizar Búsquedas
                                </button>
                            </div>
                            <!-- Tutorial Button 3 -->
                            <div class="col-md-4 mb-3">
                                <button class="btn btn-outline-primary btn-block" data-toggle="modal" data-target="#modal3">
                                    <i class="fas fa-mobile-alt"></i> Descarga Móvil
                                </button>
                            </div>
                            <!-- Tutorial Button 4 -->
                            <div class="col-md-4 mb-3">
                                <button class="btn btn-outline-primary btn-block" data-toggle="modal" data-target="#modal4">
                                    <i class="fas fa-laptop"></i> Descarga en Préstamo
                                </button>
                            </div>
                            <!-- Tutorial Button 5 -->
                            <div class="col-md-4 mb-3">
                                <button class="btn btn-outline-primary btn-block" data-toggle="modal" data-target="#modal5">
                                    <i class="fas fa-list"></i> Requisitos para Descarga
                                </button>
                            </div>
                            <!-- Tutorial Button 6 -->
                            <div class="col-md-4 mb-3">
                                <button class="btn btn-outline-primary btn-block" data-toggle="modal" data-target="#modal6">
                                    <i class="fas fa-user-plus"></i> Funciones para Usuarios
                                </button>
                            </div>
                            <!-- Tutorial Button 7 -->
                            <div class="col-md-4 mb-3">
                                <button class="btn btn-outline-primary btn-block" data-toggle="modal" data-target="#modal7">
                                    <i class="fas fa-tasks"></i> Gestión de Listas
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modals for Tutorial Videos -->
    @php
        $videoIds = [
            '3UBPQ4V-1t8',
            'n28sTxJMLIE',
            'bYnY-zz2LOM',
            't1ocNFm6yc0',
            '6CLCfv78BjI',
            '_I2ZRMIKWgM',
            'LsTs6UnnWAc'
        ];
    @endphp

    @for ($i = 1; $i <= 7; $i++)
        <div class="modal fade" id="modal{{ $i }}" tabindex="-1" role="dialog" aria-labelledby="modalLabel{{ $i }}" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel{{ $i }}">
                            @switch($i)
                                @case(1) Como Registrarse en Digitalia Hispánica @break
                                @case(2) Cómo realizar búsquedas en Digitalia Hispánica @break
                                @case(3) Cómo realizar una descarga desde tu dispositivo móvil @break
                                @case(4) Cómo realizar una descarga en préstamo desde tu computadora @break
                                @case(5) Requisitos para realizar una descarga en préstamo desde tu computadora @break
                                @case(6) Funciones añadidas para usuarios registrados @break
                                @case(7) Gestión de listas de Digitalia Hispánica @break
                            @endswitch
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <iframe width="560" height="315"
                            src="https://www.youtube.com/embed/{{ $videoIds[$i-1] }}"
                            frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
    @endfor
@endsection

@section('script')
    <!-- Script para recargar los iframes de los modales -->
    <script>
        $(function(){
            $('.modal').on('hidden.bs.modal', function (e) {
                var $iframe = $(this).find("iframe");
                $iframe.attr("src", $iframe.attr("src"));
            });
        });
    </script>

    <style>
        .modal-dialog {
            max-width: 800px; /* Ajusta el ancho máximo del modal */
            margin: 1.75rem auto;
        }

        .modal-content {
            padding: 0; /* Elimina el relleno del contenido del modal */
            border: none; /* Elimina el borde del contenido del modal */
        }

        .modal-body {
            padding: 0; /* Elimina el relleno del cuerpo del modal */
        }

        .modal-body iframe {
            width: 100%; /* Ajusta el ancho del iframe al 100% del contenedor */
            height: 450px; /* Ajusta la altura del iframe según sea necesario */
        }
    </style>
@endsection
