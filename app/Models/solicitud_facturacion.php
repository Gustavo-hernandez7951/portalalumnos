<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class solicitud_facturacion extends Model
{
    // nombre tabla
    protected $table='solicitudes_facturacion';
    // id
    protected $primaryKey = 'id';
    // id no es incrementable 123456789
    public $incrementing = false;

    public function cat_status()
    {
        return $this->hasMany(Catalogo_status_solicitud_movtosbeca::class, 'idstatus_solicitud_movtobeca', 'status_solicitud');
    }
}
