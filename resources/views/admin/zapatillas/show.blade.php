@extends('layouts.plantilla')

@section('content')
    <a class="nav-link" href="{{ route('zapatillas.index') }}">
        <i class="fas fa-arrow-left fa-2x"></i>
    </a>
    <div class="row">
        <div class="col-md-8 offset-md-2 mt-5 mb-5">        
            <div class="card m-4">
                @if ($zapatilla->image)
                    <img src="{{ asset('storage/' . $zapatilla->image) }}" class="card-img-top" alt="Imagen de {{ $zapatilla->nombre }}">
                @endif
                <div class="card-body">
                    <h1 class="card-title">{{ $zapatilla->nombre }}</h1>
                    <p class="card-text"><strong>Descripción: </strong>{{ $zapatilla->descripcion }}</p>
                    <p class="card-text"><strong>Precio:</strong> ${{ $zapatilla->precio }}</p>
                    <p class="card-text"><strong>Stock:</strong> {{ $zapatilla->stock }}</p>
                    <a href="{{ route('zapatillas.edit', $zapatilla->id) }}" class="btn btn-primary">
                        <i class="fas fa-edit"></i>
                    </a>
                    <form action="{{ route('zapatillas.destroy', $zapatilla->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
