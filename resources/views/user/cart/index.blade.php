@extends('layouts.plantilla')

@section('content')
    <div class="container mt-4">
        <h1>Carrito de Compras</h1>
        <table class="table text-center">
            <thead class="text-center">
                <tr>
                    <th>Imagen</th>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Stock</th>
                    <th>Total</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody class="text-center">
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
                            <td>
                                <form action="{{ route('cart.update', $item->zapatilla_id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <div class="input-group quantity-group">
                                        <button type="button" class="btn btn-outline-secondary btn-sm quantity-btn" onclick="updateQuantity({{ $item->zapatilla_id }}, -1)">-</button>
                                        <input type="number" name="quantity" id="quantity-{{ $item->zapatilla_id }}" class="form-control form-control-sm text-center quantity-input" value="{{ $item->quantity }}" min="1" max="{{ $item->zapatilla->stock }}" readonly>
                                        <button type="button" class="btn btn-outline-secondary btn-sm quantity-btn" onclick="updateQuantity({{ $item->zapatilla_id }}, 1)">+</button>
                                    </div>
                                </form>
                            </td>
                            <td>{{ $item->zapatilla->stock }}</td>
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
                        <td colspan="6" class="text-end"><strong>Total:</strong></td>
                        <td><strong>${{ $total }}</strong></td>
                    </tr>
                @else
                    <tr>
                        <td colspan="7" class="text-center">El carrito está vacío.</td>
                    </tr>
                @endif
            </tbody>
        </table>
        @if($cart && $cart->items->count() > 0)
            <div class="d-flex justify-content-end">
                <form action="{{ route('cart.checkout') }}" method="POST" class="me-2">
                    @csrf
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-shopping-cart"></i> Realizar Pago
                    </button>
                </form>
                <form action="{{ route('cart.clear') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-warning">
                        <i class="fas fa-trash-alt"></i> Vaciar Carrito
                    </button>
                </form>
            </div>
        @endif
    </div>
    <script>
        function updateQuantity(zapatillaId, change) {
            var quantityInput = document.getElementById('quantity-' + zapatillaId);
            var newQuantity = parseInt(quantityInput.value) + change;

            if (newQuantity > 0 && newQuantity <= parseInt(quantityInput.max)) {
                quantityInput.value = newQuantity;
                quantityInput.form.submit();
            }
        }
    </script>
@endsection
