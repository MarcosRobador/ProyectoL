@extends('layouts.plantilla')

@section('content')
    <a class="nav-link" href="{{ route('user.zapatillas.index') }}">
        <i class="fas fa-arrow-left fa-2x"></i>
    </a>
    <div class="row">
        <div class="col-md-8 offset-md-2 mt-5 mb-5">        
            <div class="card m-5">
                @if ($zapatilla->image)
                    <img src="{{ asset('storage/' . $zapatilla->image) }}" class="card-img-top" alt="Imagen de {{ $zapatilla->nombre }}">
                @endif
                <div class="card-body">
                    <h1 class="card-title">{{ $zapatilla->nombre }}</h1>
                    <p class="card-text"><strong>Descripción: </strong>{{ $zapatilla->descripcion }}</p>
                    <p class="card-text"><strong>Precio:</strong> ${{ $zapatilla->precio }}</p>
                    <p class="card-text"><strong>Stock:</strong> {{ $zapatilla->stock }}</p>
                    <form action="{{ route('cart.add', $zapatilla->id) }}" method="POST" class="mt-2 add-to-cart-form" id="add-to-cart-form-{{ $zapatilla->id }}">
                        @csrf
                        <button type="button" class="btn btn-outline-success add-to-cart-button" data-id="{{ $zapatilla->id }}">
                            <i class="fas fa-shopping-cart"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
