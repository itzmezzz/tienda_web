<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DireccionUsuario extends Model
{
    protected $fillable = [
    'id_usuario', 'calle', 'ciudad', 'estado', 'codigo_postal', 'pais', 'referencia'
];
}
