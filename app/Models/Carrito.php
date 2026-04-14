<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Carrito extends Model
{
    // Definimos los campos que se pueden llenar masivamente
    protected $fillable = ['id_usuario', 'estado'];

    /**
     * Relación con los detalles del carrito
     */
    public function detalles(): HasMany
    {
        // Corregido: de $this.hasMany a $this->hasMany
        return $this->hasMany(DetalleCarrito::class, 'id_carrito');
    }

    /**
     * Relación con el usuario (opcional pero recomendada)
     */
    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }
}