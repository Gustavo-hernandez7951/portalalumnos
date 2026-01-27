@extends('layouts.layout')

@section('content')



<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8 col-md-offset-2">
            <div class="card card-navy">
                <div class="card-header">CONTACTO</div>

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

                <div class="card-body">
                   
                    <!--Encabezado de la sección-->
                    <h2 class="h1-responsive font-weight-bold text-center">CONTACTA CON NOSOTROS</h2>
                    <!--Descripción de la sección-->
                    <p class="text-center w-responsive mx-auto">¿Tiene usted alguna pregunta?</p>
                    <p class="text-center w-responsive mx-auto">Por favor no dude en contactarnos directamente.</p>
                    <p class="text-center w-responsive mx-auto mb-5">Nuestro equipo se pondrá en contacto con usted en cuestión de horas para ayudarlo.</p>

                    <div class="row">
                        <!--Columna de cuadrícula-->
                        <div class="col-md-9 mb-md-0 mb-5">
                            <form class="form-horizontal" action="{{ route('contactar') }}" method="POST">
                            {{ csrf_field() }}
                                <!--Fila de la cuadrícula-->
                                <div class="row">
                                    <!--Columna de cuadrícula-->
                                    <div class="col-md-6">
                                        <div class="md-form mb-0">
                                            <input type="text" id="name" name="name" class="form-control" required>
                                            <label for="name" class="">Nombre</label>
                                        </div>
                                    </div>
                                    <!--Columna de cuadrícula-->
                                    <div class="col-md-6">
                                        <div class="md-form mb-0">
                                            <input type="email" id="email" name="email" class="form-control" required>
                                            <label for="email" class="">Correo</label>
                                        </div>
                                    </div>
                                </div>

                                <!--Fila de la cuadrícula-->
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="md-form mb-0">
                                            <input type="text" id="subject" name="subject" class="form-control" required>
                                            <label for="subject" class="">Asunto</label>
                                        </div>
                                    </div>
                                </div>

                                <!--Fila de la cuadrícula-->
                                <div class="row">
                                    <!--Columna de cuadrícula-->
                                    <div class="col-md-12">
                                        <div class="md-form">
                                            <textarea type="text" id="message" name="message" rows="2" class="form-control md-textarea" required></textarea>
                                            <label for="message">Mensaje</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-7 col-md-offset-4">
                                        <button type="submit" class="btn btn-primary float-right btn-lg">
                                        Enviar
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
        
                        <!--Columna de cuadrícula-->
                        <div class="col-md-3 text-center">
                            <ul class="list-unstyled mb-0">
                                <li><i class="fas fa-map-marker-alt fa-2x"></i>
                                    <p>Boulevard del Minero #305 Colonia.Rojo Gómez Pachuca, Hgo. C.P. 42030.</p>
                                </li>

                                <li><i class="fas fa-phone mt-4 fa-2x"></i>
                                    <p>719 53 00 / 719 53 01</p>
                                </li>

                                <li><i class="fas fa-envelope mt-4 fa-2x"></i>
                                    <p>promocion@cuh.edu.mx</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection