@extends('layouts.plantilla')

@section('content')
    <div class="container mt-4">
        <h1>Detalle del Pedido #{{ $order->id }}</h1>
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Información del Pedido</h5>
                <p><strong>ID Pedido:</strong> {{ $order->id }}</p>
                <p><strong>Total:</strong> ${{ $order->total }}</p>
                <p><strong>Fecha de Creación:</strong> {{ $order->created_at }}</p>
                <p><strong>Fecha Estimada de Llegada:</strong> {{ \Carbon\Carbon::parse($order->created_at)->addDays(10)->format('d-m-Y') }}</p>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Artículos del Pedido</h5>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Cantidad</th>
                            <th>Precio</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->items as $item)
                            <tr>
                                <td>{{ $item->zapatilla->nombre }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>${{ $item->price }}</td>
                                <td>${{ $item->price * $item->quantity }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <a href="{{ route('orders.index') }}" class="btn btn-primary mt-4">Volver a Mis Pedidos</a>
    </div>
@endsection
