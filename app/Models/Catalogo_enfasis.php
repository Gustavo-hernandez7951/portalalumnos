<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Catalogo_enfasis extends Model
{
    // nombre tabla
    protected $table='catalogo_enfasis';
    // id
    protected $primaryKey = 'idenfasis';
    // id no es incrementable 123456789
    public $incrementing = false;
}
