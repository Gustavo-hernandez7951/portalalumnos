<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Calificacion extends Model
{
    // nombre tabla
    protected $table='calificaciones';
    // id
    protected $primaryKey = 'matricula';
    // id no es incrementable 123456789
    public $incrementing = false;

    public function catalogo_docente()
    {
        return $this->belongsTo(Catalogo_docente::class, 'clave_docente');
    }
    public function catalogo_tipoexamen()
    {
        return $this->belongsTo(Catalogo_tipoexamen::class, 'tipo_calificacion');
    }

    public function adeudo()
    {
        return $this->belongsTo(Catalogo_asignatura::class, 'clave_mat');
    }

    public function cat_programa()
    {
        return $this->belongsTo(Catalogo_programa::class, 'programa');
    }

    public function cat_turno()
    {
        return $this->belongsTo(Catalogo_turno::class, 'turno');
    }
}
