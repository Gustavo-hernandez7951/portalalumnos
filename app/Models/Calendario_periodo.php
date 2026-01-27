<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Calendario_periodo extends Model
{
    // nombre tabla
    protected $table='calendario_periodos';
    // id
    protected $primaryKey = 'clave_periodo';
    // id no es incrementable 123456789
    public $incrementing = false;

    public function carga_academica()
    {
        return $this->hasMany(carga_academica::class, 'clave_periodo');
    }
}
