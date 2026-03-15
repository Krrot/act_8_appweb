@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card mb-4">
            <div class="card-header bg-white fw-bold">
                <span><svg class="icon me-2"><use xlink:href="{{ asset('assets/icons/sprites/free.svg#cil-pencil') }}"></use></svg> Edit Order</span>
            </div>
            <div class="card-body">
                <form action="{{ route('pedidos.update', $pedido) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="numeroFactura" class="form-label">Invoice Number</label>
                            <input type="text" class="form-control @error('numeroFactura') is-invalid @enderror" id="numeroFactura" name="numeroFactura" value="{{ old('numeroFactura', $pedido->numeroFactura) }}" required>
                            @error('numeroFactura')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="clienteId" class="form-label">Customer</label>
                            <select class="form-select @error('clienteId') is-invalid @enderror" id="clienteId" name="clienteId" required>
                                <option value="">Select Customer</option>
                                @foreach($clientes as $cliente)
                                    <option value="{{ $cliente->id }}" {{ old('clienteId', $pedido->clienteId) == $cliente->id ? 'selected' : '' }}>
                                        {{ $cliente->numeroCliente }} - {{ $cliente->telefono }}
                                    </option>
                                @endforeach
                            </select>
                            @error('clienteId')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="fechaPedido" class="form-label">Order Date</label>
                            <input type="date" class="form-control @error('fechaPedido') is-invalid @enderror" id="fechaPedido" name="fechaPedido" value="{{ old('fechaPedido', $pedido->fechaPedido ? $pedido->fechaPedido->format('Y-m-d') : '') }}" required>
                            @error('fechaPedido')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="estadoId" class="form-label">Status</label>
                            <select class="form-select @error('estadoId') is-invalid @enderror" id="estadoId" name="estadoId" required>
                                <option value="1" {{ old('estadoId', $pedido->estadoId) == 1 ? 'selected' : '' }}>Ordered</option>
                                <option value="2" {{ old('estadoId', $pedido->estadoId) == 2 ? 'selected' : '' }}>In process</option>
                                <option value="3" {{ old('estadoId', $pedido->estadoId) == 3 ? 'selected' : '' }}>In route</option>
                                <option value="4" {{ old('estadoId', $pedido->estadoId) == 4 ? 'selected' : '' }}>Delivered</option>
                            </select>
                            @error('estadoId')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="usuarioId" class="form-label">Salesperson</label>
                            <select class="form-select @error('usuarioId') is-invalid @enderror" id="usuarioId" name="usuarioId" required>
                                <option value="">Select Salesperson</option>
                                @foreach($usuarios as $usuario)
                                    <option value="{{ $usuario->id }}" {{ old('usuarioId', $pedido->usuarioId) == $usuario->id ? 'selected' : '' }}>
                                        {{ $usuario->nombre }} {{ $usuario->nombreApellido }}
                                    </option>
                                @endforeach
                            </select>
                            @error('usuarioId')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="activo" class="form-label">Active</label>
                            <select class="form-select" id="activo" name="activo">
                                <option value="1" {{ old('activo', $pedido->activo) ? 'selected' : '' }}>Yes</option>
                                <option value="0" {{ !old('activo', $pedido->activo) ? 'selected' : '' }}>No</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="notas" class="form-label">Notes</label>
                        <textarea class="form-control @error('notas') is-invalid @enderror" id="notas" name="notas" rows="3">{{ old('notas', $pedido->notas) }}</textarea>
                        @error('notas')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-end">
                        <a href="{{ route('pedidos.index') }}" class="btn btn-secondary me-2">Cancel</a>
                        <button type="submit" class="btn btn-primary">Update Order</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection