@extends('layouts.plantilla')

@section('content')
    <h1>Editar Zapatilla</h1>
    <form action="{{ route('zapatillas.update', $zapatilla->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div>
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" value="{{ $zapatilla->nombre }}" required minlength="3" maxlength="255">
        </div>
        <div>
            <label for="descripcion">Descripción:</label>
            <textarea id="descripcion" name="descripcion" required minlength="10">{{ $zapatilla->descripcion }}</textarea>
        </div>
        <div>
            <label for="precio">Precio:</label>
            <input type="number" id="precio" name="precio" value="{{ $zapatilla->precio }}" required min="0" step="0.01">
        </div>
        <div>
            <label for="stock">Stock:</label>
            <input type="number" id="stock" name="stock" value="{{ $zapatilla->stock }}" required min="0" step="1">
        </div>
        <div>
            <label for="image">Imagen:</label>
            <input type="file" id="image" name="image" required accept="image/*">
            @if ($zapatilla->image)
                <img src="{{ asset('storage/' . $zapatilla->image) }}" alt="Imagen de {{ $zapatilla->nombre }}" width="100">
            @endif
        </div>
        <button type="submit">Actualizar</button>
    </form>
@endsection
