<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Adeudo extends Model
{
    // nombre tabla
    protected $table='adeudos';
    // id
    protected $primaryKey = 'matricula';
    // id no es incrementable 123456789
    public $incrementing = false;

    public function dato_personal()
    {
        return $this->hasMany(Dato_personal::class, 'matricula');
    }

    public function C_S_F()
    {
        return $this->hasMany(Catalogo_servicio_finanzas::class, 'clave_servicio', 'clave_servicio');
    }
}
