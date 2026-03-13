<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class serie extends Model
{
    use HasFactory;

    protected $fillable = ['nombre','descripcion','id_categoria'];
    public function categoria()
    {
        return $this->belongsTo(Categoria::class,'id_categoria');
    }
}
