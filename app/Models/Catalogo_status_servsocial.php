<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Catalogo_status_servsocial extends Model
{
    // nombre tabla
    protected $table='catalogo_status_servsocial';
    // id
    protected $primaryKey = 'idstatus_servsocial';
    // id no es incrementable 123456789
    public $incrementing = false;

    public function servsocial()
    {
        return $this->hasMany(Servicio_social::class, 'idstatus_servsocial');
    }
}
