@extends('layouts.licu')

@section('content')

    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12 col-md-offset-2">
            <div class="card card-navy">
                <div class="card-header">INFORMACION</div>

                <div class="card-body">

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label text-md-right">MATRICULA:</label>
                        <p class="col-md-4 col-form-label text-md-left">{{ Auth::user()->cuenta }}</p>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label text-md-right">NOMBRE:</label>
                        <p class="col-md-4 col-form-label text-md-left">{{ Auth::user()->nombre }}</p>
                    </div>

                </div>               
            </div>
            @foreach($dps as $dp)
            <!-- Datos personales -->
            <div class="card card-navy collapsed-card">
                <div class="card-header">DATOS PERSONALES
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-plus"></i>
                    </div>
                </div>

                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">NOMBRE:</label>
                        <p class="col-md-4 col-form-label text-md-left">{{ $dp->nombre }}</p>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">APELLIDO PATERNO:</label>
                        <p class="col-md-4 col-form-label text-md-left">{{ $dp->paterno }}</p>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">APELLIDO MATERNO:</label>
                        <p class="col-md-4 col-form-label text-md-left">{{ $dp->materno }}</p>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">RFC:</label>
                        <p class="col-md-4 col-form-label text-md-left">{{ $dp->rfc }}</p>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">CURP:</label>
                        <p class="col-md-4 col-form-label text-md-left">{{ $dp->curp_alumno }}</p>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">FECHA DE NACIMIENTO:</label>
                        <p class="col-md-4 col-form-label text-md-left">{{ $dp->fecha_nacimiento }}</p>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">SEXO:</label>
                        <p class="col-md-4 col-form-label text-md-left">
                        <?php
                            if ($dp->sexo == 'F')
                            {
                                echo "FEMENINO";
                            }elseif ($dp->sexo == 'M')
                            {
                                echo "MASCULINO";
                            }
                        ?></p>
                    </div>
                </div>
            </div>
            <!-- Datos de contacto -->
            <div class="card card-navy collapsed-card">
                <div class="card-header">DATOS DE CONTACTO
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-plus"></i>
                    </div>
                </div>

                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">CALLE:</label>
                        <p class="col-md-6 col-form-label text-md-left">{{ $dp->calle }}</p>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">COLONIA:</label>
                        <p class="col-md-4 col-form-label text-md-left">{{ $dp->colonia }}</p>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">CIUDAD:</label>
                        <p class="col-md-4 col-form-label text-md-left">{{ $dp->ciudad }}</p>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">CODIGO POSTAL:</label>
                        <p class="col-md-4 col-form-label text-md-left">{{ $dp->codpostal }}</p>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">MUNICIPIO:</label>
                        <p class="col-md-6 col-form-label text-md-left">{{ $dp->cat_municipio->nombremunicipio }}</p>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">ESTADO:</label>
                        <p class="col-md-4 col-form-label text-md-left">{{ $dp->cat_estado->nombreestado }}</p>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">TELEFONO:</label>
                        <p class="col-md-4 col-form-label text-md-left">{{ $dp->telefono }}</p>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">CELULAR:</label>
                        <p class="col-md-4 col-form-label text-md-left">{{ $dp->celular }}</p>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">EMAIL:</label>
                        <p class="col-md-4 col-form-label text-md-left">{{ $dp->email }}</p>
                    </div>
                </div>
            </div>
            <!-- Datos de carrera -->
            <div class="card card-navy collapsed-card">
                <div class="card-header">CARRERA
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-plus"></i>
                    </div>
                </div>

                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">MATRICULA:</label>
                        <p class="col-md-4 col-form-label text-md-left">{{ $dp->matricula }}</p>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">GRADO ACADEMICO:</label>
                        <p class="col-md-4 col-form-label text-md-left">{{ $dp->cat_gradoacademico->descripcion_gradoacademico }}</p>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">PROGRAMA:</label>
                        <p class="col-md-4 col-form-label text-md-left">{{ $dp->cat_programa->descripcion }}</p>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">TURNO:</label>
                        <p class="col-md-4 col-form-label text-md-left">{{ $dp->cat_turno->descripcion }}</p>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">GRUPO:</label>
                        <p class="col-md-4 col-form-label text-md-left">{{ $dp->grupo }}</p>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">ESTATUS ADMINISTRATIVO:</label>
                        <p class="col-md-4 col-form-label text-md-left">{{ $dp->cat_statusadmin->descripcion_status }}</p>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">ENFASIS:</label>
                        <p class="col-md-4 col-form-label text-md-left">{{ $dp->cat_enfasis->descripcion_enfasis }}</p>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">PERIODO DE INICIO:</label>
                        <p class="col-md-4 col-form-label text-md-left">{{ $dp->periodo_inicio }}</p>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">CORREO INSTITUCIONAL:</label>
                        <p class="col-md-4 col-form-label text-md-left">{{ $dp->email_institucional }}</p>
                    </div>
                </div>
            </div>
            <!-- Datos de salud -->
            <div class="card card-navy collapsed-card">
                <div class="card-header">DATOS DE SALUD
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-plus"></i>
                    </div>
                </div>

                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">AVISAR A:</label>
                        <p class="col-md-4 col-form-label text-md-left">{{ $dp->avisar_a }}</p>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">DOMICILIO AVISAR:</label>
                        <p class="col-md-4 col-form-label text-md-left">{{ $dp->domicilio_avisar }}</p>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">TELEFONO AVISAR:</label>
                        <p class="col-md-4 col-form-label text-md-left">{{ $dp->tel_part }}</p>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">CELULAR AVISAR:</label>
                        <p class="col-md-4 col-form-label text-md-left">{{ $dp->tel_cel }}</p>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">EMAIL AVISO:</label>
                        <p class="col-md-4 col-form-label text-md-left">{{ $dp->email_aviso }}</p>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">TIPO DE SANGRE:</label>
                        <p class="col-md-4 col-form-label text-md-left">{{ $dp->tipo_sangre }}</p>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">PARENTESCO AVISAR:</label>
                        <p class="col-md-4 col-form-label text-md-left">{{ $dp->parentesco_avisar }}</p>
                    </div>
                </div>
            </div>
            <!-- Datos de documentacion -->
            <div class="card card-navy collapsed-card">
                <div class="card-header">DOCUMENTACION
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-plus"></i>
                    </div>
                </div>

                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">SOLICITUD:</label>
                        <p class="col-md-4 col-form-label text-md-left">
                        <?php
                            if ($dp->solicitud == true)
                            {
                                echo "✅";
                            }elseif ($dp->solicitud == false)
                            {
                                echo "❎";
                            }
                        ?>
                        </p>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">BACHILLERATO:</label>
                        <p class="col-md-4 col-form-label text-md-left">
                        <?php
                            if ($dp->bachillerato == true)
                            {
                                echo "✅";
                            }elseif ($dp->bachillerato == false)
                            {
                                echo "❎";
                            }
                        ?></p>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">SECUNDARIA:</label>
                        <p class="col-md-4 col-form-label text-md-left">
                        <?php
                            if ($dp->secundaria == true)
                            {
                                echo "✅";
                            }elseif ($dp->secundaria == false)
                            {
                                echo "❎";
                            }
                        ?></p>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">CARTA BC:</label>
                        <p class="col-md-4 col-form-label text-md-left">
                        <?php
                            if ($dp->carta_bc == true)
                            {
                                echo "✅";
                            }elseif ($dp->carta_bc == false)
                            {
                                echo "❎";
                            }
                        ?></p>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">ACTA DE NACIMIENTO:</label>
                        <p class="col-md-4 col-form-label text-md-left">
                        <?php
                            if ($dp->acta_nacimiento == true)
                            {
                                echo "✅";
                            }elseif ($dp->acta_nacimiento == false)
                            {
                                echo "❎";
                            }
                        ?></p>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">FOTOS:</label>
                        <p class="col-md-4 col-form-label text-md-left">
                        <?php
                            if ($dp->fotos == true)
                            {
                                echo "✅";
                            }elseif ($dp->fotos == false)
                            {
                                echo "❎";
                            }
                        ?></p>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">CURP:</label>
                        <p class="col-md-4 col-form-label text-md-left">
                        <?php
                            if ($dp->curp == true)
                            {
                                echo "✅";
                            }elseif ($dp->curp == false)
                            {
                                echo "❎";
                            }
                        ?></p>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">COMPROBANTE DE DOMICILIO:</label>
                        <p class="col-md-4 col-form-label text-md-left">
                        <?php
                            if ($dp->comp_dom == true)
                            {
                                echo "✅";
                            }elseif ($dp->comp_dom == false)
                            {
                                echo "❎";
                            }
                        ?></p>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">CERTIFICADO MEDICO:</label>
                        <p class="col-md-4 col-form-label text-md-left">
                        <?php
                            if ($dp->cert_med == true)
                            {
                                echo "✅";
                            }elseif ($dp->cert_med == false)
                            {
                                echo "❎";
                            }
                        ?></p>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">RECIBO INSCRIPCION:</label>
                        <p class="col-md-4 col-form-label text-md-left">
                        <?php
                            if ($dp->recibo_inscripcion == true)
                            {
                                echo "✅";
                            }elseif ($dp->recibo_inscripcion == false)
                            {
                                echo "❎";
                            }
                        ?></p>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">CERTIFICADO PARCIAL:</label>
                        <p class="col-md-4 col-form-label text-md-left">
                        <?php
                            if ($dp->cert_parcial == true)
                            {
                                echo "✅";
                            }elseif ($dp->cert_parcial == false)
                            {
                                echo "❎";
                            }
                        ?></p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

@endsection