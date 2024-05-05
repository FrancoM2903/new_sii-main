<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('alumnos', function (Blueprint $table) {
            $table->id();
            $table->string('numero_control',15)->unique();
            $table->string('nombre')->nullable(false);
            $table->string('ap_paterno')->nullable(false);
            $table->string('ap_materno');
            $table->string('curp',18)->unique()->nullable(false);
            $table->integer('semestre')->nullable(false);
            //foráneas
            $table->unsignedBigInteger('plan_estudio_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('estatus_id'); //catalogo
            $table->unsignedBigInteger('tipo_alumno_id'); //catalogo

            //creando relaciones
            $table->foreign('plan_estudio_id')->references('id')->on('planes_estudio');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('estatus_id')->references('id')->on('estatus'); //catalogo
            $table->foreign('tipo_alumno_id')->references('id')->on('tipos_alumno'); //catalogo
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alumnos');
    }
};
