@extends('layouts.plantilla')

@section('content')
    <h1>{{ $zapatilla->nombre }}</h1>
    <p>{{ $zapatilla->descripcion }}</p>
    <p>Precio: {{ $zapatilla->precio }}</p>
    <p>Stock: {{ $zapatilla->stock }}</p>
    @if ($zapatilla->image)
        <img src="{{ asset('storage/' . $zapatilla->image) }}" alt="Imagen de {{ $zapatilla->nombre }}" width="200">
    @endif
    <a href="{{ route('zapatillas.edit', $zapatilla->id) }}">Editar</a>
    <form action="{{ route('zapatillas.destroy', $zapatilla->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit">Eliminar</button>
    </form>
@endsection
