<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = ['user_id'];

    /**
     * Obtener los artículos del carrito.
     */
    public function items()
    {
        return $this->hasMany(CartItem::class);
    }

    /**
     * Obtener el usuario al que pertenece el carrito.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
