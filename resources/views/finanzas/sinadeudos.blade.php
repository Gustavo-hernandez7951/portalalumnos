@extends('layouts.layout')

@section('content')

@if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
@endif

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-10 col-md-offset-2">
            <div class="card card-navy">
                <div class="card-header">ADEUDOS</div>

                <div class="card-body">

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label text-md-right">MATRICULA:</label>
                        <p class="col-md-4 col-form-label text-md-left">{{ Auth::user()->cuenta }}</p>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label text-md-right">NOMBRE:</label>
                        <p class="col-md-4 col-form-label text-md-left">{{ Auth::user()->nombre }}</p>
                    </div>

                    <div class="alert alert-success" role="alert">
                        <div class="row">
                            <label class="col-md-6 col-form-label text-md-right">NO PRESENTA ADEUDOS</label>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection