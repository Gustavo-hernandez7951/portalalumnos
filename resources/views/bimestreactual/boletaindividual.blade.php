<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Boleta Individual - CUH</title>

    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; margin:0; padding:0; color:#333; line-height:1.6; }

        .container { max-width:800px; margin:20px auto; padding:30px; box-shadow:0 0 20px rgba(0,0,0,0.1); position:relative; min-height:100vh; }

        header { 
            text-align:left; /* Cambiado de center a left */
            margin-bottom:10px; 
            position:relative;
            min-height: 100px;
        }
        
        .institution-name { 
            font-size:24px; 
            font-weight:bold; 
            color:#003366; 
            margin-bottom:5px; 
            padding-left: 120px; /* Espacio para el logo */
        }
        
        .slogan { 
            font-style:italic; 
            color:#555; 
            margin-bottom:15px; 
            padding-left: 120px; /* Espacio para el logo */
        }
        
        .header-border { 
            border-bottom:2px solid #006699; 
            margin-bottom:10px; 
        }

        .logo-cuh {
            position: absolute;
            top: 0;
            left: 0;
            width: 110px;
            height: auto;
        }

        .date { text-align:right; font-size:14px; color:#444; margin-bottom:10px; }
        .title { text-align:center; font-size:20px; color:#003366; margin:25px 0; font-weight:bold; }

        .info-block { text-align:left; margin-bottom:20px; font-size:12px; line-height:1.2; }
        .info-block h5 { margin:0.5em 0; font-size:12px; }

        table { width:100%; border-collapse:collapse; margin:20px 0; font-size:10px; }
        th { background-color:#003366; color:white; padding:8px; text-align:center; font-size:10px; }
        td { padding:6px; border:1px solid #ddd; text-align:center; font-size:10px; }
        tr:nth-child(even) { background-color:#f9f9f9; }

        .signature { margin-top:50px; text-align:center; font-size:12px; }
        .signature-line { width:250px; border-top:1px solid #000; margin:5px auto; }

        .contact-info { text-align:center; font-size:10px; color:#666; margin-top:5px; }

        footer { text-align:center; font-size:10px; color:#777; margin-top:5px; padding-top:10px; border-top:1px solid #eee; }

        .highlight { font-weight:bold; color:#003366; }
    </style>
</head>
<body>

    <div class="container">
        <header>
            <img src="{{ asset('dist/img/Logo.png') }}" class="logo-cuh">
            <div class="institution-name">POSGRADO CENTRO UNIVERSITARIO HIDALGUENSE</div>
            <div class="slogan"><i>La Sabiduría es Nuestra Fuerza</i></div>
            <div class="header-border"></div>
        </header>

        <div class="date">
            <?php
            $diassemana = array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");
            $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
            echo $diassemana[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y');
            ?>
        </div>

        <main>
            <div class="title">BOLETA DE CALIFICACIONES</div>

            <div class="info-block">
                <h5><span class="highlight">MAESTRÍA EN: {{ $calificacion->cat_programa->descripcion ?? '' }}</span></h5>
                <h5>
                    <span><strong>ALUMNO:</strong> {{ Auth::user()->nombre }}</span><br>
                    <span><strong>MATRÍCULA:</strong> {{ Auth::user()->cuenta }}</span><br>
                    <span><strong>SISTEMA ESCOLARIZADO</strong></span>
                </h5>
            </div>

            <section>
                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>CLAVE</th>
                            <th>ASIGNATURA</th>
                            <th>CALIF.</th>
                            <th>TIPO EXAMEN</th>
                            <th>DOCENTE</th>
                            <th>GRUPO</th>
                            <th>PERIODO</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>{{ $calificacion->clave_mat }}</td>
                            <td>{{ $calificacion->asignatura }}</td>
                            <td class="highlight">{{ $calificacion->calificacion }}</td>
                            <td>{{ $calificacion->catalogo_tipoexamen->descripcion_tipoexamen }}</td>
                            <td>{{ $calificacion->catalogo_docente->nombre }} {{ $calificacion->catalogo_docente->paterno }} {{ $calificacion->catalogo_docente->materno }}</td>
                            <td>{{ $calificacion->grupo }}</td>
                            <td>{{$calificacion->periodo}}</td>
                        </tr>
                    </tbody>
                </table>
            </section>

            <div class="signature">
                <img src="{{ public_path('dist/img/Firma_Psic.Angelica.png') }}" width="180px">
                <div class="signature-line"></div>
                <p>
                    PSIC. ROSA ANGÉLICA ESTRADA NOVALES<br>
                    <strong>DIRECCIÓN DE MAESTRÍAS</strong>
                </p>
            </div>
        </main>

        <footer>
            <div class="contact-info">
                Boulevard del Minero No. 305, Col. Rojo Gómez, Pachuca, Hidalgo. C.P. 42030 Tel: (771) 719 5300 / (771) 719 5301
            </div>
            © {{ date('Y') }} Centro Universitario Hidalguense - Todos los derechos reservados
        </footer>
    </div>

</body>
</html>