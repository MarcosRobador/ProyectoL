@extends('layouts.plantilla')

@section('content')
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card m-4">
                @if ($zapatilla->image)
                    <img src="{{ asset('storage/' . $zapatilla->image) }}" class="card-img-top" alt="Imagen de {{ $zapatilla->nombre }}">
                @endif
                <div class="card-body">
                    <h1 class="card-title">{{ $zapatilla->nombre }}</h1>
                    <p class="card-text">{{ $zapatilla->descripcion }}</p>
                    <p class="card-text"><strong>Precio:</strong> ${{ $zapatilla->precio }}</p>
                    <p class="card-text"><strong>Stock:</strong> {{ $zapatilla->stock }}</p>
                    <a href="{{ route('zapatillas.edit', $zapatilla->id) }}" class="btn btn-primary">Editar</a>
                    <form action="{{ route('zapatillas.destroy', $zapatilla->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
