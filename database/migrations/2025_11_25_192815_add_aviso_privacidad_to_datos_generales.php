<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAvisoPrivacidadToDatosGenerales extends Migration
{
    public function up()
    {
        Schema::table('datos_generales', function (Blueprint $table) {
            $table->boolean('aviso_privacidad_aceptado')->default(false);
        });
    }

    public function down()
    {
        Schema::table('datos_generales', function (Blueprint $table) {
            $table->dropColumn('aviso_privacidad_aceptado');
        });
    }
}
