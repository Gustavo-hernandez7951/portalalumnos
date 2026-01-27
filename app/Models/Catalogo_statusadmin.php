<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Catalogo_statusadmin extends Model
{
    // nombre tabla
    protected $table='catalogo_status_admvo';
    // id
    protected $primaryKey = 'idstatus';
    // id no es incrementable 123456789
    public $incrementing = false;
}
