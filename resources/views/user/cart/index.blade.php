@extends('layouts.plantilla')

@section('content')
    <div class="container mt-4">
        <h1>Carrito de Compras</h1>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
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
                    @foreach($cart->items as $item)
                        <tr>
                            <td><img src="{{ asset('storage/' . $item->zapatilla->image) }}" width="50" height="50" alt="{{ $item->zapatilla->nombre }}"></td>
                            <td>{{ $item->zapatilla->nombre }}</td>
                            <td>${{ $item->zapatilla->precio }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>${{ $item->zapatilla->precio * $item->quantity }}</td>
                            <td>
                                <form action="{{ route('cart.remove', $item->zapatilla_id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="6" class="text-center">El carrito está vacío.</td>
                    </tr>
                @endif
            </tbody>
        </table>
        <form action="{{ route('cart.clear') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-warning">Vaciar Carrito</button>
        </form>
    </div>
@endsection
