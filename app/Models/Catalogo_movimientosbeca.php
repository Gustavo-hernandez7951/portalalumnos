<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Catalogo_movimientosbeca extends Model
{
    // nombre tabla
    protected $table='catalogo_movimientosbeca';
    // id
    protected $primaryKey = 'idmovimiento';
    // id no es incrementable 123456789
    public $incrementing = false;
}
