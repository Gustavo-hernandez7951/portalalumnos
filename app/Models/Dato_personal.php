<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Dato_personal;
use auth;

class Dato_personal extends Model
{
    // nombre tabla
    protected $table='datos_personales';
    // id
    protected $primaryKey = 'matricula';
    // id no es incrementable 123456789
    public $incrementing = false;

    public function adeudo()
    {
        return $this->belongsTo(Adeudo::class, 'matricula');
    }

    public function cat_beca()
    {
        return $this->hasMany(Catalogo_beca::class, 'idbeca', 'tipo_beca');
    }

    public function cat_modbeca()
    {
        return $this->hasMany(Catalogo_modalidadbeca::class, 'idmodalidadbeca', 'modalidadbeca');
    }

    public function cat_programa()
    {
        return $this->belongsTo(Catalogo_programa::class, 'programa');
    }

    public function cat_turno()
    {
        return $this->belongsTo(Catalogo_turno::class, 'turno');
    }

    public function cat_municipio()
    {
        $dps = dato_personal::where('matricula', Auth::user()->cuenta)->first();
        return $this->hasOne(Catalogo_municipio::class,'idestado','estado')->where('idmunicipio',$dps->municipio);
    }

    public function cat_estado()
    {
        return $this->belongsTo(Catalogo_estado::class, 'estado');
    }

    public function cat_gradoacademico()
    {
        return $this->belongsTo(Catalogo_gradoacademico::class, 'gradoacademico');
    }

    public function cat_statusadmin()
    {
        return $this->belongsTo(Catalogo_statusadmin::class, 'status_admvo');
    }

    public function cat_enfasis()
    {
        return $this->belongsTo(Catalogo_enfasis::class, 'enfasis');
    }
}
