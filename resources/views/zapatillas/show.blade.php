@extends('layouts.app')

@section('content')
    <h1>{{ $zapatilla->nombre }}</h1>
    <p>{{ $zapatilla->descripcion }}</p>
    <p>Precio: {{ $zapatilla->precio }}</p>
    <p>Stock: {{ $zapatilla->stock }}</p>
    <a href="{{ route('zapatillas.edit', $zapatilla->id) }}">Editar</a>
    <form action="{{ route('zapatillas.destroy', $zapatilla->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit">Eliminar</button>
    </form>
@endsection
