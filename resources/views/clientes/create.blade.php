@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card mb-4">
            <div class="card-header bg-white fw-bold">
                <span><svg class="icon me-2"><use xlink:href="{{ asset('assets/icons/sprites/free.svg#cil-user-plus') }}"></use></svg> Create New Client</span>
            </div>
            <div class="card-body">
                <form action="{{ route('clientes.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="numeroCliente" class="form-label">Customer Number</label>
                        <input type="text" class="form-control @error('numeroCliente') is-invalid @enderror" id="numeroCliente" name="numeroCliente" value="{{ old('numeroCliente') }}" required>
                        @error('numeroCliente')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="telefono" class="form-label">Phone</label>
                        <input type="text" class="form-control @error('telefono') is-invalid @enderror" id="telefono" name="telefono" value="{{ old('telefono') }}">
                        @error('telefono')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="correoElectronico" class="form-label">Email</label>
                        <input type="email" class="form-control @error('correoElectronico') is-invalid @enderror" id="correoElectronico" name="correoElectronico" value="{{ old('correoElectronico') }}">
                        @error('correoElectronico')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="direccionesId" class="form-label">Address</label>
                        <select class="form-select @error('direccionesId') is-invalid @enderror" id="direccionesId" name="direccionesId">
                            <option value="">Select Address</option>
                            @foreach($direcciones as $direccion)
                                <option value="{{ $direccion->id }}" {{ old('direccionesId') == $direccion->id ? 'selected' : '' }}>
                                    {{ $direccion->calle }} {{ $direccion->numeroExterior }}, {{ $direccion->colonia }}, {{ $direccion->ciudad }}
                                </option>
                            @endforeach
                        </select>
                        @error('direccionesId')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-end">
                        <a href="{{ route('clientes.index') }}" class="btn btn-secondary me-2">Cancel</a>
                        <button type="submit" class="btn btn-primary">Create Client</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection