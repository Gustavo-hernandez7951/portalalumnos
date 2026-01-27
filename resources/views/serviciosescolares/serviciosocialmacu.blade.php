@extends('layouts.macu')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-navy">
                <div class="card-header">Servicio social</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    Este modulo no disponible para tu grado académico.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection