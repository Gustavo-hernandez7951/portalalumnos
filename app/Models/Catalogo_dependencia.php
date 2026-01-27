<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Catalogo_dependencia extends Model
{
    // nombre tabla
    protected $table='catalogo_dependencias';
    // id
    protected $primaryKey = 'iddependencia';
    // id no es incrementable 123456789
    public $incrementing = false;

    public function servsocial()
    {
        return $this->hasMany(Servicio_social::class, 'iddependencia');
    }
}
