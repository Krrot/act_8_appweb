@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card mb-4">
            <div class="card-header bg-white fw-bold">
                <span><svg class="icon me-2"><use xlink:href="{{ asset('assets/icons/sprites/free.svg#cil-user-plus') }}"></use></svg> Create New User</span>
            </div>
            <div class="card-body">
                <form action="{{ route('users.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="nombreUsuario" class="form-label">Username</label>
                        <input type="text" class="form-control @error('nombreUsuario') is-invalid @enderror" id="nombreUsuario" name="nombreUsuario" value="{{ old('nombreUsuario') }}" required>
                        @error('nombreUsuario')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="nombre" class="form-label">First Name</label>
                        <input type="text" class="form-control @error('nombre') is-invalid @enderror" id="nombre" name="nombre" value="{{ old('nombre') }}" required>
                        @error('nombre')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="nombreApellido" class="form-label">Last Name</label>
                        <input type="text" class="form-control @error('nombreApellido') is-invalid @enderror" id="nombreApellido" name="nombreApellido" value="{{ old('nombreApellido') }}">
                        @error('nombreApellido')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="rolId" class="form-label">Role</label>
                        <select class="form-select @error('rolId') is-invalid @enderror" id="rolId" name="rolId" required>
                            <option value="">Select Role</option>
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}" {{ old('rolId') == $role->id ? 'selected' : '' }}>{{ $role->nombreRol }}</option>
                            @endforeach
                        </select>
                        @error('rolId')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="contrasena" class="form-label">Password</label>
                        <input type="password" class="form-control @error('contrasena') is-invalid @enderror" id="contrasena" name="contrasena" required>
                        @error('contrasena')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-end">
                        <a href="{{ route('users.index') }}" class="btn btn-secondary me-2">Cancel</a>
                        <button type="submit" class="btn btn-primary">Save User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
