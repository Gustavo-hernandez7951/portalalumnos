<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Catalogo_municipio extends Model
{
    // nombre tabla
    protected $table='catalogo_municipios';
    // id
    protected $primaryKey = 'idcat_municipio';
    // id no es incrementable 123456789
    public $incrementing = false;
}
