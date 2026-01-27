<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Catalogo_gradoacademico extends Model
{
    // nombre tabla
    protected $table='catalogo_gradoacademico';
    // id
    protected $primaryKey = 'idgradoacademico';
    // id no es incrementable 123456789
    public $incrementing = false;
}
