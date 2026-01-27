<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Catalogo_periodo_servsocial extends Model
{
    // nombre tabla
    protected $table='catalogo_periodos_servsocial';
    // id
    protected $primaryKey = 'idperiodo_servsocial';
    // id no es incrementable 123456789
    public $incrementing = false;

    public function servsocial()
    {
        return $this->hasMany(Servicio_social::class, 'idperiodo_servsocial');
    }
}
