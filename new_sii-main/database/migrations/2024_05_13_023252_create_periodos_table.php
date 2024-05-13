<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void {
        Schema::create('periodos', function (Blueprint $table) {
            $table->id();
            $table->char('clave_periodo',4)->unique();
            $table->string('nombre_periodo')->nullable(false);
            $table->string('estatus')->nullable(false);
        });
    }

    public function down(): void {
        Schema::dropIfExists('periodos');
    }
    
};