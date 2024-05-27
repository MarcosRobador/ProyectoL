@extends('layouts.plantilla')

@section('content')

    <div class="row">
        @foreach ($zapatillas as $zapatilla)
            <div class="col-md-4 mb-4">
                <div class="card">
                    @if ($zapatilla->image)
                        <img src="{{ asset('storage/' . $zapatilla->image) }}" class="card-img-top" alt="Imagen de {{ $zapatilla->nombre }}">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $zapatilla->nombre }}</h5>
                        <p class="card-text">{{ $zapatilla->descripcion }}</p>
                        <a href="{{ route('user.zapatillas.show', $zapatilla->id) }}" class="btn btn-outline-info">
                            Ver más <i class="fas fa-info-circle"></i>
                        </a>
                        <form action="{{ route('cart.add', $zapatilla->id) }}" method="POST" class="mt-2">
                            @csrf
                            <button type="submit" class="btn btn-success">
                                Añadir al Carrito <i class="fas fa-shopping-cart"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
