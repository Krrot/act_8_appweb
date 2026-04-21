@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header bg-white fw-bold">
                <svg class="icon me-2"><use xlink:href="{{ asset('assets/icons/sprites/free.svg#cil-plus') }}"></use></svg>
                Add Evidence for Order #{{ $pedido->numeroFactura }}
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
                            <label for="tipo" class="form-label">Evidence Type</label>
                            <select name="tipo" id="tipo" class="form-select" required>
                                <option value="">Select type</option>
                                <option value="LOADED" {{ old('tipo') == 'LOADED' ? 'selected' : '' }}>Loaded Unit</option>
                                <option value="DELIVERED" {{ old('tipo') == 'DELIVERED' ? 'selected' : '' }}>Delivery Evidence</option>
                                <option value="DAMAGE" {{ old('tipo') == 'DAMAGE' ? 'selected' : '' }}>Damage</option>
                                <option value="INSTALLATION" {{ old('tipo') == 'INSTALLATION' ? 'selected' : '' }}>Installation</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="urlFoto" class="form-label">Photo URL</label>
                            <input type="text" name="urlFoto" id="urlFoto" class="form-control" value="{{ old('urlFoto') }}" placeholder="Enter photo URL">
                        </div>

                        <div class="col-12">
                            <label for="descripcion" class="form-label">Description</label>
                            <textarea name="descripcion" id="descripcion" class="form-control" rows="3" placeholder="Optional description">{{ old('descripcion') }}</textarea>
                        </div>
                    </div>

                    <div class="d-flex gap-2 mt-4">
                        <button type="submit" class="btn btn-primary">
                            <svg class="icon me-2"><use xlink:href="{{ asset('assets/icons/sprites/free.svg#cil-save') }}"></use></svg>
                            Save Evidence
                        </button>
                        <a href="{{ route('pedidos.evidencias.index', $pedido) }}" class="btn btn-outline-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection