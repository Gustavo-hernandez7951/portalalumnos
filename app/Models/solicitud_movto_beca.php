<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class solicitud_movto_beca extends Model
{
    // nombre tabla
    protected $table='solicitudes_movto_beca';
    // id
    protected $primaryKey = 'idsolicitud';
    // id no es incrementable 123456789
    public $incrementing = false;

    public function cat_beca()
    {
        return $this->hasMany(Catalogo_beca::class, 'idbeca', 'tipo_beca');
    }

    public function cat_modbeca()
    {
        return $this->hasMany(Catalogo_modalidadbeca::class, 'idmodalidadbeca', 'modalidadbeca');
    }

    public function cat_movbeca()
    {
        return $this->hasMany(Catalogo_movimientosbeca::class, 'clave_movimiento', 'tipo_solicitud');
    }

    public function cat_statusbeca()
    {
        return $this->hasMany(Catalogo_status_solicitud_movtosbeca::class, 'idstatus_solicitud_movtobeca', 'status_solicitud');
    }

}
