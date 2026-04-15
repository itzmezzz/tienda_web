<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleVenta extends Model
{
    use HasFactory;

    // Si tu tabla no se llama "detalle_ventas", cámbiala aquí:
    protected $table = 'detalleventas'; 

    // Campos que permitimos llenar masivamente desde el controlador
    protected $fillable = [
        'id_venta',
        'id_producto',
        'cantidad',
        'precio',
        
    ];

    /**
     * Relación: Un detalle pertenece a una venta
     */
    public function venta()
    {
        return $this->belongsTo(Venta::class, 'id_venta');
    }

    /**
     * Relación: Un detalle pertenece a un producto (Manga)
     */
    public function producto()
    {
        return $this->belongsTo(Producto::class, 'id_producto');
    }
}