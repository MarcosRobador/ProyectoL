@extends('layouts.plantilla')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1 class="mb-4">Zapatillas</h1>
            <a href="{{ route('zapatillas.create') }}" class="btn btn-info mb-4">
                <i class="fas fa-plus-circle"></i>
                Agregar Zapatilla</a>
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
                        <a href="{{ route('zapatillas.show', $zapatilla->id) }}" class="btn btn-outline-info">Edición
                            <i class="fas fa-info-circle"></i>
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
