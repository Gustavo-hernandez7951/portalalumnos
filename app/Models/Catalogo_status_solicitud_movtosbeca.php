<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Catalogo_status_solicitud_movtosbeca extends Model
{
    // nombre tabla
    protected $table='catalogo_status_solicitud_movtosbeca';
    // id
    protected $primaryKey = 'idstatus_solicitud_movtobeca';
    // id no es incrementable 123456789
    public $incrementing = false;
}
