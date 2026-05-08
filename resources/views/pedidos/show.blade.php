@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header bg-white fw-bold d-flex justify-content-between align-items-center">
                <span><svg class="icon me-2"><use xlink:href="{{ asset('assets/icons/sprites/free.svg#cil-cart') }}"></use></svg> {{ __('order_details') }}</span>
                <a href="{{ route('pedidos.edit', $pedido) }}" class="btn btn-sm btn-warning text-white">{{ __('edit') }}</a>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h5>{{ __('order_information') }}</h5>
                        <table class="table table-borderless">
                            <tr>
                                <th>{{ __('order_id') }}:</th>
                                <td>{{ $pedido->id }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('invoice_number') }}:</th>
                                <td>{{ $pedido->numeroFactura }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('order_date') }}:</th>
                                <td>{{ $pedido->fechaPedido ? $pedido->fechaPedido->format('d/m/Y') : 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('status') }}:</th>
                                <td>
                                    <span class="badge 
                                        @if($pedido->estadoId == 1) bg-warning
                                        @elseif($pedido->estadoId == 2) bg-info
                                        @elseif($pedido->estadoId == 3) bg-primary
                                        @elseif($pedido->estadoId == 4) bg-success
                                        @endif">
                                        {{ $pedido->status }}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <th>{{ __('salesperson') }}:</th>
                                <td>{{ $pedido->usuario->nombre }} {{ $pedido->usuario->nombreApellido }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('route_user') }}:</th>
                                <td>{{ $pedido->routeUsuario ? $pedido->routeUsuario->nombre . ' ' . $pedido->routeUsuario->nombreApellido : __('not_assigned') }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('active') }}:</th>
                                <td>{{ $pedido->activo ? __('yes') : __('no') }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <h5>{{ __('customer_information') }}</h5>
                        <table class="table table-borderless">
                            <tr>
                                <th>{{ __('customer_number') }}:</th>
                                <td>{{ $pedido->cliente->numeroCliente }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('phone') }}:</th>
                                <td>{{ $pedido->cliente->telefono }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('email') }}:</th>
                                <td>{{ $pedido->cliente->correoElectronico }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('address') }}:</th>
                                <td>
                                    @if($pedido->cliente->direccion)
                                        {{ $pedido->cliente->direccion->calle }} {{ $pedido->cliente->direccion->numeroExterior }}
                                        {{ $pedido->cliente->direccion->colonia }}, {{ $pedido->cliente->direccion->ciudad }}
                                    @else
                                        N/A
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-12">
                        <h5>{{ __('notes') }}</h5>
                        <p>{{ $pedido->notas ?: __('no_notes') }}</p>
                    </div>
                </div>
                
                @if($pedido->evidencias->count() > 0)
                <div class="row">
                    <div class="col-12">
                        <h5>{{ __('evidence_photos') }}</h5>
                        <div class="row">
                            @foreach($pedido->evidencias as $evidencia)
                                <div class="col-md-4 mb-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <h6>{{ ucfirst(strtolower($evidencia->tipo)) }}</h6>
                                            <p>{{ __('uploaded_by') }}: {{ $evidencia->usuario->nombre }}</p>
                                            <p>{{ __('date') }}: {{ $evidencia->fechaSubida ? $evidencia->fechaSubida->format('d/m/Y H:i') : 'N/A' }}</p>
                                            @if($evidencia->urlFoto)
                                                <img src="{{ asset('storage/' . $evidencia->urlFoto) }}" class="img-fluid" alt="Evidence">
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection