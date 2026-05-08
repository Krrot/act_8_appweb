@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header bg-white fw-bold">
                <svg class="icon me-2"><use xlink:href="{{ asset('assets/icons/sprites/free.svg#cil-plus') }}"></use></svg>
                {{ __('add_evidence_for_order') }} #{{ $pedido->numeroFactura }}
            </div>
            <div class="card-body">
                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-coreui-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <form action="{{ route('pedidos.evidencias.store', $pedido) }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="tipo" class="form-label">{{ __('evidence_type') }}</label>
                            <select name="tipo" id="tipo" class="form-select" required>
                                <option value="">{{ __('select_type') }}</option>
                                <option value="LOADED" {{ old('tipo') == 'LOADED' ? 'selected' : '' }}>{{ __('loaded_unit') }}</option>
                                <option value="DELIVERED" {{ old('tipo') == 'DELIVERED' ? 'selected' : '' }}>{{ __('delivery_evidence') }}</option>
                                <option value="DAMAGE" {{ old('tipo') == 'DAMAGE' ? 'selected' : '' }}>{{ __('damage') }}</option>
                                <option value="INSTALLATION" {{ old('tipo') == 'INSTALLATION' ? 'selected' : '' }}>{{ __('installation') }}</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="urlFoto" class="form-label">{{ __('photo_url') }}</label>
                            <input type="text" name="urlFoto" id="urlFoto" class="form-control" value="{{ old('urlFoto') }}" placeholder="{{ __('enter_photo_url') }}">
                        </div>

                        <div class="col-12">
                            <label for="descripcion" class="form-label">{{ __('description') }}</label>
                            <textarea name="descripcion" id="descripcion" class="form-control" rows="3" placeholder="{{ __('optional_description') }}">{{ old('descripcion') }}</textarea>
                        </div>
                    </div>

                    <div class="d-flex gap-2 mt-4">
                        <button type="submit" class="btn btn-primary">
                            <svg class="icon me-2"><use xlink:href="{{ asset('assets/icons/sprites/free.svg#cil-save') }}"></use></svg>
                            {{ __('save_evidence') }}
                        </button>
                        <a href="{{ route('pedidos.evidencias.index', $pedido) }}" class="btn btn-outline-secondary">{{ __('cancel') }}</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection