<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Boleta de Calificaciones - CUH</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
            line-height: 1.6;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 30px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            position: relative;
            min-height: 100vh;
        }

        header {
            text-align: center;
            margin-bottom: 10px;
        }

        .institution-name {
            font-size: 24px;
            font-weight: bold;
            color: #003366;
            margin-bottom: 5px;
        }

        .slogan {
            font-style: italic;
            color: #555;
            margin-bottom: 15px;
        }

        .header-border {
            border-bottom: 2px solid #006699;
            margin-bottom: 10px;
        }

        .date {
            text-align: right;
            font-size: 14px;
            color: #444;
            margin-bottom: 10px;
        }

        .title {
            text-align: center;
            font-size: 20px;
            color: #003366;
            margin: 25px 0;
            font-weight: bold;
        }

        .info-block {
            text-align: left;
            margin-bottom: 20px;
            font-size: 12px;
            line-height: 1.2;
        }

        .info-block h5 {
            margin: 0.5em 0;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            font-size: 10px;
        }

        th {
            background-color: #003366;
            color: white;
            padding: 8px;
            text-align: center;
            font-size: 10px;
        }

        td {
            padding: 6px;
            border: 1px solid #ddd;
            text-align: center;
            font-size: 10px;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .signature {
            margin-top: 50px;
            text-align: center;
            font-size: 12px;
        }

        .signature-line {
            width: 250px;
            border-top: 1px solid #000;
            margin: 5px auto;
        }

        .contact-info {
            text-align: center;
            font-size: 10px;
            color: #666;
            margin-top: 5px;
        }

        footer {
            text-align: center;
            font-size: 10px;
            color: #777;
            margin-top: 5px;
            padding-top: 10px;
            border-top: 1px solid #eee;
        }

        .highlight {
            font-weight: bold;
            color: #003366;
        }

        /* Espacio mínimo entre firma y footer */
        .signature + footer {
            margin-top: 5px;
        }

        @media (max-width: 600px) {
            table, thead, tbody, th, td, tr {
                display: block;
            }

            thead {
                display: none;
            }

            td {
                text-align: left;
                padding-left: 50%;
                position: relative;
            }

            td::before {
                content: attr(data-label);
                position: absolute;
                left: 10px;
                font-weight: bold;
                white-space: nowrap;
            }
        }

        @media print {
            .container {
                margin: 0;
                padding: 20px;
                box-shadow: none;
                min-height: 270mm;
            }
            
            footer {
                margin-top: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <div class="institution-name">CENTRO UNIVERSITARIO HIDALGUENSE</div>
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
            <div class="title">MAESTRÍA - BOLETA DE CALIFICACIONES</div>

            <div class="info-block">
                <h5><span class="highlight">MAESTRIA EN: {{$cuatrimestres->cat_programa->descripcion}}</span></h5>
                <h5>
                    <span><strong>R.V.O.E.</strong> {{$cuatrimestres->cat_programa->rvoe}}</span><br>
                    <span><strong>ALUMNO:</strong> {{ Auth::user()->nombre }}</span><br>
                    <span><strong>MATRÍCULA:</strong> {{ Auth::user()->cuenta }}</span><br>
                    <span><strong>SISTEMA ESCOLARIZADO</strong></span>
                </h5>
            </div>

            <section>
                <table>
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">CLAVE</th>
                            <th scope="col">ASIGNATURA</th>
                            <th scope="col">CALIF.</th>
                            <th scope="col">TIPO EXAMEN</th>
                            <th scope="col">DOCENTE</th>
                            <th scope="col">GRUPO</th>
                            <th scope="col">TURNO</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        @foreach($calificaciones as $calificacion)
                            <tr>
                                <td data-label="#">{{$i++}}</td>
                                <td data-label="CLAVE">{{$calificacion->clave_mat}}</td>
                                <td data-label="ASIGNATURA">{{$calificacion->asignatura}}</td>
                                <td data-label="CALIF." class="highlight">{{$calificacion->calificacion}}</td>
                                <td data-label="TIPO EXAMEN">{{$calificacion->catalogo_tipoexamen->descripcion_tipoexamen}}</td>
                                <td data-label="DOCENTE">{{$calificacion->catalogo_docente->siglas_titulo}}
                                    {{$calificacion->catalogo_docente->nombre}}
                                    {{$calificacion->catalogo_docente->paterno}}
                                    {{$calificacion->catalogo_docente->materno}}</td>
                                <td data-label="GRUPO">{{$calificacion->grupo}}</td>
                                <td data-label="TURNO">{{$calificacion->cat_turno->descripcion}}</td>
                                <td class="text-center">{{$calificacion->periodo}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </section>

            <div class="signature">
                <img src="dist/img/Firma_Psic.Angelica.png" alt="Firma" style="width: 180px; margin-bottom: 10px;">
                <div class="signature-line"></div>
                <p>
                    PSIC. ROSA ANGÉLICA ESTRADA NOVALES<br>
                    <strong>DIRECTORA DE MAESTRÍAS</strong>
                </p>
            </div>
        </main>

        <footer>
            <div class="contact-info">
                <h4>Boulevard del Minero No. 305, Col. Rojo Gómez, Pachuca, Hidalgo. C.P. 42030 Tel: (771) 719 5300 / (771) 719 5301</h4>
            </div>
            <h5>© {{ date('Y') }} Centro Universitario Hidalguense - Todos los derechos reservados</h5>
        </footer>
    </div>
</body>
</html>