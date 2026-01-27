<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Catalogo_tipoexamen extends Model
{
    // nombre tabla
    protected $table='catalogo_tipoexamen';
    // id
    protected $primaryKey = 'idtipoexamen';
    // id no es incrementable 123456789
    public $incrementing = false;

    public function calificacion()
    {
        return $this->hasMany(Calificacion::class, 'idtipoexamen');
    }
    public function Historial_academico()
    {
        return $this->hasMany(Historial_academico::class, 'idtipoexamen');
    }
}
