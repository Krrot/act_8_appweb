@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Evidencias Fotográficas</h1>
    <a href="{{ route('evidencias.create') }}" class="btn btn-primary mb-3">Agregar Evidencia</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Pedido</th>
                <th>Descripción</th>
                <th>Ruta</th>
                <th>Fecha</th>
            </tr>
        </thead>
        <tbody>
            @foreach($evidencias as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->pedido ? $item->pedido->folioPedido : '-' }}</td>
                <td>{{ $item->descripcion ?? 'N/A' }}</td>
                <td>{{ $item->rutaImagen ?? $item->urlFoto }}</td>
                <td>{{ $item->fechaSubida ?? $item->created_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection