@extends('layouts.licu')
@section('content')
@if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
@endif

<style>
    .card {
        background-color: white;
        color: black;
        border: none;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
    }
    .card-header {
        background-color: #183161;
        color: white;
        border-radius: 10px 10px 0 0;
        padding: 15px 20px;
    }
    .card-body {
        display: flex;
        padding: 20px;
    }
    .card-img {
        width: 30%;
        height: auto;
        border-radius: 5px;
    }
    .card-text-container {
        width: 70%;
        padding-left: 20px;
    }
    .card-title {
        font-size: 24px;
        margin-bottom: 15px;
    }
    .card-text {
        font-size: 16px;
    }
    .btn-primary {
        background-color: #007BFF;
        border: none;
    }
    .btn-primary:hover {
        background-color: #0056b3;
    }
    .jumbotron {
        background-color: white;
        padding: 20px;
        border-radius: 10px;
        margin-bottom: 20px;
        text-align: center;
    }
</style>

<div class="container">
    <div class="jumbotron mt-3">
        <h1>Formas de Titulación</h1>
    </div>

    <!-- Titulación por Promedio -->
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10 mb-4">
            <div class="card h-100">
                <div class="card-header">
                    <h4 class="card-title">Titulación por Promedio</h4>
                </div>
                <div class="card-body">
                    <img src="dist/img/promedio.png" class="card-img" alt="Titulación por Promedio">
                    <div class="card-text-container">
                        <p class="card-text">
                            Esta modalidad se otorga al estudiante que cumpla con un promedio sobresaliente, siempre y cuando no hayan reprobado alguna materia, haber ingresado por equivalencia o revalidación de estudios, haberse dado de baja ni haber tenido mala conducta o historial de deshonestidad académica.
                            El promedio mínimo para que esta modalidad sea aplicable deberá ser igual o mayor a 9.0 (nueve punto cero).
                        </p>
                        <center>
                            <a class="btn btn-primary" href="dist/documentos/SOLICITUDDETITULACIONPORPROMEDIO.pdf" role="button" download>
                                Descargar documento
                            </a>
                        </center>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Titulación por Tesis -->
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10 mb-4">
            <div class="card h-100">
                <div class="card-header">
                    <h4 class="card-title">Titulación por Tesis</h4>
                </div>
                <div class="card-body">
                    <img src="dist/img/tesis.png" class="card-img" alt="Titulación por Tesis">
                    <div class="card-text-container">
                        <p class="card-text">
                            El estudiante deberá elaborar un trabajo de investigación de un tema de interés enfocado al área de formación del mismo, en ella se busca plantear, analizar, proponer para la mejora y dar una conclusión sobre algún fenómeno social.
                            La elaboración de la tesis es bajo tres modalidades:
                            <ul>
                                <li>Individual</li>
                                <li>Disciplinar</li>
                                <li>Multidisciplinar</li>
                            </ul>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Titulación por Tesina -->
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10 mb-4">
            <div class="card h-100">
                <div class="card-header">
                    <h4 class="card-title">Titulación por Tesina</h4>
                </div>
                <div class="card-body">
                    <img src="dist/img/tesina.png" class="card-img" alt="Titulación por Tesina">
                    <div class="card-text-container">
                        <p class="card-text">
                            El estudiante deberá elaborar un escrito de tipo monográfico en el que se demuestre que cuenta con la formación adecuada al programa académico estudiado y que posee las capacidades necesarias para organizar y expresar los conocimientos de forma coherente.
                        </p>
                        <p class="card-text text-center"><b>La elaboración de la tesina es individual.</b></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Titulación por Proyecto Colaborativo -->
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10 mb-4">
            <div class="card h-100">
                <div class="card-header">
                    <h4 class="card-title">Titulación por Proyecto Colaborativo</h4>
                </div>
                <div class="card-body">
                    <img src="dist/img/colaborativo.png" class="card-img" alt="Titulación por Proyecto Colaborativo">
                    <div class="card-text-container">
                        <p class="card-text">
                            El Proyecto Colaborativo consiste en la elaboración de un trabajo en equipo que beneficie a una empresa de cualquier razón social y se puede hacer en tres modalidades, disciplinar, multidisciplinar y multidisciplinar afín, respetando las condiciones presentadas por la Coordinación Académica.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Titulación por Experiencia Profesional -->
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10 mb-4">
            <div class="card h-100">
                <div class="card-header">
                    <h4 class="card-title">Titulación por Experiencia Profesional</h4>
                </div>
                <div class="card-body">
                    <img src="dist/img/experiencia.png" class="card-img" alt="Titulación por Experiencia Profesional">
                    <div class="card-text-container">
                        <p class="card-text">
                            La experiencia profesional es la modalidad en la cual los estudiantes deberán entregar una memoria de su desempeño profesional, donde demuestren la puesta en práctica de los aprendizajes obtenidos a lo largo de la licenciatura en su vida laboral.
                        </p>
                        <p class="card-text">
                            Deberán laborar en una dependencia oficial, empresa privada, de forma independiente, sector educativo o en algún otro espacio cuyas actividades estén directamente relacionadas al perfil de la licenciatura que está estudiando.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Titulación por Informe de Servicio Social -->
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10 mb-4">
            <div class="card h-100">
                <div class="card-header">
                    <h4 class="card-title">Titulación por Informe de Servicio Social</h4>
                </div>
                <div class="card-body">
                    <img src="dist/img/Ssocial.png" class="card-img" alt="Titulación por Informe de Servicio Social">
                    <div class="card-text-container">
                        <p class="card-text">
                            Esta modalidad consiste en realizar una memoria por escrito que cumpla con todos y cada uno de los requisitos de la elaboración de una Tesina, aplicada en la dependencia oficial, empresa privada, de forma independiente, sector educativo donde el estudiante realizó su servicio social.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Titulación por Estudios de Posgrado (Maestría) -->
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10 mb-4">
            <div class="card h-100">
                <div class="card-header">
                    <h4 class="card-title">Titulación por Estudios de Posgrado (Maestría)</h4>
                </div>
                <div class="card-body">
                    <img src="dist/img/posgrado.png" class="card-img" alt="Titulación por Estudios de Posgrado (Maestría)">
                    <div class="card-text-container">
                        <p class="card-text">
                            Esta modalidad consiste en obtener el título de Licenciatura cursando el 100% de los créditos del Programa de Maestría de Posgrado Centro Universitario Hidalguense, A. C., con la obtención de un Certificado Total de Estudios.
                        </p>
                        <p class="card-text">
                            Los estudiantes podrán titularse estudiando en otras Instituciones siempre y cuando cumplan con el mínimo de créditos requeridos por Centro Universitario Hidalguense, A. C.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Titulación por Estudios de Posgrado (Especialidad) -->
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10 mb-4">
            <div class="card h-100">
                <div class="card-header">
                    <h4 class="card-title">Titulación por Estudios de Posgrado (Especialidad)</h4>
                </div>
                <div class="card-body">
                    <img src="dist/img/especialidad.png" class="card-img" alt="Titulación por Estudios de Posgrado (Especialidad)">
                    <div class="card-text-container">
                        <p class="card-text">
                            Esta modalidad consiste en obtener el título de Licenciatura cursando el 100% de los créditos del Programa de Especialidad de Posgrado Centro Universitario Hidalguense, A. C., con la obtención de un Certificado Total de Estudios.
                        </p>
                        <p class="card-text">
                            Los estudiantes podrán titularse estudiando en otras Instituciones siempre y cuando cumplan con el mínimo de créditos requeridos por Centro Universitario Hidalguense, A. C.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Titulación por Examen General de Egreso de Licenciatura (EGEL) -->
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10 mb-4">
            <div class="card h-100">
                <div class="card-header">
                    <h4 class="card-title">Titulación por Examen General de Egreso de Licenciatura (EGEL)</h4>
                </div>
                <div class="card-body">
                    <img src="dist/img/egel.png" class="card-img" alt="Titulación por Examen General de Egreso de Licenciatura (EGEL)">
                    <div class="card-text-container">
                        <p class="card-text">
                            El examen general de egreso de licenciatura consiste en la aplicación y aprobación de una prueba estandarizada oficial, auspiciada por el centro nacional de evaluación para la educación superior (CENEVAL).
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
