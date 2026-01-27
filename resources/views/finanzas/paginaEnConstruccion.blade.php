@extends('layouts.licu')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Datos fiscales</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h3>No cuentas con datos fiscales, si lo necesitas acude al área de tesorería, gracias.</h3>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection