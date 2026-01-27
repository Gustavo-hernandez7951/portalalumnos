<!DOCTYPE html>
<html>
@php
use Illuminate\Support\Facades\Auth;
@endphp
<head>
    <meta charset="utf-8">
    <title>Kardex - {{ Auth::user()->nombre }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 11px; }
        h2 { text-align: center; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid black; padding: 4px; text-align: center; }
        th { background-color: #f0f0f0; }
    </style>
</head>
<body>
    <h2>KARDEX ACADÉMICO</h2>

    <p><strong>Matrícula:</strong> {{ Auth::user()->cuenta }}</p>
    <p><strong>Nombre:</strong> {{ Auth::user()->nombre }}</p>
    <p><strong>Promedio general:</strong> {{ $promedio }}</p>
    <p><strong>Total de asignaturas:</strong> {{ $materiascount }}</p>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Clave</th>
                <th>Asignatura</th>
                <th>Cal. Ord.</th>
                <th>Fecha Ord.</th>
                <th>Cal. Ext.</th>
                <th>Fecha Ext.</th>
            </tr>
        </thead>
        <tbody>
            @foreach($asig as $i => $a)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $a['clave'] }}</td>
                <td>{{ $a['asignatura'] }}</td>
                <td>{{ $a['calord'] }}</td>
                <td>{{ $a['fechaord'] == '1900-01-01' ? 'EQV' : $a['fechaord'] }}</td>
                <td>{{ $a['calext'] }}</td>
                <td>{{ $a['fechaext'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <p style="text-align:center; margin-top:20px;">
        <small>Esta información es de carácter informativo y carece de validez oficial.</small>
    </p>
</body>
</html>