<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Historial_academico extends Model
{
    // nombre tabla
    protected $table='historial_academico';
    // id
    protected $primaryKey = 'matricula';
    // id no es incrementable 123456789
    public $incrementing = false;

    public function catalogo_tipoexamen()
    {
        return $this->belongsTo(Catalogo_tipoexamen::class, 'tipo_examen');
    }
}
