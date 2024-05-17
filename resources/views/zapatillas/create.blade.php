@extends('layouts.app')

@section('content')
    <h1>Agregar Zapatilla</h1>
    <form action="{{ route('zapatillas.store') }}" method="POST">
        @csrf
        <div>
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre">
        </div>
        <div>
            <label for="descripcion">Descripción:</label>
            <textarea id="descripcion" name="descripcion"></textarea>
        </div>
        <div>
            <label for="precio">Precio:</label>
            <input type="text" id="precio" name="precio">
        </div>
        <div>
            <label for="stock">Stock:</label>
            <input type="text" id="stock" name="stock">
        </div>
        <button type="submit">Guardar</button>
    </form>
@endsection
