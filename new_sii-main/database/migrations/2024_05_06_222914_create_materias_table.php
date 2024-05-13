<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void {
        Schema::create('materias', function (Blueprint $table) {
            $table->id();
            $table->string('calve_materia',10)->unique();
            $table->string('nombre')->nullable(false);
            $table->tinyinteger('creditos')->nullable(false);
        });
    }

    public function down(): void {
        Schema::dropIfExists('materias');
    }
};