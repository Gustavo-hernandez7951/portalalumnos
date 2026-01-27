<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Movimiento_beca extends Model
{
    // nombre tabla
    protected $table='movimientos_becas';
    // id
    protected $primaryKey = 'folio_movto_beca';
    // id no es incrementable 123456789
    public $incrementing = false;

    public function cat_programa()
    {
        return $this->belongsTo(Catalogo_programa::class, 'programa');
    }

    public function cat_turno()
    {
        return $this->belongsTo(Catalogo_turno::class, 'turno');
    }

    public function cat_modbeca()
    {
        return $this->belongsTo(Catalogo_modalidadbeca::class, 'idmodalidadbeca');
    }
}
