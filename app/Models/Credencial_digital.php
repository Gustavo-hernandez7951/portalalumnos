<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Credencial_digital extends Model
{
    // nombre tabla
    protected $table='credenciales_digitales';
    // id
    protected $primaryKey = 'idempleado';
    // id no es incrementable 123456789
    public $incrementing = false;
}
