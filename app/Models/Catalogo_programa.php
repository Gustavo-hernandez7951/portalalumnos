<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Catalogo_programa extends Model
{
    // nombre tabla
    protected $table='catalogo_programas';
    // id
    protected $primaryKey = 'clave';
    // id no es incrementable 123456789
    public $incrementing = false;
}
