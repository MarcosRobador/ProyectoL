@extends('layouts.plantilla')

@section('content')
    <h1>Agregar Zapatilla</h1>
    <form action="{{ route('zapatillas.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div>
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required minlength="3" maxlength="255">
        </div>
        <div>
            <label for="descripcion">Descripción:</label>
            <textarea id="descripcion" name="descripcion" required minlength="10"></textarea>
        </div>
        <div>
            <label for="precio">Precio:</label>
            <input type="number" id="precio" name="precio" required min="0" step="0.01">
        </div>
        <div>
            <label for="stock">Stock:</label>
            <input type="number" id="stock" name="stock" required min="0" step="1">
        </div>
        <div>
            <label for="image">Imagen:</label>
            <input type="file" id="image" name="image" required accept="image/*">
        </div>
        <button type="submit">Guardar</button>
    </form>
@endsection
