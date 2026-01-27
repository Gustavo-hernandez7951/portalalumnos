<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Models\Calificacion;

class Catalogo_asignatura extends Model
{
    protected $table='catalogo_asignaturas';
    protected $primaryKey = 'clave_asig';
    public $incrementing = false;

    public function cal_ord()
    {
        $ord = ['ORD', 'EQV'];
        return $this->hasOne(Calificacion::class, 'clave_mat', 'clave_asig')
            ->where('matricula', Auth::user()->cuenta)
            ->where('categoria_calificacion', 'NO')
            ->whereIn('tipo_calificacion', $ord);
    }

    public function cal_ext()
    {
        return $this->hasOne(Calificacion::class, 'clave_mat', 'clave_asig')
            ->where('matricula', Auth::user()->cuenta)
            ->where('categoria_calificacion', 'NO')
            ->where('tipo_calificacion', 'EXT');
    }

    public function cal_o1r()
    {
        return $this->hasOne(Calificacion::class, 'clave_mat', 'clave_asig')
            ->where('matricula', Auth::user()->cuenta)
            ->where('categoria_calificacion', 'NO')
            ->where('tipo_calificacion', 'O1R');
    }

    public function cal_e1r()
    {
        return $this->hasOne(Calificacion::class, 'clave_mat', 'clave_asig')
            ->where('matricula', Auth::user()->cuenta)
            ->where('categoria_calificacion', 'NO')
            ->where('tipo_calificacion', 'E1R');
    }

    public function cal_o2r()
    {
        return $this->hasOne(Calificacion::class, 'clave_mat', 'clave_asig')
            ->where('matricula', Auth::user()->cuenta)
            ->where('categoria_calificacion', 'NO')
            ->where('tipo_calificacion', 'O2R');
    }

    public function cal_e2r()
    {
        return $this->hasOne(Calificacion::class, 'clave_mat', 'clave_asig')
            ->where('matricula', Auth::user()->cuenta)
            ->where('categoria_calificacion', 'NO')
            ->where('tipo_calificacion', 'E2R');
    }
}