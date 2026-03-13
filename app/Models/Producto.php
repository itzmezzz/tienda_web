<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory; 
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

     protected $fillable = [
        'nombre', 'descripcion', 'precio', 'stock', 'numero_tomo', 'isbn',
        'id_autor', 'id_categoria', 'id_serie', 'id_editorial', 'imagen'
    ];

    // Relación con Autor
    public function autor()
    {
        return $this->belongsTo(Autore::class, 'id_autor');
    }

    // Relación con Serie
    public function serie()
    {
        return $this->belongsTo(Serie::class, 'id_serie');
    }

    // Relación con Categoría
    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'id_categoria');
    }

    // Relación con Editorial
    public function editorial()
    {
        return $this->belongsTo(Editorial::class, 'id_editorial');
    }
}
