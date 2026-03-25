@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Materiales</h1>
    <a href="{{ route('materiales.create') }}" class="btn btn-primary mb-3">Agregar Material</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Clave</th>
                <th>Descripción</th>
                <th>Stock</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($materiales as $material)
                <tr>
                    <td>{{ $material->id }}</td>
                    <td>{{ $material->claveMaterial ?? $material->nombre }}</td>
                    <td>{{ $material->descripcionMaterial ?? $material->descripcion }}</td>
                    <td>{{ $material->stock ?? 'N/A' }}</td>
                    <td>
                        <a href="{{ route('materiales.edit', $material->id) }}" class="btn btn-sm btn-warning">Editar</a>
                        <form action="{{ route('materiales.destroy', $material->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Confirmar eliminación?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection