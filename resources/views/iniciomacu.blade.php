@extends('layouts.macu')

@section('content')
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <link rel="stylesheet" href="{{ asset('css/iniciolicu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/iniciomacu.css') }}">

    <!-- Modal Aviso Privacidad 
    <div class="modal fade" id="modalPrivacidad" tabindex="-1"
        data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-navy text-white">
                    <h5 class="modal-title">Aviso de Privacidad</h5>
                </div>

                <div class="modal-body modal-body-scroll">
                    <div class="priv-card p-3 mb-3 rounded shadow-sm">
                        <div class="d-flex align-items-start">
                            <i class="fas fa-shield-alt fa-2x text-white me-3"></i>
                            <div>
                                <h6 class="text-white fw-bold mb-1">Protección de tus datos personales</h6>
                                <p class="text-white small mb-2">
                                    El C.U.H. protege tu información conforme a la ley. Puedes ejercer tus Derechos ARCO:
                                </p>
                                <ul class="text-white small list-unstyled mb-0">
                                    <li>• Acceso</li>
                                    <li>• Rectificación</li>
                                    <li>• Cancelación</li>
                                    <li>• Oposición</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <p class="small text-muted text-center">
                        <strong>Para más información, revisa el siguiente documento:</strong> <br><br>
                        <a href="https://drive.google.com/file/d/1ygFP5adR4YHFU_UpRVZrs250PV4IJ4lh/view" 
                            target="_blank" rel="noopener noreferrer">
                            <i class="fa-solid fa-file"></i> Abrir documento
                        </a>
                    </p>

                    <div class="form-check mt-3">
                        <input class="form-check-input" type="checkbox" id="chkPriv">
                        <label class="form-check-label small" for="chkPriv">
                            He leído y acepto el Aviso de Privacidad
                        </label>
                    </div>
                </div>

                <div class="modal-footer">
                    <button id="btnAceptarPriv" class="btn btn-primary btn-lg" disabled>
                        Aceptar
                    </button>
                </div>
            </div>
        </div>
    </div> -->

    <!-- Modal Reglamento PDF -->
    <div class="modal fade" id="autoopen" tabindex="-1"
        data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <iframe loading="lazy"
                            src="https://drive.google.com/file/d/1JmnmA2cEqbOz0hLeLPil8Owx9XIlJTQl/preview"
                            width="650" height="800" class="d-none d-lg-block"></iframe>
                    <iframe loading="lazy"
                            src="https://drive.google.com/file/d/1JmnmA2cEqbOz0hLeLPil8Owx9XIlJTQl/preview"
                            width="350" height="450" class="d-lg-none"></iframe>
                </div>

                <div class="modal-footer">
                    <button id="btnCerrarPdf" class="btn btn-info btn-lg btn-block">
                        Aceptar Reglamento
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para imagen completa -->
    <div class="modal fade" id="modalImagenCompleta" tabindex="-1" role="dialog"  aria-labelledby="modalImagenCompletaLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-navy text-white">
                    <h5 class="modal-title" id="modalImagenCompletaLabel">
                        <i class="fas fa-expand-arrows-alt mr-2"></i> Comunicado completo
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center p-0">
                    <img id="imagenModalCompleta" src="" 
                        alt="Comunicado importante - Vista completa" 
                        class="img-fluid rounded">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <i class="fas fa-times mr-2"></i> Cerrar
                    </button>
                    <button type="button" class="btn btn-primary" onclick="descargarImagen()">
                        <i class="fas fa-download mr-2"></i> Descargar
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Contenido principal -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-navy">
                    @foreach($dps as $b)
                        <div class="card-header">PORTAL ESCOLAR POSGRADO</div>
                        <div class="card-body">
                            <!-- Mensaje de Bienvenida -->
                            <div class="alert alert-light" role="alert">
                                <h4 class="alert-heading">BIENVENID@ {{ $b->nombre }} A TU PORTAL ESCOLAR</h4>
                                <p align="justify">
                                    El C.U.H. pone a disposición de nuestra comunidad estudiantil esta plataforma
                                    para facilitar el acceso a la información personal, académica y financiera.
                                    <br>
                                    Seguimos trabajando en desarrollar más funciones para reducir tiempos de espera,
                                    automatizar procesos y lograr una mayor eficiencia, por ello continuamos haciendo mejoras en la plataforma.
                                </p>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 col-lg-6">
                                    <!-- Correo Programa academico -->
                                    <div class="info-box mb-3 bg-navy">
                                        <span class="info-box-icon"><i class="fas fa-user-graduate"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">POSGRADO</span>
                                            <span class="info-box-number">{{ $b->cat_programa->descripcion }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <!-- Correo Institucional -->
                                    <div class="info-box mb-3 bg-navy">
                                        <span class="info-box-icon"><i class="fas fa-envelope-open-text"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">CORREO INSTITUCIONAL</span>
                                            <span class="info-box-number">{{ $b->email_institucional }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- SECCIÓN DE AVISOS IMPORTANTES -->
                        <div class="card-body">
                            <h2 class="text-center"><strong>AVISOS IMPORTANTES</strong></h2>
                            <br>
                            <div class="row">
                                <!-- Columna para los botones (lado izquierdo, una sola columna) -->
                                <div class="col-lg-6 col-md-6">
                                    <!-- Botón 1: Actualización de datos personales -->
                                    <div class="mb-3">
                                        <button class="btn bg-navy btn-lg btn-block text-left" type="button" 
                                                data-toggle="collapse" data-target="#actualizacionDatos" 
                                                aria-expanded="false" aria-controls="actualizacionDatos">
                                            <i class="fas fa-id-card mr-2"></i> Actualización de datos personales
                                            <i class="fas fa-chevron-down float-right mt-1"></i>
                                        </button>

                                        <div class="collapse mt-2" id="actualizacionDatos">
                                            <div class="card card-body border-navy">
                                                <h5 class="text-center text-navy mb-3">
                                                    <strong>Cómo actualizar tus datos personales</strong>
                                                </h5>
                                                <p align="left">
                                                    <i class="fas fa-check"></i> Descargar el 
                                                    <a href="dist/img/SolicitudDatos.pdf" target="_blank">"documento.pdf"</a>, 
                                                    llenarlo y firmarlo.
                                                    <br><br>
                                                    <i class="fas fa-check"></i> Enviar el documento a 
                                                    <a href="mailto:promocion@cuh.mx">promocion@cuh.mx</a>.
                                                    <br><br>
                                                    <i class="fas fa-check"></i> Revisa el portal escolar entre 24 y 72 horas 
                                                    hábiles después de enviar tu solicitud para verificar que los cambios 
                                                    se realizaron.
                                                </p>
                                                <div class="alert alert-light mt-3" role="alert">
                                                    <h4 class="alert-heading">NOTA:</h4>
                                                    <p align="justify">
                                                        Si el cambio a realizar es de domicilio, deberás adjuntar tu 
                                                        comprobante (agua, teléfono o predial) escaneado.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Botón 2: Ayúdanos a mejorar tu clase -->
                                    <div class="mb-3">
                                        <button class="btn bg-navy btn-lg btn-block text-left" type="button" 
                                                data-toggle="collapse" data-target="#mejorarClase" 
                                                aria-expanded="false" aria-controls="mejorarClase">
                                            <i class="fas fa-chalkboard-teacher mr-2"></i> Ayúdanos a mejorar tu clase
                                            <i class="fas fa-chevron-down float-right mt-1"></i>
                                        </button>

                                        <div class="collapse mt-2" id="mejorarClase">
                                            <div class="card card-body border-navy">
                                                <h5 class="text-center text-navy mb-3">
                                                    <strong>Ayúdanos a mejorar tu clase</strong>
                                                </h5>
                                                <p align="justify">
                                                    Posgrado Centro Universitario Hidalguense mantiene un compromiso permanente 
                                                    con nuestra comunidad estudiantil para un buen desarrollo de las sesiones 
                                                    virtuales de las asignaturas de maestría, por lo que te invitamos a informar 
                                                    si existe alguna de las siguientes irregularidades:
                                                </p>
                                                <ul>
                                                    <li>Clases que empiezan impuntualmente.</li>
                                                    <li>Clases que terminan antes del horario establecido.</li>
                                                    <li>Inasistencia del docente.</li>
                                                    <li>Falta de seguimiento en los temas de clases.</li>
                                                    <li>Falta de apoyo en la respuesta a preguntas o aclaración de dudas.</li>
                                                    <li>Falta de conocimiento sobre plataformas educativas.</li>
                                                    <li>Abandono total o parcial de clase.</li>
                                                </ul>
                                                <p align="justify">
                                                    Favor de reportarlo al teléfono:<br>
                                                    <strong>771 719 44 95</strong><br><br>
                                                    <strong>Coordinación Maestrías en Educación</strong><br>
                                                    Mtra. María Isabel Rodríguez Jarillo<br>
                                                    <a href="mailto:isabel.rodriguez@posgradocuh.edu.mx">isabel.rodriguez@posgradocuh.edu.mx</a>
                                                    <br><br>
                                                    <strong>Coordinación Maestrías Financiera-Administrativa</strong><br>
                                                    Mtra. Elizabeth Domínguez González<br>
                                                    <a href="mailto:elizabeth.dominguez@posgradocuh.edu.mx">elizabeth.dominguez@posgradocuh.edu.mx</a>
                                                    <br><br>
                                                    <strong>Coordinación Jurídica</strong><br>
                                                    Lic. Nancy González Valencia<br>
                                                    <a href="mailto:nancy.gonzalez@posgradocuh.edu.mx">nancy.gonzalez@posgradocuh.edu.mx</a>
                                                </p>
                                                <p align="justify">
                                                    Agradeciendo tu apoyo, ayúdanos a mejorar el desarrollo de las clases en línea.
                                                </p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Botón 3: Comunicado importante - Suspensión de estacionamiento -->
                                    <div class="mb-3">
                                        <button class="btn bg-navy btn-lg btn-block text-left" type="button" 
                                                data-toggle="collapse" data-target="#comunicadoEstacionamiento" 
                                                aria-expanded="false" aria-controls="comunicadoEstacionamiento">
                                            <i class="fas fa-car mr-2"></i> Suspensión de estacionamiento
                                            <i class="fas fa-chevron-down float-right mt-1"></i>
                                        </button>

                                        <div class="collapse mt-2" id="comunicadoEstacionamiento">
                                            <div class="card card-body border-navy">
                                                <h5 class="text-center text-navy mb-3">
                                                    <strong>Comunicado importante</strong>
                                                </h5>
                                                
                                                <!-- Contenido del comunicado -->
                                                <div class="alert alert-warning">
                                                    <h6 class="alert-heading"><strong>COMUNICADO IMPORTANTE</strong></h6>
                                                    <hr>
                                                    <p class="mb-2">
                                                        Se informa a la <strong>comunidad del CUH</strong> que, a partir del <strong>lunes 12 de enero</strong>,<br>
                                                        la calle Tierra y Libertad <strong>estará en proceso de reparación</strong><br>
                                                        por parte de las autoridades municipales de Pachuca.
                                                    </p>
                                                    <p class="mb-2">
                                                        Por este motivo, <strong>el servicio de estacionamiento permanecerá temporalmente suspendido hasta nuevo aviso.</strong>
                                                    </p>
                                                    <p class="mb-2">
                                                        Por seguridad de todas y todos, se recomienda <strong>tomar previsiones, considerar rutas alternas y ajustar sus tiempos de traslado.</strong><br>
                                                        Agradecemos su comprensión y colaboración.
                                                    </p>
                                                    <hr>
                                                    <address class="mb-0">
                                                        <strong>Blvd. del Minero 305,<br>
                                                        Javier Rojo Gómez, 42030 Pachuca de Soto, Hgo.<br>
                                                        771 719 4495<br>
                                                        www.cuh.edu.mx</strong>
                                                    </address>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Botón 4: Calendario Escolar 2026 -->
                                    <div class="mb-3">
                                        <button class="btn bg-navy btn-lg btn-block text-left" type="button" 
                                                data-toggle="collapse" data-target="#calendarioEscolar" 
                                                aria-expanded="false" aria-controls="calendarioEscolar">
                                            <i class="fas fa-calendar-alt mr-2"></i> Calendario Escolar 2026
                                            <i class="fas fa-chevron-down float-right mt-1"></i>
                                        </button>

                                        <div class="collapse mt-2" id="calendarioEscolar">
                                            <div class="card card-body border-navy">
                                                <h5 class="text-center text-navy mb-3">
                                                    <strong>Calendario Escolar 2026 - POSGRADO</strong>
                                                </h5>
                                                
                                                <!-- Mensaje principal -->
                                                <div class="alert alert-info text-center">
                                                    <h6><i class="fas fa-calendar-check mr-2"></i> ¡Te invitamos a checar nuestro calendario oficial 2026!</h6>
                                                    <p class="mb-2">
                                                        Consulta todas las fechas importantes del ciclo escolar 2026 para posgrado
                                                    </p>
                                                </div>

                                                <!-- Contenedor del iframe -->
                                                <div class="documento-iframe-container mt-3">
                                                    <div class="card">
                                                        <div class="card-header bg-light">
                                                            <h6 class="mb-0">Vista previa del calendario - Posgrado</h6>
                                                        </div>
                                                        <div class="card-body p-0">
                                                            <iframe src="https://drive.google.com/file/d/1a-OKwbuwvPViuK5WVrs_DzXVVfto383e/preview?usp=sharing" 
                                                                    width="100%" 
                                                                    height="500" 
                                                                    loading="lazy"
                                                                    title="Calendario Escolar 2026 - Posgrado"
                                                                    class="border-0">
                                                            </iframe>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Botón para abrir en nueva pestaña -->
                                                <div class="text-center mt-3">
                                                    <a href="https://drive.google.com/file/d/1j3LoS8bE7UIEthlXQnGvthE0hTnCyuN7/view?usp=sharing" 
                                                    target="_blank" 
                                                    rel="noopener noreferrer"
                                                    class="btn btn-primary btn-lg">
                                                    <i class="fas fa-external-link-alt mr-2"></i> Abrir calendario en nueva pestaña
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Columna para el carrusel de imágenes (lado derecho más grande) -->
                                <div class="col-lg-6 col-md-6">
                                    <div class="sticky-top" style="top: 20px;">
                                        <div class="card border-navy shadow-lg">
                                            <div class="card-header bg-navy text-white text-center">
                                                <h5 class="mb-0"><i class="fas fa-images mr-2"></i> ANUNCIOS DESTACADOS - POSGRADO</h5>
                                            </div>
                                            <div class="card-body p-0">
                                                <!-- Carrusel de Bootstrap -->
                                                <div id="carouselAnuncios" class="carousel slide" data-ride="carousel" data-interval="5000">
                                                    <!-- Indicadores -->
                                                    <ol class="carousel-indicators">
                                                        <li data-target="#carouselAnuncios" data-slide-to="0" class="active"></li>
                                                        <li data-target="#carouselAnuncios" data-slide-to="1"></li>
                                                        <li data-target="#carouselAnuncios" data-slide-to="2"></li>
                                                    </ol>
                                                    
                                                    <!-- Slides del carrusel -->
                                                    <div class="carousel-inner">

                                                        <!-- Slide 1: Aviso estacionamiento (1) -->
                                                        <div class="carousel-item active">
                                                            <img src="{{ asset('dist/img/anuncios/Anuncio2026 (1).webp') }}"
                                                                class="d-block w-100 carousel-image"
                                                                alt="Aviso estacionamiento 1"
                                                                style="height: 400px; object-fit: contain; background:#fff; cursor: pointer;"
                                                                onclick='abrirImagenModal("{{ asset("dist/img/anuncios/Anuncio2026 (1).webp") }}", "Aviso estacionamiento 1")'>

                                                            <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded p-2">
                                                                <h6 class="mb-1">Aviso de estacionamiento</h6>
                                                                <p class="small mb-0">El estacionamiento anterior fue cancelado.</p>
                                                            </div>
                                                        </div>

                                                        <!-- Slide 2: Aviso estacionamiento (2) -->
                                                        <div class="carousel-item">
                                                            <img src="{{ asset('dist/img/anuncios/Anuncio20262 (1).webp') }}"
                                                                class="d-block w-100 carousel-image"
                                                                alt="Aviso estacionamiento 2"
                                                                style="height: 400px; object-fit: contain; background:#fff; cursor: pointer;"
                                                                onclick='abrirImagenModal("{{ asset("dist/img/anuncios/Anuncio20262 (1).webp") }}", "Aviso estacionamiento 2")'>

                                                            <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded p-2">
                                                                <h6 class="mb-1">Nueva ubicación del estacionamiento</h6>
                                                                <p class="small mb-0">
                                                                    Se compartió la nueva ubicación del estacionamiento externo.
                                                                </p>
                                                            </div>
                                                        </div>

                                                        <!-- Slide 3: Calendario escolar - IFRAME DE GOOGLE DRIVE -->
                                                        <div class="carousel-item">
                                                            <div class="w-100" style="height: 400px; overflow: hidden;">
                                                                <iframe src="https://drive.google.com/file/d/1a-OKwbuwvPViuK5WVrs_DzXVVfto383e/preview?usp=sharing"
                                                                        class="w-100 h-100 border-0"
                                                                        title="Calendario Escolar 2026 - Posgrado"
                                                                        loading="lazy">
                                                                </iframe>
                                                            </div>
                                                            <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded p-2">
                                                                <h6 class="mb-1">Calendario Escolar 2026</h6>
                                                                <p class="small mb-0">Consulta todas las fechas importantes del ciclo escolar</p>
                                                            </div>
                                                        </div>

                                                    </div>

                                                    
                                                    <!-- Controles del carrusel -->
                                                    <a class="carousel-control-prev" href="#carouselAnuncios" role="button" data-slide="prev">
                                                        <span class="carousel-control-prev-icon bg-dark bg-opacity-50 rounded-circle p-2" aria-hidden="true"></span>
                                                        <span class="sr-only">Anterior</span>
                                                    </a>
                                                    <a class="carousel-control-next" href="#carouselAnuncios" role="button" data-slide="next">
                                                        <span class="carousel-control-next-icon bg-dark bg-opacity-50 rounded-circle p-2" aria-hidden="true"></span>
                                                        <span class="sr-only">Siguiente</span>
                                                    </a>
                                                </div>
                                                
                                                <!-- Información sobre el anuncio actual -->
                                                <div class="p-3">
                                                    <div id="infoAnuncio1" class="anuncio-info">
                                                        <h6 class="text-center text-navy mb-2">
                                                            <strong>Suspensión de Estacionamiento</strong>
                                                        </h6>
                                                        <p class="small text-muted text-center mb-3">
                                                            A partir del lunes 14 de enero, la calle Tierra y Libertad estará en reparación por parte de las autoridades municipales.
                                                        </p>
                                                        
                                                        <!-- Botón para ver detalles -->
                                                        <div class="text-center">
                                                            <button class="btn btn-sm btn-outline-navy mb-2"
                                                                    data-toggle="collapse" 
                                                                    data-target="#comunicadoEstacionamiento"
                                                                    onclick="scrollToElement('#comunicadoEstacionamiento')">
                                                                <i class="fas fa-info-circle mr-1"></i> Ver detalles completos
                                                            </button>
                                                        </div>
                                                    </div>
                                                    
                                                    <div id="infoAnuncio2" class="anuncio-info" style="display: none;">
                                                        <h6 class="text-center text-navy mb-2">
                                                            <strong>Calendario Escolar 2026 - POSGRADO</strong>
                                                        </h6>
                                                        <p class="small text-muted text-center mb-3">
                                                            Consulta todas las fechas importantes, periodos vacacionales y días festivos del ciclo escolar 2026.
                                                        </p>
                                                        
                                                        <!-- Botón para ver detalles -->
                                                        <div class="text-center">
                                                            <button class="btn btn-sm btn-outline-navy mb-2"
                                                                    data-toggle="collapse" 
                                                                    data-target="#calendarioEscolar"
                                                                    onclick="scrollToElement('#calendarioEscolar')">
                                                                <i class="fas fa-info-circle mr-1"></i> Ver calendario completo
                                                            </button>
                                                            <a href="https://drive.google.com/file/d/1a-OKwbuwvPViuK5WVrs_DzXVVfto383e/preview?usp=sharing" 
                                                            target="_blank" 
                                                            rel="noopener noreferrer"
                                                            class="btn btn-sm btn-outline-primary">
                                                                <i class="fas fa-external-link-alt mr-1"></i> Abrir en Drive
                                                            </a>
                                                        </div>
                                                    </div>
                                                    
                                                    <div id="infoAnuncio3" class="anuncio-info" style="display: none;">
                                                        <h6 class="text-center text-navy mb-2">
                                                            <strong>Actualización de Costos 2026-2027</strong>
                                                        </h6>
                                                        <p class="small text-muted text-center mb-3">
                                                            Información sobre inscripciones, colegiaturas y otros costos para el próximo ciclo escolar.
                                                        </p>
                                                        
                                                        <!-- Botón para ver detalles -->
                                                        <div class="text-center">
                                                            <a href="https://drive.google.com/file/d/1JmnmA2cEqbOz0hLeLPil8Owx9XIlJTQl/view" 
                                                            target="_blank" 
                                                            rel="noopener noreferrer"
                                                            class="btn btn-sm btn-outline-primary">
                                                            <i class="fas fa-external-link-alt mr-1"></i> Abrir en Drive
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- FIN SECCIÓN DE AVISOS IMPORTANTES -->
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <script>
        const PRIVACIDAD_ESTADO_URL = "{{ route('privacidad.estado') }}";
        const PRIVACIDAD_ACEPTAR_URL = "{{ route('privacidad.aceptar') }}";
        const CSRF_TOKEN = "{{ csrf_token() }}";
        
        // Variable global para la imagen actual del modal
        let imagenActualModal = "{{ asset('dist/img/Anuncio.webp') }}";
        let nombreImagenActual = "Comunicado de estacionamiento";

        // Función para abrir imagen en modal
        function abrirImagenModal(src, nombre) {
            imagenActualModal = src;
            nombreImagenActual = nombre;
            document.getElementById('imagenModalCompleta').src = src;
            document.getElementById('imagenModalCompleta').alt = nombre;
            $('#modalImagenCompleta').modal('show');
        }

        // Función para descargar la imagen actual
        function descargarImagen() {
            const link = document.createElement('a');
            link.href = imagenActualModal;
            link.download = nombreImagenActual.replace(/\s+/g, '_') + '.jpg';
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        }

        // Función para desplazarse a un elemento
        function scrollToElement(selector) {
            const element = document.querySelector(selector);
            if (element) {
                element.scrollIntoView({ behavior: 'smooth', block: 'start' });
                
                // Si el elemento está colapsado, lo abre
                if ($(selector).hasClass('collapse') && !$(selector).hasClass('show')) {
                    $(selector).collapse('show');
                }
            }
        }

        // Función para cambiar slide manualmente
        function cambiarSlide(index) {
            $('#carouselAnuncios').carousel(index);
            actualizarInformacionSlide(index);
        }

        // Actualizar información según el slide
        function actualizarInformacionSlide(index) {
            // Ocultar toda la información
            $('.anuncio-info').hide();
            
            // Mostrar la información correspondiente
            $('#infoAnuncio' + (index + 1)).show();
            
            // Actualizar contador
            $('#contadorSlide').text((index + 1) + '/3');
        }

        // Inicializar carrusel y eventos
        document.addEventListener('DOMContentLoaded', function() {
            // Configurar carrusel
            $('#carouselAnuncios').on('slide.bs.carousel', function (event) {
                const index = event.to;
                actualizarInformacionSlide(index);
            });
            
            // Inicializar primera información
            actualizarInformacionSlide(0);
            
            // Hacer las imágenes del carrusel más interactivas
            const carouselImages = document.querySelectorAll('.carousel-image');
            carouselImages.forEach(img => {
                img.addEventListener('mouseenter', function() {
                    this.style.transform = 'scale(1.03)';
                    this.style.transition = 'transform 0.3s ease';
                });
                
                img.addEventListener('mouseleave', function() {
                    this.style.transform = 'scale(1)';
                });
            });
            
            // Agregar cursor pointer a miniaturas
            document.querySelectorAll('.cursor-pointer').forEach(el => {
                el.style.cursor = 'pointer';
                el.addEventListener('mouseenter', function() {
                    this.style.boxShadow = '0 4px 8px rgba(0,0,0,0.2)';
                    this.style.transform = 'translateY(-2px)';
                    this.style.transition = 'all 0.3s ease';
                });
                
                el.addEventListener('mouseleave', function() {
                    this.style.boxShadow = '';
                    this.style.transform = '';
                });
            });
            
            // Opcional: Agregar funcionalidad de zoom con doble clic en modal
            const imagenCompleta = document.querySelector('#imagenModalCompleta');
            if (imagenCompleta) {
                let zoom = 1;
                imagenCompleta.addEventListener('dblclick', function() {
                    zoom = zoom === 1 ? 2 : 1;
                    this.style.transform = `scale(${zoom})`;
                    this.style.transition = 'transform 0.3s ease';
                });
                
                // Resetear zoom cuando se cierra el modal
                $('#modalImagenCompleta').on('hidden.bs.modal', function () {
                    imagenCompleta.style.transform = 'scale(1)';
                });
            }
        });
    </script>

    <script src="{{ asset('js/iniciolicu.js') }}"></script>
@endsection