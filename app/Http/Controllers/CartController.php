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
        if ($cartItem) {
            $cartItem->quantity += 1;
            $cartItem->save();
        } else {
            $cart->items()->create([
                'zapatilla_id' => $id,
                'quantity' => 1,
            ]);
        }
    
        if ($request->ajax()) {
            $cartItems = $cart->items()->with('zapatilla')->get();
            return response()->json([
                'success' => 'Zapatilla añadida al carrito!',
                'cartItems' => $cartItems
            ]);
        }
    
        return redirect()->route('cart.index')->with('success', 'Zapatilla añadida al carrito!');
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
