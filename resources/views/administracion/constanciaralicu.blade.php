<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <title>Constancia Renovación Anual</title>

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
            Telefonos: 771 719 5300 / 771 719 5301
        </p>
        <hr width=300>
        <h4 align="right" style="font-size:90%;">
            <?php
            $diassemana = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
            $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
            echo 'Pachuca, Hidalgo.  '.$diassemana[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y') ;
            ?>
        </h4>
        <h3 align="center" style="font-size:100%;">LICENCIATURA</h3>
        <h3 align="center" style="font-size:100%;">RENOVACION ANUAL DE BECA {{$smb->ciclo_solicitud}}</h3>
        <p align="left" style="font-size:85%;">
            <strong>C.</strong>   {{ Auth::user()->nombre }}<br>
            PRESENTE.
        </p>
        <p align="justify" style="font-size:85%;">
        Por medio del presente hago de su conocimiento que el alumno(a) {{ Auth::user()->nombre }} de la licenciatura en {{trim($mov_beca->cat_programa->descripcion)}}, del grupo {{$mov_beca->grupo}} del turno {{$mov_beca->cat_turno->descripcion}} con matricula {{trim($mov_beca->matricula)}}, ha realizado los tramites necesarios para la renovación anual de beca <strong>{{$smb->ciclo_solicitud}}</strong>.
        </P>
        <p align="justify" style="font-size:85%;">
        La beca tiene vigencia a partir de esta fecha hasta diciembre del {{$smb->ciclo_solicitud}}, por lo que a partir de este mes cubrirá la cantidad de <strong>${{$monto}}.00</strong> asignándole el porcentaje del {{$mov_beca->porcentaje_beca}}% sobre el pago de sus colegiaturas mensuales, derivado de la {{trim($mov_beca->cat_modbeca->descripcionmodalidad)}}, la cual mantendrá siempre y cuando conserve un promedio académico general mínimo de {{$mov_beca->calif_condicionada}}, no presente bajas temporales, registros de asignaturas reprobadas, con SD o NP, ni adeudos en el departamento de finanzas, convenios de pagos vigentes o pendientes, incurrir en alguna de las prohibiciones a los alumnos o incumplir con los términos y obligaciones establecidos en el reglamento general académico, lineamientos, carta compromiso o reglamentos de cada departamento perteneciente al Centro Universitario Hidalguense.
        </P>
        <p align="justify" style="font-size:85%;">
        No habrá ningún caso especial, aunque el alumno haya acreditado una asignatura en extraordinario, será sancionado un bimestre o lo equivalente a dos meses.
        </P>
        <p align="justify" style="font-size:85%;">
        Transferencias bancarias que realicen, deberán ser tres días hábiles antes del día 20 de cada mes por cuestiones administrativas (TELECOM, SPEI, BANCA MOVIL, PAGO CON TARJETAS BANCARIAS), si el alumno realiza transferencia el día 20 de cada mes, no será abonado ese mismo día al C.U.H. y por lo consiguiente tendrá que pagar colegiatura completa más recargos por día y acudir al departamento de tesorería para cualquier aclaración.
        </P>
        <p align="justify" style="font-size:85%;">
        Todo aquel alumno que por error deposite a otro número referenciado de un alumno, la institución no tendrá ninguna responsabilidad ya que los alumnos deberán arreglar entre ellos esa situación.
        </P>
        <p align="justify" style="font-size:85%;">
        Solo el Director General tiene la facultad de: autorizar, otorgar, incrementar, disminuir, suspender o cancelar una beca, de acuerdo al articulo 38 del reglamento general académico de la institución.
        </P>
        <p align="justify" style="font-size:85%;">
        Sin más por el momento quedo para cualquier aclaración al respecto acudir o llamar a la Dirección de Administración.
        </P>       
        <table align="center" style="border: hidden; width:100%">
            <tr style="border: hidden">
                <td style="border: hidden" align="center">
                        <br>
                        <br>
                        <img src="dist/img/firma-yanett.png" alt="" />
                        <hr width=150>
                        <p style="font-size:75%;">
                            LIC. ANGEL ANTONIO FLORES ISLAS<br>
                            <strong>ADMINISTRACION</strong><br>
                            <br>
                            administracion@cuh.edu.mx<br>
                        </p>
                </td>
                <td style="border: hidden">
                </td>
                <td style="border: hidden" align="center">
                        <img width="150" height="150" src="data:image/png;base64, {!! $qrcode !!}">
                </td>
            </tr>
        </table>
        <p align="left" style="font-size:75%;">
        c.c.p. Expediente
        </P>
    </body>
</html>