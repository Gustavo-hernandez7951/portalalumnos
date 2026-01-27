<!DOCTYPE html>

@php
use Illuminate\Support\Facades\Auth;
@endphp

<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Portal Escolar CUH</title>

  <!-- Favicons -->
  <link href="dist/img/favicon.png" rel="icon">
  <link href="dist/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Iconos impresionantes de fuente -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Estilo del tema -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Fuente de Google: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous"> -->

  <!-- cargar archivos pdf -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

  <!-- autoload -->
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script>
    $(document).ready(function(){
      $("#autoopen").modal('show');

    });
  </script>

  <script>
    function desactiva_enlace(enlace)
    {
          enlace.disabled='disabled';
    }
    </script>

</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">

    <!-- Navbar : Barra de navegación -->
    <nav class="main-header navbar navbar-expand navbar-dark navbar-navy">
      <!-- Enlaces de la barra de navegación izquierda -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="/" class="nav-link">Página Web</a>
        </li>
      </ul>
    <ul class="navbar-nav ml-auto">
      <li class="nav-item dropdown">
        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
          {{ Auth::user()->nombre }} <span class="caret"></span>
        </a>

        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="{{ url('password') }}">
          {{ __('Cambiar Contraseña') }}
        </a>

          <a class="dropdown-item" href="{{ route('logout') }}"
          onclick="event.preventDefault();
          document.getElementById('logout-form').submit();">
          {{ __('Cerrar Sesion') }}
          </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          @csrf
          </form>
        </div>

      </li>

    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary navbar-navy elevation-4">

    <!-- Brand Logo -->
    <a href="/portal/" class="brand-link">
      <img src="dist/img/cuhtext.jpeg" alt="cuh Logo" class="brand-image img-circle elevation-3">
      <span class="brand-text font-weight-light"><strong>LICENCIATURA</strong></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/cuhuser.jpeg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="serviciosescolares-datospersonales" class="d-block">{{ Auth::user()->cuenta }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
  
          <!-- menu inicio -->
          <li class="nav-item">
            <a href="home" class="nav-link {{ request()->is('home') ? 'active' : ''}}">
              <i class="nav-icon fa fa-home"></i> <p>INICIO</p>
            </a>
          </li>

          <!-- menu calificaciones -->
          <li class="nav-item   {{ request()->is('calificaciones-boleta') ? 'menu-open' : ''}}
                                {{ request()->is('calificaciones-parciales') ? 'menu-open' : ''}}">
            <a href="#" class="nav-link {{ request()->is('calificaciones-boleta') ? 'active' : ''}}
                                        {{ request()->is('calificaciones-parciales') ? 'menu-open' : ''}}">
              <i class="nav-icon fas fa-check"></i><p>CALIFICACIONES<i class="right fas fa-angle-left"></i></p>
            </a>
            
            <ul class="nav nav-treeview">
              <!-- sub menu bimestre actual -->
              <li class="nav-item">
                <a href="calificaciones-boleta" class="nav-link {{ request()->is('calificaciones-boleta') ? 'active' : ''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Boleta</p>
                </a>
              </li>
            </ul>
          </li>

          <!-- menu servicios escolares -->
          <li class="nav-item {{ request()->is('serviciosescolares-datospersonales') ? 'menu-open' : ''}}
                              {{ request()->is('serviciosescolares-historialacademico') ? 'menu-open' : ''}}
                              {{ request()->is('serviciosescolares-kardex') ? 'menu-open' : ''}}
                              {{ request()->is('serviciosescolares-constanciaconafe') ? 'menu-open' : ''}}
                              {{ request()->is('serviciosescolares-serviciosocial') ? 'menu-open' : ''}}">
            <a href="#" class="nav-link {{ request()->is('serviciosescolares-datospersonales') ? 'active' : ''}}
                                        {{ request()->is('serviciosescolares-historialacademico') ? 'active' : ''}}
                                        {{ request()->is('serviciosescolares-kardex') ? 'active' : ''}}
                                        {{ request()->is('serviciosescolares-serviciosocial') ? 'active' : ''}}">
              <i class="nav-icon fas fa-database"></i>
              <p>SERVICIOS ESCOLARES
              <i class="right fas fa-angle-left"></i>
              </p>
            </a>

            <ul class="nav nav-treeview">
              <!-- submenu datos personales -->
              <li class="nav-item">
                <a href="serviciosescolares-datospersonales" class="nav-link {{ request()->is('serviciosescolares-datospersonales') ? 'active' : ''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Datos Personales</p>
                </a>
              </li>
              <!-- submenu kardex -->
              <li class="nav-item">
                <a href="#kardex" data-toggle="modal" class="nav-link {{ request()->is('serviciosescolares-kardex') ? 'active' : ''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Kardex</p>
                </a>
              </li>
              <!-- submenu servicio social -->
              <li class="nav-item">
                <a href="serviciosescolares-serviciosocial" class="nav-link {{ request()->is('serviciosescolares-serviciosocial') ? 'active' : ''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Servicio Social</p>
                </a>
              </li>
            </ul>
          </li>

          <!-- menu tesorería -->
          <li class="nav-item {{ request()->is('finanzas-adeudos') ? 'menu-open' : ''}}
                              {{ request()->is('finanzas-reinscripcion') ? 'menu-open' : ''}}
                              {{ request()->is('finanzas-datosfiscales') ? 'menu-open' : ''}}">
            <a href="#" class="nav-link {{ request()->is('finanzas-adeudos') ? 'active' : ''}}
                                        {{ request()->is('finanzas-reinscripcion') ? 'active' : ''}}
                                        {{ request()->is('finanzas-datosfiscales') ? 'active' : ''}}">
              <i class="nav-icon fas fa-balance-scale"></i>
              <p>TESORERIA
              <i class="right fas fa-angle-left"></i>
              </p>
            </a>

            <ul class="nav nav-treeview">
              <!-- submenu estado de cuenta -->
              <li class="nav-item">
                <a href="finanzas-adeudos" class="nav-link {{ request()->is('finanzas-adeudos') ? 'active' : ''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Adeudos</p>
                </a>
              </li>
            </ul>
          </li>

          <!-- menu administracion -->
          <li class="nav-item {{ request()->is('administracion-beca-solicitud') ? 'menu-open' : ''}}
                              {{ request()->is('administracion-beca-reactivacion') ? 'menu-open' : ''}}
                              {{ request()->is('administracion-beca-renovacion') ? 'menu-open' : ''}}">
            <a href="#" class="nav-link {{ request()->is('administracion-beca-solicitud') ? 'active' : ''}}
                                        {{ request()->is('administracion-beca-reactivacion') ? 'active' : ''}}
                                        {{ request()->is('administracion-beca-renovacion') ? 'active' : ''}}">
              <i class="nav-icon fas fa-cogs"></i>
              <p>ADMINISTRACION
              <i class="right fas fa-angle-left"></i>
              </p>
            </a>

            <ul class="nav nav-treeview">
              <!-- submenu solicitud beca -->
              <li class="nav-item {{ request()->is('administracion-beca-solicitud') ? 'menu-open' : ''}}
                                  {{ request()->is('administracion-beca-reactivacion') ? 'menu-open' : ''}}
                                  {{ request()->is('administracion-beca-renovacion') ? 'menu-open' : ''}}">
                <a href="#" class="nav-link ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Beca
                  <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="administracion-beca-solicitud" class="nav-link {{ request()->is('administracion-beca-solicitud') ? 'active' : ''}}">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Otorgamiento</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="administracion-beca-renovacion" class="nav-link {{ request()->is('administracion-beca-renovacion') ? 'active' : ''}}">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Renovación Anual</p>
                    </a>
                  </li>
                </ul>
              </li>
            </ul>
          </li>

          <!-- menu direccion academica -->
          <li class="nav-item {{ request()->is('direccionacademica-cargaacademica') ? 'menu-open' : ''}}">
            <a href="#" class="nav-link {{ request()->is('direccionacademica-cargaacademica') ? 'active' : ''}}">
              <i class="nav-icon fas fa-university"></i>
              <p>DIRECCION ACADEMICA
              <i class="right fas fa-angle-left"></i>
              </p>
            </a>

            <ul class="nav nav-treeview">
              <!-- submenu carga academica -->
              <li class="nav-item">
                <a href="direccionacademica-cargaacademica" class="nav-link {{ request()->is('direccionacademica-cargaacademica') ? 'active' : ''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Carga Académica</p>
                </a>
              </li>
            </ul>
          </li>

          <!-- menu biblioteca -->
          <li class="nav-item {{ request()->is('biblioteca-digital') ? 'menu-open' : ''}}
                              {{ request()->is('biblioteca-librosenprestamo') ? 'menu-open' : ''}}
                              {{ request()->is('biblioteca-consultabibliografia') ? 'menu-open' : ''}}">
            <a href="#" class="nav-link {{ request()->is('biblioteca-digital') ? 'active' : ''}}
                                        {{ request()->is('biblioteca-librosenprestamo') ? 'active' : ''}}
                                        {{ request()->is('biblioteca-consultabibliografia') ? 'active' : ''}}">
              <i class="nav-icon fas fa-book"></i>
              <p>BIBLIOTECA
              <i class="right fas fa-angle-left"></i>
              </p>
            </a>

            <ul class="nav nav-treeview">
              <!-- submenu Biblioteca digital -->
              <li class="nav-item">
                <a href="biblioteca-digital" class="nav-link {{ request()->is('biblioteca-digital') ? 'active' : ''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Biblioteca digital</p>
                </a>
              </li>
            </ul>
          </li>

          <!-- menu vacunacion -->
          <li class="nav-item {{ request()->is('estudiosocioeconomico-descargar') ? 'menu-open' : ''}}
                              {{ request()->is('titulaciones') ? 'menu-open' : ''}}">
            <a href="#" class="nav-link {{ request()->is('estudiosocioeconomico-descargar') ? 'active' : ''}}
                                        {{ request()->is('titulaciones') ? 'active' : ''}}">
              <i class="nav-icon fas fa-file"></i>
              <p>DOCUMENTOS
              <i class="right fas fa-angle-left"></i>
              </p>
            </a>

            <ul class="nav nav-treeview">
              <!-- submenu libros prestamo -->
              <li class="nav-item">
                <a href="estudiosocioeconomico-descargar" class="nav-link {{ request()->is('estudiosocioeconomico-descargar') ? 'active' : ''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Estudio socio <br/> económico</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <!-- submenu titulacion por promedio-->
              <li class="nav-item">
                <a href="titulaciones" class="nav-link {{ request()->is('titulaciones') ? 'active' : ''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Formas de </br>Titulacion</p>
                </a>
              </li>
            </ul>
          </li>

          <!-- menu Aviso de Privacidad -->
          <li class="nav-item">
              <a href="{{ route('avisoPrivacidad') }}" class="nav-link {{ request()->is('aviso-privacidad') ? 'active' : '' }}">
                  <i class="nav-icon fas fa-shield-alt"></i>
                  <p>Aviso de Privacidad</p>
              </a>
          </li>
        </ul>

      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Contenedor de contenido. Contiene contenido de la página -->
  <div class="content-wrapper">

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">

        <!-- Modal mensaje autoopen -->
        <div class="modal fade" id="kardex" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLongTitle">Kardex</h5>
                  </div>
                  <div class="modal-body">
                      <p align="center">El kardex es un documento que contiene todo tu historial académico, indica cada calificación y fecha de término de cursamiento.</p>
                      <div class="alert alert-light" role="alert">
                          <label class="col-md-12 col-form-label text-md-center">El tiempo de consulta varía de acuerdo al número de asignaturas cursadas 🕗</label>
                      </div>     
                  </div>
                  <div class="modal-footer">
                      <a href="serviciosescolares-kardex" aria-pressed="true">
                        <input name="" type="button" class="btn btn-info btn-lg btn-block" onClick="desactiva_enlace(this)" value="     Consultar Kardex     ">
                      </a>
                    <button type="button" class="btn btn-danger btn-lg" data-dismiss="modal">Salir</button>
                  </div>
              </div>
          </div>
      </div>

      <br>

      @yield('content')
      
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <!-- <h5>Title</h5> -->
      <!-- <p>Sidebar content</p> -->
    </div>
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; Centro Universitario Hidalguense.</strong> Derechos reservados.
  </footer>
  
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

@yield('script')

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>

</body>
</html>