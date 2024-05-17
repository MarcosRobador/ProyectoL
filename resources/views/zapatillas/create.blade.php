@extends('layouts.plantilla')

@section('content')
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <h1 class="mb-4">Agregar Zapatilla</h1>
            <form action="{{ route('zapatillas.store') }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                @csrf
                <div class="form-group">
                    <label for="nombre">Nombre:</label>
                    <input type="text" id="nombre" name="nombre" class="form-control" required minlength="3" maxlength="255">
                    <div class="invalid-feedback">
                        El nombre es obligatorio y debe tener entre 3 y 255 caracteres.
                    </div>
                </div>
                <div class="form-group">
                    <label for="descripcion">Descripción:</label>
                    <textarea id="descripcion" name="descripcion" class="form-control" required minlength="10"></textarea>
                    <div class="invalid-feedback">
                        La descripción es obligatoria y debe tener al menos 10 caracteres.
                    </div>
                </div>
                <div class="form-group">
                    <label for="precio">Precio:</label>
                    <input type="number" id="precio" name="precio" class="form-control" required min="0" step="0.01">
                    <div class="invalid-feedback">
                        El precio es obligatorio y debe ser un valor numérico.
                    </div>
                </div>
                <div class="form-group">
                    <label for="stock">Stock:</label>
                    <input type="number" id="stock" name="stock" class="form-control" required min="0" step="1">
                    <div class="invalid-feedback">
                        El stock es obligatorio y debe ser un valor entero.
                    </div>
                </div>
                <div class="form-group">
                    <label for="image">Imagen:</label>
                    <input type="file" id="image" name="image" class="form-control-file" required accept="image/*">
                    <div class="invalid-feedback">
                        La imagen es obligatoria y debe ser un archivo válido.
                    </div>
                </div>
                <button type="submit" class="btn btn-success">Guardar</button>
            </form>
        </div>
    </div>
@endsection
