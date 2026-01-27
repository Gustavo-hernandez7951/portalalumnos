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
                <div class="card-header text-center">
                    <strong>KARDEX</strong> <br>
                    <span>Esta información es de carácter informativo y carece de validez oficial</span>
                </div>

                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label text-md-right">MATRICULA:</label>
                        <p class="col-md-4 col-form-label text-md-left">{{ Auth::user()->cuenta }}</p>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label text-md-right">NOMBRE:</label>
                        <p class="col-md-4 col-form-label text-md-left">{{ Auth::user()->nombre }}</p>
                    </div>

                    <div class="row">
                        <div class="col-md-6 col-lg-6">
                            <!-- Promedio -->
                            <div class="info-box mb-3 bg-navy">
                                <span class="info-box-icon"><i class="fas fa-chart-bar"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">PROMEDIO GENERAL</span>
                                    <span class="info-box-number">{{ $promedio }}</span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-6">
                            <!-- Promedio -->
                            <div class="info-box mb-3 bg-navy">
                                <span class="info-box-icon"><i class="fas fa-list-ol"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">ASIGNATURAS CURSADAS</span>
                                    <span class="info-box-number">{{ $materiascount }}</span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive row">
                        <table class="table table-hover table-bordered" style="font-size:65%;">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="text-center">#</th>
                                    <th scope="col" class="text-center">CLAVE</th>
                                    <th scope="col" class="text-center">ASIGNATURA</th>
                                    <th scope="col" class="text-center">CAL ORD</th>
                                    <th scope="col" class="text-center">FECHA ORD</th>
                                    <th scope="col" class="text-center">CAL EXT</th>
                                    <th scope="col" class="text-center">FECHA EXT</th>
                                    <th scope="col" class="text-center">CAL O1R</th>
                                    <th scope="col" class="text-center">FECHA O1R</th>
                                    <th scope="col" class="text-center">CAL E1R</th>
                                    <th scope="col" class="text-center">FECHA E1R</th>
                                    <th scope="col" class="text-center">CAL O2R</th>
                                    <th scope="col" class="text-center">FECHA O2R</th>
                                    <th scope="col" class="text-center">CAL E2R</th>
                                    <th scope="col" class="text-center">FECHA E2R</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $i = 1; ?>
                            @foreach($asig as $as)
                                <tr>
                                    <th scope="row" class="text-center">{{$i++}}</th>
                                    <td class="text-center">{{$as['clave']}}</td>
                                    <td class="text-center">{{$as['asignatura']}}</td>
                                    <td class="text-center">{{$as['calord']}}</td>
                                    <td class="text-center">
                                    <?php
                                        if ($as['fechaord'] == '1900-01-01')
                                        {
                                            echo "EQV";
                                        }else
                                        {
                                            echo $as['fechaord'];
                                        }
                                    ?>
                                    </td>
                                    <td class="text-center">{{$as['calext']}}</td>
                                    <td class="text-center">{{$as['fechaext']}}</td>
                                    <td class="text-center">{{$as['calo1r']}}</td>
                                    <td class="text-center">{{$as['fechao1r']}}</td>
                                    <td class="text-center">{{$as['cale1r']}}</td>
                                    <td class="text-center">{{$as['fechae1r']}}</td>
                                    <td class="text-center">{{$as['calo2r']}}</td>
                                    <td class="text-center">{{$as['fechao2r']}}</td>
                                    <td class="text-center">{{$as['cale2r']}}</td>
                                    <td class="text-center">{{$as['fechae2r']}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection