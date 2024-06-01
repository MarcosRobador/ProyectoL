<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())->get();
        return view('user.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        if ($order->user_id != Auth::id()) {
            return redirect()->route('orders.index')->with('error', 'No tienes permiso para ver este pedido.');
        }

        $order->load('items.zapatilla');
        return view('user.orders.show', compact('order'));
    }

    public function cancel(Order $order)
    {
        if ($order->user_id != Auth::id()) {
            return redirect()->route('orders.index')->with('error', 'No tienes permiso para cancelar este pedido.');
        }

        // Eliminar los elementos del pedido
        $order->items()->delete();

        // Eliminar el pedido
        $order->delete();

        return redirect()->route('orders.index')->with('success', 'Pedido cancelado con éxito.');
    }
}

