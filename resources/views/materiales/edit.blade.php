@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Material</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('materiales.update', $material->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre', $material->nombre ?? $material->claveMaterial) }}" required>
        </div>

        <div class="form-group">
            <label for="descripcion">Descripción</label>
            <textarea name="descripcion" id="descripcion" class="form-control">{{ old('descripcion', $material->descripcion ?? $material->descripcionMaterial) }}</textarea>
        </div>

        <div class="form-group">
            <label for="stock">Stock</label>
            <input type="number" name="stock" id="stock" class="form-control" value="{{ old('stock', $material->stock ?? 0) }}" required>
        </div>

        <button type="submit" class="btn btn-primary mt-2">Actualizar</button>
    </form>
</div>
@endsection