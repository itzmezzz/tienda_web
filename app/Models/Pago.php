<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    protected $table = 'pagos';

    protected $fillable = [
        'id_venta',
        'metodo_pago',
        'monto',
        'fecha',
        'estado',
        'referencia_pago',
        'payer_email',
        'payment_intent_id'
    ];

    public function venta()
    {
        return $this->belongsTo(Venta::class, 'id_venta');
    }
}
