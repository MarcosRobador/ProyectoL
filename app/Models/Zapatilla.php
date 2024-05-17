<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zapatilla extends Model
{
    use HasFactory;

    // Define los atributos que pueden ser asignados masivamente
    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'stock',
    ];
}
