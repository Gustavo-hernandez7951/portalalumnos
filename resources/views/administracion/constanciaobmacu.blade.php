<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <title>Constancia Otorgamiento Beca</title>

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
            Correos: finanzas.posgrado@cuh.edu.mx / veronica.lopez@posgradocuh.edu.mx<br>
            Telefonos: 771 221 3248 / 771 719 4495 ext. 111
        </p>
        <hr width=300>
        <h4 align="right" style="font-size:90%;">
            <?php
            $diassemana = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
            $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
            echo 'Pachuca, Hidalgo.  '.$diassemana[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y') ;
            ?>
        </h4>
        <h3 align="center" style="font-size:100%;">OTORGAMIENTO DE BECA {{$smb->ciclo_solicitud}}</h3>
        <p align="left" style="font-size:85%;">
            <strong>Estimado(a):</strong> {{ Auth::user()->nombre }}<br>
            <strong>Alumno(a) de:</strong> Posgrado C.U.H.<br>
            <strong>Matricula:</strong> {{ Auth::user()->cuenta }}<br>
            <strong>Programa en:</strong> {{trim($mov_beca->cat_programa->descripcion)}}<br>
            <strong>Grupo:</strong> {{$mov_beca->grupo}}<br>
            Presente.
        </p>
        <p align="justify" style="font-size:85%;">
        Es un gusto infórmale que su solicitud de beca y otorgamiento de la misma ha sido satisfactorio. Por tal motivo para el periodo ENERO-DICIEMBRE {{$smb->ciclo_solicitud}}, tendrá un descuento
        del {{$mov_beca->porcentaje_beca}}%, sobre el pago de colegiaturas mensuales, porcentaje correspondiente a la modalidad “{{trim($mov_beca->cat_modbeca->descripcionmodalidad)}}”. De esta manera
        a partir del mes de <?php
                            $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
                            echo $meses[date($mov_beca->mes_inicio_pago)-1];
        ?> {{$smb->ciclo_solicitud}}, cubrirá la cantidad de: <strong>${{$monto}}.00</strong>.
        </P>
        <p align="justify" style="font-size:85%;">
        Requerimentos para permanencia de beca:
        </P>
        <p align="justify" style="font-size:75%;">
        - Para conservar la beca autorizada en la presente, el alumno, deberá realizar sus depósitos dentro del periodo establecido del 1 al 20 de cada mes.<br>
        - Cuando la forma de pago sea mediante transferencias (TELECOM, SPEI, BANCA MOVIL, PAGO CON TARJETAS BANCARIAS) el alumno deberá realizar su pago tres días hábiles antes de la fecha limite (20 de cada mes) por cuestiones administrativas, de lo contrario el alumno asume y está consciente de la posibilidad de que su transacción no se registre dentro del periodo estipulado y de la suspensión de beca por consiguiente.<br>
        - No reprobar y en el supuesto de que el alumno repruebe una materia, su beca queda suspendida por un mes, es decir el alumno cubrirá una colegiatura sin beca (el mes que corresponda de acuerdo al registro de calificación en el perfil del alumno). Para los alumnos con beca ceneval o especial, el porcentaje a reactivar será el de universidad de procedencia.<br>
        - El alumno deberá conservar un promedio general mínimo de 8.0.<br>
        - No presentar adeudos financieros (convenios, colegiaturas o cualquier otro concepto).<br>
        - Es responsabilidad del alumno realizar y verificar, sus depósitos con los datos de su hoja de referencia bancaria, ya que en el supuesto de que el alumno deposite a otra cuenta o referencia bancaria (alumno), la institución no puede realizar ningún cambio, al ser este un trámite realizado por el alumno y la institución bancaria.<br>
        - En su momento, el alumno deberá realizar el trámite correspondiente para la renovación de beca según la fecha de convocatoria que se publique en la institución.<br>
        - No darse de baja, de solicitar baja temporal, la beca otorgada es cancelada y queda a consideración de la institución la reasignación al momento de su reincorporación.<br>
        - La institución está facultada para cancelar, suspender, cambiar, rechazar o revocar la beca otorgada en el supuesto de que el alumno incumpla con alguno de los termino u obligaciones de su carta compromiso, lineamientos de cada área perteneciente a posgrado centro universitario hidalguense, o incurra en faltas a las normas establecidas por la institución.<br>
        </P>       
        <br>
        <table align="center" style="border: hidden; width:100%">
            <tr style="border: hidden">
                <td style="border: hidden" align="center">
                        <img width="150" height="150" src="data:image/png;base64, {!! $qrcode !!}"><br>
                        <strong>DEPARTAMENTO DE TESORERIA</strong>
                </td>
            </tr>
        </table>
        <p align="left" style="font-size:75%;">
        c.c.p. Expediente
        </P>
    </body>
</html>