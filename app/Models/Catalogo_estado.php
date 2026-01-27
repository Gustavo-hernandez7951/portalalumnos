<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Catalogo_estado extends Model
{
    // nombre tabla
    protected $table='catalogo_estados';
    // id
    protected $primaryKey = 'idestado';
    // id no es incrementable 123456789
    public $incrementing = false;
}
