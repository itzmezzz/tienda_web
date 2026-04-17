<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DireccionUsuario extends Model
{
    // Esta línea es la que soluciona el error SQL que te salió
    protected $table = 'direccionusuarios';

    protected $fillable = [
        'id_usuario', 
        'calle', 
        'ciudad', 
        'estado', 
        'codigo_postal', 
        'pais', 
        'referencia'
    ];
    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }
}