<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'description',
        'image',
    ];

    // Accesor para obtener la imagen por defecto si no hay imagen
    public function getImageAttribute($value)
    {
        return $value ?: 'images/product-default.png';
    }
}
