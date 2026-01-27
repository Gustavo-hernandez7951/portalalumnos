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
        <h2 align="center" style="font-size:100%;">Posgrado Centro Universitario Hidalguense A.C.</h2>
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
        <h3 align="center" style="font-size:100%;">Boleta de Calificaciones</h3>
        <p align="center" style="font-size:75%;">
            {{$cuatrimestres->cat_programa->descripcion}}<br>
            <strong>R.V.O.E.</strong> {{$cuatrimestres->cat_programa->rvoe}}
            |<strong> CUATRIMESTRE:</strong> {{$cuatrimestres->cuatrimestre}}<br>
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
                    <th scope="col" class="text-center" style="font-size:75%;">CALIF. LETRA</th>
                    <th scope="col" class="text-center" style="font-size:75%;">TIPO EXAMEN</th>
                    <th scope="col" class="text-center" style="font-size:75%;">DOCENTE</th>
                    <th scope="col" class="text-center" style="font-size:75%;">GRUPO</th>
                    <th scope="col" class="text-center" style="font-size:75%;">TURNO</th>
                    <th scope="col" class="text-center" style="font-size:75%;">FECHA EXAMEN</th>
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
                    <td style="font-size:75%;"><?php
                    switch ($calificacion->calificacion) {
                        case "1.0":
                            echo "UNO";
                            break;
                        case "2.0":
                            echo "DOS";
                            break;
                        case "3.0":
                            echo "TRES";
                            break;
                        case "4.0":
                            echo "CUATRO";
                            break;
                        case "5.0":
                            echo "CINCO";
                            break;
                        case "6.0":
                            echo "SEIS";
                            break;
                        case "7.0":
                            echo "SIETE";
                            break;
                        case "8.0":
                            echo "OCHO";
                            break;
                        case "9.0":
                            echo "NUEVE";
                            break;
                        case "10.0":
                            echo "DIEZ";
                            break;
                    }
                        ?></td>
                    <td style="font-size:75%;">{{$calificacion->catalogo_tipoexamen->descripcion_tipoexamen}}</td>
                    <td style="text-transform:uppercase;font-size:75%">{{$calificacion->catalogo_docente->siglas_titulo}}
                                            {{$calificacion->catalogo_docente->nombre}}
                                            {{$calificacion->catalogo_docente->paterno}}
                                            {{$calificacion->catalogo_docente->materno}}</td>
                    <td style="font-size:75%;">{{$calificacion->grupo}}</td>
                    <td style="font-size:75%;">{{$calificacion->cat_turno->descripcion}}</td>
                    <td style="font-size:75%;">{{$calificacion->fecha_examen}}</td>
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
                        <img src="dist\img\Firma_Psic.Angelica.png" alt="" />
                        <hr width=185>
                        <p style="font-size:75%;">
                            PSIC. ROSA ANGELICA ESTRADA NOVALES<br>
                            <strong>DIRECTORA DE MAESTRIAS</strong>
                        </p>
                </td>
            </tr>
        </table>
    </body>
</html>