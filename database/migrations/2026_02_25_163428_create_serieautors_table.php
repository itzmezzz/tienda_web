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
        Schema::create('serieautors', function (Blueprint $table) {
             $table->foreignId('id_serie')
          ->constrained('series')
          ->cascadeOnDelete();

    $table->foreignId('id_autor')
          ->constrained('autores')
          ->cascadeOnDelete();

    $table->primary(['id_serie', 'id_autor']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('serieautors');
    }
};
