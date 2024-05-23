@extends('layouts.plantilla')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="mb-4">Zapatillas</h1>
            </div>
        </div>

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
                            <p class="card-text"><strong>Precio:</strong> ${{ $zapatilla->precio }}</p>
                            <p class="card-text"><strong>Stock:</strong> {{ $zapatilla->stock }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
