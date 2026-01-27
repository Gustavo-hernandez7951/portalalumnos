<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Catalogo_docente extends Model
{
    // nombre tabla
    protected $table='catalogo_docentes';
    // id
    protected $primaryKey = 'clave_docente';
    // id no es incrementable 123456789
    public $incrementing = false;

    public function calificacion()
    {
        return $this->hasMany(Calificacion::class, 'clave_docente');
    }
}
