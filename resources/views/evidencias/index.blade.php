@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header bg-white fw-bold d-flex justify-content-between align-items-center">
                <span>
                    <svg class="icon me-2"><use xlink:href="{{ asset('assets/icons/sprites/free.svg#cil-image') }}"></use></svg>
                    Evidence for Order #{{ $pedido->numeroFactura }}
                </span>
                <div>
                    <a href="{{ route('pedidos.index') }}" class="btn btn-sm btn-outline-secondary me-2">Back to Orders</a>
                    @if(auth()->user()->role->nombreRol == 'Route' || auth()->user()->role->nombreRol == 'Admin')
                        <a href="{{ route('pedidos.evidencias.create', $pedido) }}" class="btn btn-sm btn-primary">Add Evidence</a>
                    @endif
                </div>
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-coreui-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-hover table-striped">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Type</th>
                                <th>Description</th>
                                <th>Photo</th>
                                <th>Uploaded By</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($evidencias as $evidencia)
                                <tr>
                                    <td>{{ $evidencia->id }}</td>
                                    <td>
                                        <span class="badge 
                                            @if($evidencia->tipo == 'LOADED') bg-info
                                            @elseif($evidencia->tipo == 'DELIVERED') bg-success
                                            @elseif($evidencia->tipo == 'DAMAGE') bg-danger
                                            @elseif($evidencia->tipo == 'INSTALLATION') bg-warning
                                            @endif">
                                            {{ $evidencia->tipo }}
                                        </span>
                                    </td>
                                    <td>{{ $evidencia->descripcion ?? 'N/A' }}</td>
                                    <td>
                                        @if($evidencia->urlFoto)
                                            <img src="{{ asset('storage/' . $evidencia->urlFoto) }}" alt="Evidence" class="img-thumbnail" style="max-width: 100px;">
                                        @else
                                            No photo
                                        @endif
                                    </td>
                                    <td>{{ $evidencia->usuario->nombre ?? 'N/A' }}</td>
                                    <td>{{ $evidencia->fechaSubida ? $evidencia->fechaSubida->format('d/m/Y H:i') : 'N/A' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">No evidence found for this order.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection