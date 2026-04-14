<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DetalleCarrito extends Model
{
    use HasFactory;

    protected $table = 'detalle_carritos';

    // IMPORTANTE: Cambiamos 'precio_unitario' por 'precio' 
    // para que coincida exactamente con tu última migración.
    protected $fillable = [
        'id_carrito',
        'id_producto',
        'cantidad',
        'precio' 
    ];

    /**
     * Relación: Un detalle pertenece a un carrito
     */
    public function carrito(): BelongsTo
    {
        return $this->belongsTo(Carrito::class, 'id_carrito');
    }

    /**
     * Relación: Un detalle pertenece a un producto (Manga)
     */
    public function producto(): BelongsTo
    {
        return $this->belongsTo(Producto::class, 'id_producto');
    }
}