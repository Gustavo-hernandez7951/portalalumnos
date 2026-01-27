<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Catalogo_tipo_inscripcion_servsocial extends Model
{
    // nombre tabla
    protected $table='catalogo_tipo_inscripcion_servsocial';
    // id
    protected $primaryKey = 'idtipo_inscripcion';
    // id no es incrementable 123456789
    public $incrementing = false;

    public function servsocial()
    {
        return $this->hasMany(Servicio_social::class, 'idtipo_inscripcion');
    }
}
