<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Catalogo_modalidadbeca extends Model
{
    // nombre tabla
    protected $table='catalogo_modalidadbeca';
    // id
    protected $primaryKey = 'idmodalidadbeca';
    // id no es incrementable 123456789
    public $incrementing = false;
}
