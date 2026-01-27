@extends('layouts.licu')

@section('content')
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <!-- Datos del alumno -->
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12 col-md-offset-2">
                <div class="card card-navy">
                    <div class="card-header">BIBLIOTECA DIGITAL</div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label text-md-right">MATRÍCULA:</label>
                            <p class="col-md-4 col-form-label text-md-left">{{ Auth::user()->cuenta }}</p>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label text-md-right">NOMBRE:</label>
                            <p class="col-md-4 col-form-label text-md-left">{{ Auth::user()->nombre }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Información de acceso -->
    <div class="container-fluid mt-4">
        <div class="row justify-content-center">
            <div class="col-md-12 col-md-offset-2">
                <div class="card card-navy">
                    <div class="card-header">DIGITALIA</div>
                    <div class="card-body">
                        <div class="alert alert-light" role="alert">
                            <h4 class="alert-heading">DATOS PARA ACCEDER A LA PLATAFORMA</h4>
                            <p>
                                <strong>CORREO O NOMBRE DE USUARIO:</strong> El correo institucional otorgado por la institución.<br><br>
                                <strong>CONTRASEÑA:</strong> Introducir <strong>Biblioteca123</strong> (clave provisional). Luego puedes cambiarla desde tu perfil.
                            </p>
                        </div>

                        <div class="form-group row">
                            <a href="https://www.digitaliapublishing.com/novedades" target="_blank"
                               class="btn btn-outline-primary btn-lg btn-block" role="button" aria-pressed="true">
                                <i class="fas fa-users"></i> &nbsp;Ir a biblioteca digital
                            </a>
                        </div>

                        <div class="alert alert-light" role="alert">
                            <p>
                                <strong>&raquo;</strong> Se recomienda cambiar la contraseña de acceso por una personalizada.<br><br>
                                <strong>&raquo;</strong> Para restablecer contraseña o aclarar dudas, contacta a <i><strong>biblioteca@cuh.edu.mx</strong></i> o llama al 771 719 53 00 / 01 ext. 116.<br><br>
                                <strong>&raquo;</strong> El acceso puede restringirse por baja, suspensión o egreso.<br><br>
                                <strong>&raquo;</strong> En caso de ser egresado de posgrado, tu acceso estará activo mientras elaboras tu tesis. Si eres alumno de licenciatura y presentarás CENEVAL, solicita reactivación de acceso.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Sección de tutoriales con collapses -->
    <div class="container-fluid mt-4">
        <div class="row justify-content-center">
            <div class="col-md-12 col-md-offset-2">
                <div class="card card-navy">
                    <div class="card-header">TUTORIALES DE DIGITALIA HISPÁNICA</div>
                    <div class="card-body">
                        <div class="row">
                            @php
                                $tutorials = [
                                    ['title' => 'Cómo registrarse en Digitalia Hispánica', 'icon' => 'fa-play-circle', 'video' => '3UBPQ4V-1t8'],
                                    ['title' => 'Cómo realizar búsquedas', 'icon' => 'fa-search', 'video' => 'n28sTxJMLIE'],
                                    ['title' => 'Descarga desde dispositivo móvil', 'icon' => 'fa-mobile-alt', 'video' => 'bYnY-zz2LOM'],
                                    ['title' => 'Descarga en préstamo desde PC', 'icon' => 'fa-laptop', 'video' => 't1ocNFm6yc0'],
                                    ['title' => 'Requisitos para descargas', 'icon' => 'fa-list', 'video' => '6CLCfv78BjI'],
                                    ['title' => 'Funciones para usuarios registrados', 'icon' => 'fa-user-plus', 'video' => '_I2ZRMIKWgM'],
                                    ['title' => 'Gestión de listas en Digitalia', 'icon' => 'fa-tasks', 'video' => 'LsTs6UnnWAc']
                                ];
                            @endphp

                            @foreach ($tutorials as $index => $t)
                                <div class="col-md-6 col-lg-4 mb-3">
                                    <button class="btn btn-outline-primary btn-block text-left" type="button"
                                            data-toggle="collapse" data-target="#tutorial{{ $index }}" aria-expanded="false"
                                            aria-controls="tutorial{{ $index }}">
                                        <i class="fas {{ $t['icon'] }}"></i> {{ $t['title'] }}
                                        <i class="fas fa-chevron-down float-right mt-1"></i>
                                    </button>

                                    <div class="collapse mt-2" id="tutorial{{ $index }}">
                                        <div class="card card-body border-primary">
                                            <div class="embed-responsive embed-responsive-16by9">
                                                <iframe class="embed-responsive-item"
                                                        src="https://www.youtube.com/embed/{{ $t['video'] }}"
                                                        allowfullscreen></iframe>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
<script>
    // Cambia el ícono al abrir/cerrar los collapses
    $('[data-toggle="collapse"]').on('click', function() {
        var target = $(this).data('target');
        $(target).on('shown.bs.collapse', function () {
            $('button[data-target="' + target + '"] i.fa-chevron-down')
                .removeClass('fa-chevron-down')
                .addClass('fa-chevron-up');
        });
        $(target).on('hidden.bs.collapse', function () {
            $('button[data-target="' + target + '"] i.fa-chevron-up')
                .removeClass('fa-chevron-up')
                .addClass('fa-chevron-down');
        });
    });
</script>
@endsection
