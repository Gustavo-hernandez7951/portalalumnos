<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Catalogo_turno extends Model
{
    // nombre tabla
    protected $table='catalogo_turnos';
    // id
    protected $primaryKey = 'idturno';
    // id no es incrementable 123456789
    public $incrementing = false;
}
