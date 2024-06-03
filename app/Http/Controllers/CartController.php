<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Zapatilla;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cart = Cart::where('user_id', Auth::id())->with('items.zapatilla')->first();
        return view('user.cart.index', compact('cart'));
    }

    public function add(Request $request, $id)
    {
        $zapatilla = Zapatilla::findOrFail($id);
        $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);

        $cartItem = $cart->items()->where('zapatilla_id', $id)->first();
        $quantityToAdd = $request->quantity ?? 1;

        if ($cartItem) {
            if ($cartItem->quantity + $quantityToAdd > $zapatilla->stock) {
                return redirect()->route('cart.index')->with('error', 'No hay suficiente stock disponible.');
            }
            $cartItem->quantity += $quantityToAdd;
            $cartItem->save();
        } else {
            if ($quantityToAdd > $zapatilla->stock) {
                return redirect()->route('cart.index')->with('error', 'No hay suficiente stock disponible.');
            }
            $cart->items()->create([
                'zapatilla_id' => $id,
                'quantity' => $quantityToAdd,
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Zapatilla añadida al carrito!');
    }

    public function update(Request $request, $id)
    {
        $cart = Cart::where('user_id', Auth::id())->first();
        $cartItem = $cart->items()->where('zapatilla_id', $id)->first();

        if ($cartItem) {
            $zapatilla = $cartItem->zapatilla;
            $newQuantity = $request->quantity;

            if ($newQuantity > $zapatilla->stock) {
                return redirect()->route('cart.index')->with('error', 'No hay suficiente stock disponible.');
            }

            $cartItem->quantity = $newQuantity;
            $cartItem->save();

            return redirect()->route('cart.index')->with('success', 'Cantidad actualizada!');
        }

        return redirect()->route('cart.index')->with('error', 'El artículo no está en el carrito.');
    }

    public function remove(Request $request, $id)
    {
        $cart = Cart::where('user_id', Auth::id())->first();
        if ($cart) {
            $cartItem = $cart->items()->where('zapatilla_id', $id)->first();
            if ($cartItem) {
                $cartItem->delete();
            }
        }

        return redirect()->route('cart.index')->with('success', 'Zapatilla eliminada del carrito!');
    }

    public function clear()
    {
        $cart = Cart::where('user_id', Auth::id())->first();
        if ($cart) {
            $cart->items()->delete();
        }

        return redirect()->route('cart.index')->with('success', 'Carrito vaciado!');
    }
}
