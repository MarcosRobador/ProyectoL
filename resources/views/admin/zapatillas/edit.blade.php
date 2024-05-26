@extends('layouts.plantilla')

@section('content')
<a class="nav-link" href="{{ route('zapatillas.show', $zapatilla->id) }}">
    <i class="fas fa-arrow-left fa-2x"></i>
</a>
    <div class="container mt-4">
        <h1 class="mb-4">Editar Zapatilla</h1>
        <form action="{{ route('zapatillas.update', $zapatilla->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre:</label>
                <input type="text" id="nombre" name="nombre" class="form-control" value="{{ $zapatilla->nombre }}" required minlength="3" maxlength="255">
            </div>
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción:</label>
                <textarea id="descripcion" name="descripcion" class="form-control" required minlength="10">{{ $zapatilla->descripcion }}</textarea>
            </div>
            <div class="mb-3">
                <label for="precio" class="form-label">Precio:</label>
                <input type="number" id="precio" name="precio" class="form-control" value="{{ $zapatilla->precio }}" required min="0" step="0.01">
            </div>
            <div class="mb-3">
                <label for="stock" class="form-label">Stock:</label>
                <input type="number" id="stock" name="stock" class="form-control" value="{{ $zapatilla->stock }}" required min="0" step="1">
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Imagen:</label>
                <input type="file" id="image" name="image" class="form-control" required accept="image/*">
                @if ($zapatilla->image)
                    <div class="mt-2">
                        <img src="{{ asset('storage/' . $zapatilla->image) }}" alt="Imagen de {{ $zapatilla->nombre }}" class="img-thumbnail" width="100">
                    </div>
                @endif
            </div>
            <button type="submit" class="btn btn-primary">Actualizar</button>
        </form>
    </div>
@endsection
