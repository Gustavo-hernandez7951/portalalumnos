<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Servicio_social extends Model
{
    // nombre tabla
    protected $table='servicio_social';
    // id
    protected $primaryKey = 'idservicio_social';
    // id no es incrementable 123456789
    public $incrementing = false;

    public function cat_tiss()
    {
        return $this->belongsTo(Catalogo_tipo_inscripcion_servsocial::class, 'tipo_inscripcion');
    }

    public function cat_dep()
    {
        return $this->belongsTo(Catalogo_dependencia::class, 'iddependencia_servicio');
    }

    public function cat_pross()
    {
        return $this->belongsTo(Catalogo_programa_servsocial::class, 'idprograma_servicio');
    }

    public function cat_perss()
    {
        return $this->belongsTo(Catalogo_periodo_servsocial::class, 'idperiodo_servicio');
    }

    public function cat_sss()
    {
        return $this->belongsTo(Catalogo_status_servsocial::class, 'status_servicio');
    }

}
