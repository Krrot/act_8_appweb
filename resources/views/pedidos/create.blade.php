@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card mb-4">
            <div class="card-header bg-white fw-bold">
                <span><svg class="icon me-2"><use xlink:href="{{ asset('assets/icons/sprites/free.svg#cil-cart') }}"></use></svg> {{ __('create_new_order') }}</span>
            </div>
            <div class="card-body">
                <form action="{{ route('pedidos.store') }}" method="POST">
                    @csrf
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="numeroFactura" class="form-label">{{ __('invoice_number') }}</label>
                            <input type="text" class="form-control @error('numeroFactura') is-invalid @enderror" id="numeroFactura" name="numeroFactura" value="{{ old('numeroFactura') }}" required>
                            @error('numeroFactura')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="clienteId" class="form-label">{{ __('customer') }}</label>
                            <select class="form-select @error('clienteId') is-invalid @enderror" id="clienteId" name="clienteId" required>
                                <option value="">{{ __('select_customer') }}</option>
                                @foreach($clientes as $cliente)
                                    <option value="{{ $cliente->id }}" {{ old('clienteId') == $cliente->id ? 'selected' : '' }}>
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
                            <label for="fechaPedido" class="form-label">{{ __('order_date') }}</label>
                            <input type="date" class="form-control @error('fechaPedido') is-invalid @enderror" id="fechaPedido" name="fechaPedido" value="{{ old('fechaPedido', date('Y-m-d')) }}" required>
                            @error('fechaPedido')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="usuarioId" class="form-label">{{ __('salesperson') }}</label>
                            <select class="form-select @error('usuarioId') is-invalid @enderror" id="usuarioId" name="usuarioId" required>
                                <option value="">{{ __('select_salesperson') }}</option>
                                @foreach($salesUsuarios as $usuario)
                                    <option value="{{ $usuario->id }}" {{ old('usuarioId') == $usuario->id ? 'selected' : '' }}>
                                        {{ $usuario->nombre }} {{ $usuario->nombreApellido }}
                                    </option>
                                @endforeach
                            </select>
                            @error('usuarioId')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="routeUsuarioId" class="form-label">{{ __('route_user') }}</label>
                            <select class="form-select @error('routeUsuarioId') is-invalid @enderror" id="routeUsuarioId" name="routeUsuarioId">
                                <option value="">{{ __('select_route_user') }}</option>
                                @foreach($routeUsuarios as $usuario)
                                    <option value="{{ $usuario->id }}" {{ old('routeUsuarioId') == $usuario->id ? 'selected' : '' }}>
                                        {{ $usuario->nombre }} {{ $usuario->nombreApellido }}
                                    </option>
                                @endforeach
                            </select>
                            @error('routeUsuarioId')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="notas" class="form-label">{{ __('notes') }}</label>
                        <textarea class="form-control @error('notas') is-invalid @enderror" id="notas" name="notas" rows="3">{{ old('notas') }}</textarea>
                        @error('notas')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-end">
                        <a href="{{ route('pedidos.index') }}" class="btn btn-secondary me-2">{{ __('cancel') }}</a>
                        <button type="submit" class="btn btn-primary">{{ __('create_order') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection