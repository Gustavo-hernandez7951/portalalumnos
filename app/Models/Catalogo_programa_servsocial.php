<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Catalogo_programa_servsocial extends Model
{
    // nombre tabla
    protected $table='catalogo_programas_servsocial';
    // id
    protected $primaryKey = 'idprograma';
    // id no es incrementable 123456789
    public $incrementing = false;

    public function servsocial()
    {
        return $this->hasMany(Servicio_social::class, 'idprograma');
    }
}
