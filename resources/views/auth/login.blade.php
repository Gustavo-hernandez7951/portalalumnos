<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Portal CUH | Login</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Iconos impresionantes de fuente -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- Estilo del tema -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <!-- Fuente de Google: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link rel="icon" href="{{ asset('assets/img/favicon.png') }}">

    <!-- ===== ESTILOS PARA EL BOTÓN DE WHATSAPP ===== -->
    <style>
        .whatsapp-float {
            position: fixed;
            bottom: 30px;
            right: 30px;
            z-index: 1000;
        }

        .whatsapp-button {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background-color: #25D366;
            color: white;
            border: none;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            transition: all 0.3s ease;
            position: relative;
            text-decoration: none;
        }

        .whatsapp-button:hover {
            background-color: #128C7E;
            transform: scale(1.1);
        }

        .tooltip-text {
            position: absolute;
            right: 70px;
            top: 50%;
            transform: translateY(-50%);
            background-color: #333;
            color: white;
            padding: 8px 12px;
            border-radius: 4px;
            font-size: 14px;
            white-space: nowrap;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        .tooltip-text::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 100%;
            transform: translateY(-50%);
            border-width: 5px;
            border-style: solid;
            border-color: transparent transparent transparent #333;
        }

        .whatsapp-button:hover .tooltip-text {
            opacity: 1;
            visibility: visible;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .whatsapp-float {
                bottom: 20px;
                right: 20px;
            }
            
            .whatsapp-button {
                width: 50px;
                height: 50px;
                font-size: 20px;
            }
            
            .tooltip-text {
                display: none;
            }
        }
    </style>

</head>
<body class="container">

    <div class="text-center">
        <a href="/">
            <img class="img-fluid" src="dist/img/cuhhero.jpg" alt="User Image">
        </a>
    </div>

    <br>
    <div align='center'>
        <h5>Problemas con tu portal comunicate a: <br>
            <a href="https://wa.me/message/K4HBX25CPWALN1" style="color:#00bb2d;">Dirección de Sistemas <i class="fab fa-whatsapp"></i></a> <br>
        </h5>
    </div>

    <div class="row">
        <div class="col-lg-6 col-md-6 mt-4">
            <div class="container">
                <!-- /.login-logo -->
                <div class="card card-navy">
                    <div class="card-header">
                        <h3 class="card-title">Portal Escolar CUH</h3>
                    </div>
                    <div class="card-body login-card-body">
                        <div class="text-center">
                            <img class=" img-fluid" src="dist/img/cuhfull.jpg" alt="User Image">
                        </div>
                        <br>
                        <form method="POST" action="{{ route('login') }}">
                        @csrf
                            <!-- Input Matricula -->
                            <div class="input-group mb-3">                           
                                <input id="cuenta" type="txt" placeholder="Matricula" class="form-control @error('cuenta') is-invalid @enderror" name="cuenta" value="{{ old('cuenta') }}" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" required autocomplete="cuenta" autofocus>
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-user"></span>
                                    </div>
                                </div>
                            </div>
                            <!-- Input Contraseña -->
                            <div class="input-group mb-3">
                                <input id="password" type="password" placeholder="Contraseña" class="form-control @error('cuenta') is-invalid @enderror" name="password" required autocomplete="current-password">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-lock"></span>
                                    </div>
                                </div>
                                @error('cuenta')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-6">
                                    <div class="icheck-primary">
                                        <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                        <label for="remember">
                                        Recordar
                                        </label>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <button type="submit" class="btn btn-outline-primary btn-block">
                                    Iniciar Sesión
                                    </button>
                                </div>
                            </div>
                        </form>                
                    </div>           
                </div>
            </div>
        </div>
        <!--  -->
        <div class="col-lg-6 col-md-6 mt-4">
            <div class="container">
                <!-- /.login-logo -->
                <div class="card card-navy">
                    <div class="card-header">
                        <h3 class="card-title">Aviso de Privacidad</h3>
                    </div>
                    <div class="card-body login-card-body" align="center">
                    <iframe src="https://drive.google.com/file/d/1Edd5Tx6yURB0hU3j4PgT2SZOrtrWXQXc/preview" width="350" height="380"></iframe>                    
                    </div>            
                </div>
            </div>
        </div>
    </div>

    <!-- ===== BOTÓN DIRECTA A WHATSAPP ===== -->
    <div class="whatsapp-float">
        <a href="https://api.whatsapp.com/send?phone=7711120269" class="whatsapp-button" target="_blank">
            <i class="fab fa-whatsapp"></i>
            <span class="tooltip-text">¿Necesitas ayuda? Contáctanos</span>
        </a>
    </div>
    
    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>

</body>
</html>