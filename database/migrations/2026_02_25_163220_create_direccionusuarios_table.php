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
        Schema::create('direccionusuarios', function (Blueprint $table) {
            $table->id();
             $table->foreignId('id_usuario')
          ->constrained('users')
          ->cascadeOnDelete();
        $table->string('calle', 150)->nullable();
        $table->string('ciudad', 100)->nullable();
        $table->string('estado', 100)->nullable();
        $table->string('codigo_postal', 20)->nullable();
        $table->string('pais', 100)->nullable();
        $table->text('referencia')->nullable();
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('direccionusuarios');
    }
};
