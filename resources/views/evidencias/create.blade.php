@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Agregar Evidencia</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('evidencias.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="pedidoId">Pedido ID</label>
            <input type="number" name="pedidoId" id="pedidoId" class="form-control" value="{{ old('pedidoId') }}" required>
        </div>

        <div class="form-group">
            <label for="descripcion">Descripción</label>
            <textarea name="descripcion" id="descripcion" class="form-control">{{ old('descripcion') }}</textarea>
        </div>

        <div class="form-group">
            <label for="rutaImagen">URL ruta/imágen</label>
            <input type="text" name="rutaImagen" id="rutaImagen" class="form-control" value="{{ old('rutaImagen') }}">
        </div>

        <button type="submit" class="btn btn-primary mt-2">Guardar</button>
    </form>
</div>
@endsection