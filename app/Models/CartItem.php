<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    protected $fillable = ['cart_id', 'zapatilla_id', 'quantity'];

    /**
     * Obtener la zapatilla asociada con el artículo del carrito.
     */
    public function zapatilla()
    {
        return $this->belongsTo(Zapatilla::class);
    }

    /**
     * Obtener el carrito al que pertenece el artículo.
     */
    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }
}
