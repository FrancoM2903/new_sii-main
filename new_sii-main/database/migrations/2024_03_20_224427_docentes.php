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
        Schema::create('docentes', function (Blueprint $table) {
            $table->id(); //integer, autoincrement, primary key
            $table->string('rfc',15)->unique(); 
            $table->string('nombre')->nullable(false);
            $table->string('ap_paterno')->nullable(false);
            $table->string('ap_materno');
            $table->string('curp')->unique()->nullable(false);
            $table->string('email')->unique()->nullable(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('docentes');
    }
};
