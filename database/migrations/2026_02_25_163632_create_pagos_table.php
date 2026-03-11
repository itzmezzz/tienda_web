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
        Schema::create('pagos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_venta')
          ->constrained('ventas')
          ->cascadeOnDelete();

    $table->enum('metodo_pago', ['paypal','stripe']);
    $table->decimal('monto', 10, 2);
    $table->timestamp('fecha')->useCurrent();
    $table->string('estado', 50)->default('pendiente');
    $table->string('referencia_pago')->nullable();
    $table->string('payer_email', 150)->nullable();
    $table->string('payment_intent_id', 100)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pagos');
    }
};
