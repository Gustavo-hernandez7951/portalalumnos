<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dato_facturacion extends Model
{
    // nombre tabla
    protected $table='datos_facturacion';
    // id
    protected $primaryKey = 'id';
    // id no es incrementable 123456789
    public $incrementing = false;
}
