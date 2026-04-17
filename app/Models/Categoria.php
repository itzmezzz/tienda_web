<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Categoria extends Model
{
    protected $table = 'categorias';

    protected $fillable = ['nombre'];

    /**
     * Relación: Una categoría tiene muchos productos.
     */
    public function productos(): HasMany
    {
        // Importante: 'id_categoria' debe ser el nombre de la columna en tu tabla 'productos'
        return $this->hasMany(Producto::class, 'id_categoria');
    }
}