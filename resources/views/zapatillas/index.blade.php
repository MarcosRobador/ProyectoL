@extends('layouts.app')

@section('content')
    <h1>Zapatillas</h1>
    <a href="{{ route('zapatillas.create') }}">Agregar Zapatilla</a>
    <ul>
        @foreach ($zapatillas as $zapatilla)
            <li>
                <a href="{{ route('zapatillas.show', $zapatilla->id) }}">{{ $zapatilla->nombre }}</a>
            </li>
        @endforeach
    </ul>
@endsection
