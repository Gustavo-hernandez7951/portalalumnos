<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Catalogo_beca extends Model
{
    // nombre tabla
    protected $table='catalogo_becas';
    // id
    protected $primaryKey = 'idbeca';
    // id no es incrementable 123456789
    public $incrementing = false;

    public function dato_persona()
    {
        return $this->belongsTo(Dato_personal::class, 'tipo_beca');
    }
}
