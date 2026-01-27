<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class config extends Model
{
    // nombre tabla
    protected $table='configuracion';
    // id
    protected $primaryKey = 'num_serial';
    // id no es incrementable 123456789
    public $incrementing = false;
}
