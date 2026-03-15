@extends('layouts.auth')

@section('content')
<div class="card p-4">
    <div class="card-body">
        <h1>{{ __('Register') }}</h1>
        <p class="text-body-secondary">Create your account</p>
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="input-group mb-3">
                <span class="input-group-text">
                    <svg class="icon">
                        <use xlink:href="{{ asset('assets/icons/sprites/free.svg#cil-user') }}"></use>
                    </svg>
                </span>
                <input id="nombreUsuario" type="text" class="form-control @error('nombreUsuario') is-invalid @enderror" name="nombreUsuario" value="{{ old('nombreUsuario') }}" required autocomplete="username" autofocus placeholder="Username">

                @error('nombreUsuario')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="input-group mb-3">
                <span class="input-group-text">
                    <svg class="icon">
                        <use xlink:href="{{ asset('assets/icons/sprites/free.svg#cil-user') }}"></use>
                    </svg>
                </span>
                <input id="nombre" type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" value="{{ old('nombre') }}" required autocomplete="given-name" placeholder="First Name">

                @error('nombre')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="input-group mb-3">
                <span class="input-group-text">
                    <svg class="icon">
                        <use xlink:href="{{ asset('assets/icons/sprites/free.svg#cil-user') }}"></use>
                    </svg>
                </span>
                <input id="nombreApellido" type="text" class="form-control @error('nombreApellido') is-invalid @enderror" name="nombreApellido" value="{{ old('nombreApellido') }}" autocomplete="family-name" placeholder="Last Name">

                @error('nombreApellido')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="input-group mb-3">
                <span class="input-group-text">
                    <svg class="icon">
                        <use xlink:href="{{ asset('assets/icons/sprites/free.svg#cil-lock-locked') }}"></use>
                    </svg>
                </span>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="{{ __('Password') }}">

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="input-group mb-4">
                <span class="input-group-text">
                    <svg class="icon">
                        <use xlink:href="{{ asset('assets/icons/sprites/free.svg#cil-lock-locked') }}"></use>
                    </svg>
                </span>
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="{{ __('Confirm Password') }}">
            </div>

            <button class="btn btn-block btn-success w-100" type="submit">{{ __('Register') }}</button>

            <div class="row mt-4">
                <div class="col-12 text-center">
                    <p class="mb-0">Already have an account? <a href="{{ route('login') }}">Login</a></p>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
