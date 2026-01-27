<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Carga_academica extends Model
{
    // nombre tabla
    protected $table='carga_academica';
    // id
    protected $primaryKey = 'clave_grupo';
    // id no es incrementable 123456789
    public $incrementing = false;

    public function calendario_periodo()
    {
        return $this->belongsTo(Calendario_periodo::class, 'periodo');
    }
}
