@extends('layouts.plantilla')

@section('content')
    <div class="container mt-4">
        <h1>Carrito de Compras</h1>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <table class="table">
            <thead>
                <tr>
                    <th>Imagen</th>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Total</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @if($cart && $cart->items->count() > 0)
                    @php $total = 0; @endphp
                    @foreach($cart->items as $item)
                        @php
                            $subtotal = $item->zapatilla->precio * $item->quantity;
                            $total += $subtotal;
                        @endphp
                        <tr>
                            <td><img src="{{ asset('storage/' . $item->zapatilla->image) }}" width="50" height="50" alt="{{ $item->zapatilla->nombre }}"></td>
                            <td>{{ $item->zapatilla->nombre }}</td>
                            <td>${{ $item->zapatilla->precio }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>${{ $subtotal }}</td>
                            <td>
                                <form action="{{ route('cart.remove', $item->zapatilla_id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="4" class="text-end"><strong>Total:</strong></td>
                        <td><strong>${{ $total }}</strong></td>
                        <td></td>
                    </tr>
                @else
                    <tr>
                        <td colspan="6" class="text-center">El carrito está vacío.</td>
                    </tr>
                @endif
            </tbody>
        </table>
        @if($cart && $cart->items->count() > 0)
            <form action="{{ route('cart.checkout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-shopping-cart"></i> Comprar
                </button>
            </form>
        @endif
        <form action="{{ route('cart.clear') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-warning mt-4">
                <i class="fas fa-trash-alt"></i> Vaciar
            </button>
        </form>
    </div>
@endsection
