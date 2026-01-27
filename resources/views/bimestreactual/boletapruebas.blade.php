<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <title>Boleta de Calificaciones</title>

        <style>
    table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
    }
    </style>
    </head>
    <body>
        <h2 align="center" style="font-size:100%;">Centro Universitario Hidalguense A.C.</h2>
        <p align="center" style="font-size:75%;">
            <strong>La sabiduría es nuestra fuerza</strong><br>
            Boulevard del Minero #305, Colonia Rojo Gómez, C.P. 42030 Pachuca, Hgo.<br>
            Telefonos: (771) 719 5300 / (771) 719 5301
        </p>
        <hr width=300>
        <h4 align="right" style="font-size:90%;">
            <?php
            $diassemana = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
            $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
            echo $diassemana[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y') ;
            ?>
        </h4>
        <h3 align="center" style="font-size:100%;">LICENCIATURA</h3>
        <h3 align="center" style="font-size:100%;">Boleta de Calificaciones</h3>
        <p align="center" style="font-size:75%;">
            {{$periodos->cat_programa->descripcion}}<br>
            <strong>R.V.O.E.</strong> {{$periodos->cat_programa->rvoe}}
            |<strong> PERIODO:</strong> {{$periodos->periodo}}<br>
        </p>
        <br>
        <p align="left" style="font-size:75%;">
            <strong>ALUMNO:</strong> {{ Auth::user()->nombre }}<br>
            <strong>MATRICULA:</strong> {{ Auth::user()->cuenta }}
        </p>
        <table border="1" align="center">
            <thead>
                <tr>
                    <th scope="col" class="text-center" style="font-size:75%;">#</th>
                    <th scope="col" class="text-center" style="font-size:75%;">CLAVE</th>
                    <th scope="col" class="text-center" style="font-size:75%;">ASIGNATURA</th>
                    <th scope="col" class="text-center" style="font-size:75%;">CALIF.</th>
                    <th scope="col" class="text-center" style="font-size:75%;">TIPO EXAMEN</th>
                    <th scope="col" class="text-center" style="font-size:75%;">DOCENTE</th>
                    <th scope="col" class="text-center" style="font-size:75%;">GRUPO</th>
                    <th scope="col" class="text-center" style="font-size:75%;">TURNO</th>
                </tr>
            </thead>
            <tbody>
            <?php $i = 1; ?>
            @foreach($calificaciones as $calificacion)
                <tr align="center">
                    <th scope="row" style="font-size:75%;">{{$i++}}</th>
                    <td style="font-size:75%;">{{$calificacion->clave_mat}}</td>
                    <td style="font-size:75%;">{{$calificacion->asignatura}}</td>  
                    <td style="font-size:75%;">{{$calificacion->calificacion}}</td>
                    <td style="font-size:75%;">{{$calificacion->catalogo_tipoexamen->descripcion_tipoexamen}}</td>
                    <td style="text-transform:uppercase;font-size:75%">{{$calificacion->catalogo_docente->siglas_titulo}}
                                            {{$calificacion->catalogo_docente->nombre}}
                                            {{$calificacion->catalogo_docente->paterno}}
                                            {{$calificacion->catalogo_docente->materno}}</td>
                    <td style="font-size:75%;">{{$calificacion->grupo}}</td>
                    <td style="font-size:75%;">{{$calificacion->cat_turno->descripcion}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>

        <table align="center" style="border: hidden; width:100%">
            <tr style="border: hidden">
                <td style="border: hidden" align="center">
                        <img src="dist/img/firma-guille.png" alt="" />
                        <hr width=185>
                        <p style="font-size:75%;">
                            LIC. GUILLERMINA MARTINEZ HERNANDEZ<br>
                            <strong>DIRECTORA DE SERVICIOS ESCOLARES</strong>
                        </p>
                </td>
                <td style="border: hidden">
                </td>
                <!--
                <td style="border: hidden" align="center">
                        <img width="150" height="150" src="data:image/png;base64, {!! $qrcode !!}">
                </td>
                -->
            </tr>
        </table>
    </body>
</html>