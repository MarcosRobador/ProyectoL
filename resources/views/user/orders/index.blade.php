@extends('layouts.plantilla')

@section('content')
    <div class="container mt-4">
        <h1>Mis Pedidos</h1>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <table class="table">
            <thead>
                <tr>
                    <th>ID Pedido</th>
                    <th>Total</th>
                    <th>Fecha</th>
                    <th>Fecha Estimada de Llegada</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>${{ $order->total }}</td>
                        <td>{{ $order->created_at }}</td>
                        <td>{{ \Carbon\Carbon::parse($order->created_at)->addDays(10)->format('d-m-Y') }}</td>
                        <td>
                            <a href="{{ route('orders.show', $order->id) }}" class="btn btn-info btn-sm">Ver Pedido</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
