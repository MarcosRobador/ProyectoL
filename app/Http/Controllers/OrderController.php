<?php


namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())->get();
        return view('user.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        // Verifica si el usuario autenticado es el propietario del pedido
        if ($order->user_id != Auth::id()) {
            return redirect()->route('orders.index')->with('error', 'No tienes permiso para ver este pedido.');
        }

        $order->load('items.zapatilla');
        return view('user.orders.show', compact('order'));
    }
}
