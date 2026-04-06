@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card mb-4">
            <div class="card-header bg-white fw-bold d-flex justify-content-between align-items-center">
                <span><svg class="icon me-2"><use xlink:href="{{ asset('assets/icons/sprites/free.svg#cil-user') }}"></use></svg> Client Details</span>
                <div class="d-flex gap-2">
                    <a href="{{ route('clientes.edit', $cliente) }}" class="btn btn-sm btn-warning text-white">Edit</a>
                    <a href="{{ route('clientes.index') }}" class="btn btn-sm btn-secondary">Back</a>
                </div>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-bold">ID</label>
                        <div>{{ $cliente->id }}</div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Customer Number</label>
                        <div>{{ $cliente->numeroCliente }}</div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Phone</label>
                        <div>{{ $cliente->telefono ?: 'N/A' }}</div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Email</label>
                        <div>{{ $cliente->correoElectronico ?: 'N/A' }}</div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Status</label>
                        <div>
                            @if($cliente->activo)
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-danger">Inactive</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Registration Date</label>
                        <div>{{ $cliente->registroFecha ?: 'N/A' }}</div>
                    </div>
                    <div class="col-12">
                        <label class="form-label fw-bold">Address</label>
                        <div class="border rounded p-3 bg-light">
                            @if($cliente->direccion)
                                {{ $cliente->direccion->calle ?: 'No street' }}
                                {{ $cliente->direccion->numeroExterior ?: '' }}
                                {{ $cliente->direccion->numeroInterior ? 'Int. ' . $cliente->direccion->numeroInterior : '' }}
                                <br>
                                {{ $cliente->direccion->colonia ?: 'No neighborhood' }},
                                {{ $cliente->direccion->ciudad ?: 'No city' }},
                                {{ $cliente->direccion->municipio ?: 'No municipality' }}
                                <br>
                                {{ $cliente->direccion->estado ?: 'No state' }},
                                {{ $cliente->direccion->pais ?: 'No country' }}
                                {{ $cliente->direccion->codigoPostal ? ' - CP ' . $cliente->direccion->codigoPostal : '' }}
                            @else
                                <span class="text-muted">No address assigned.</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
