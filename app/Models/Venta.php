<?php



namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Venta extends Model
{
    protected $table = 'ventas';

    protected $fillable = [
        'id_usuario',
        'id_direccion',
        'fecha',
        'total',
        'estado'
    ];

    /**
     * Relación: Una venta pertenece a un usuario
     */
    public function usuario(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }

    /**
     * Relación: Una venta tiene una dirección de envío
     */
    public function direccion(): BelongsTo
    {
        return $this->belongsTo(DireccionUsuario::class, 'id_direccion');
    }

    /**
     * Relación: Una venta tiene un pago asociado
     */
    public function pago(): HasOne
    {
        return $this->hasOne(Pago::class, 'id_venta');
    }
}