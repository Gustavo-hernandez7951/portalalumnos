<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Catalogo_servicio_finanzas extends Model
{
    // nombre tabla
    protected $table='catalogo_servicios_finanzas';
    // id
    protected $primaryKey = 'clave_servicio';
    // id no es incrementable 123456789
    public $incrementing = false;

    public function adeudo()
    {
        return $this->belongsTo(Adeudo::class, 'clave_servicio');
    }

}
