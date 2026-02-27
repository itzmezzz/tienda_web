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
        Schema::create('envios', function (Blueprint $table) {
            $table->id();
             $table->foreignId('id_venta')
          ->constrained('ventas')
          ->cascadeOnDelete();

    $table->string('proveedor', 50)->default('DHL');
    $table->string('tracking_code', 100)->nullable();

    $table->enum('estado', [
        'pendiente',
        'en_transito',
        'entregado',
        'cancelado'
    ])->default('pendiente');

    $table->timestamp('fecha')->useCurrent();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('envios');
    }
};
