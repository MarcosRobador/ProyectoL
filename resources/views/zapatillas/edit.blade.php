@extends('layouts.app')

@section('content')
    <h1>Editar Zapatilla</h1>
    <form action="{{ route('zapatillas.update', $zapatilla->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" value="{{ $zapatilla->nombre }}">
        </div>
        <div>
            <label for="descripcion">Descripción:</label>
            <textarea id="descripcion" name="descripcion">{{ $zapatilla->descripcion }}</textarea>
        </div>
        <div>
            <label for="precio">Precio:</label>
            <input type="text" id="precio" name="precio" value="{{ $zapatilla->precio }}">
        </div>
        <div>
            <label for="stock">Stock:</label>
            <input type="text" id="stock" name="stock" value="{{ $zapatilla->stock }}">
        </div>
        <button type="submit">Actualizar</button>
    </form>
@endsection
