@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card mb-4">
            <div class="card-header bg-white fw-bold">
                <span><svg class="icon me-2"><use xlink:href="{{ asset('assets/icons/sprites/free.svg#cil-pencil') }}"></use></svg> Edit User</span>
            </div>
            <div class="card-body">
                <form action="{{ route('users.update', $user) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label for="nombreUsuario" class="form-label">Username</label>
                        <input type="text" class="form-control @error('nombreUsuario') is-invalid @enderror" id="nombreUsuario" name="nombreUsuario" value="{{ old('nombreUsuario', $user->nombreUsuario) }}" required>
                        @error('nombreUsuario')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="nombre" class="form-label">First Name</label>
                        <input type="text" class="form-control @error('nombre') is-invalid @enderror" id="nombre" name="nombre" value="{{ old('nombre', $user->nombre) }}" required>
                        @error('nombre')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="nombreApellido" class="form-label">Last Name</label>
                        <input type="text" class="form-control @error('nombreApellido') is-invalid @enderror" id="nombreApellido" name="nombreApellido" value="{{ old('nombreApellido', $user->nombreApellido) }}">
                        @error('nombreApellido')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="rolId" class="form-label">Role</label>
                        <select class="form-select @error('rolId') is-invalid @enderror" id="rolId" name="rolId" required>
                            <option value="">Select Role</option>
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}" {{ old('rolId', $user->rolId) == $role->id ? 'selected' : '' }}>{{ $role->nombreRol }}</option>
                            @endforeach
                        </select>
                        @error('rolId')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="activo" class="form-label">Active</label>
                        <select class="form-select" id="activo" name="activo">
                            <option value="1" {{ old('activo', $user->activo) ? 'selected' : '' }}>Yes</option>
                            <option value="0" {{ !old('activo', $user->activo) ? 'selected' : '' }}>No</option>
                        </select>
                    </div>
                    
                    <hr class="my-4">
                    <h6 class="mb-3">Change password (optional)</h6>
                    
                    <div class="mb-3">
                        <label for="contrasena" class="form-label">New Password</label>
                        <input type="password" class="form-control @error('contrasena') is-invalid @enderror" id="contrasena" name="contrasena" placeholder="Leave blank to keep current">
                        @error('contrasena')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-end">
                        <a href="{{ route('users.index') }}" class="btn btn-secondary me-2">Cancel</a>
                        <button type="submit" class="btn btn-primary">Update User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
