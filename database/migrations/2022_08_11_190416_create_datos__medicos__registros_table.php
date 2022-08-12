<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDatosMedicosRegistrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datos_medicos_registros', function (Blueprint $table) {
            $table->id();
            $table->integer("user_id")->unsigned();
            $table->string("eps", 70);
            $table->string("tipo_sangre", 150);
            $table->string("alergias", 150);
            $table->string("patologias", 150);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('datos__medicos__registros');
    }
}
