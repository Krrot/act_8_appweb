@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header bg-white fw-bold d-flex justify-content-between align-items-center">
                <span><svg class="icon me-2"><use xlink:href="{{ asset('assets/icons/sprites/free.svg#cil-cart') }}"></use></svg> {{ __('order_management') }}</span>
                @if(in_array(auth()->user()->role->nombreRol, ['Admin', 'Sales']))
                    <a href="{{ route('pedidos.create') }}" class="btn btn-sm btn-primary">{{ __('new_order') }}</a>
                @endif
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-coreui-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <!-- Search Form -->
                <form method="GET" class="mb-4">
                    <div class="row g-3">
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="numeroFactura" placeholder="{{ __('invoice_number') }}" value="{{ request('numeroFactura') }}">
                        </div>
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="numeroCliente" placeholder="{{ __('customer_number') }}" value="{{ request('numeroCliente') }}">
                        </div>
                        <div class="col-md-2">
                            <input type="date" class="form-control" name="fecha" value="{{ request('fecha') }}">
                        </div>
                        <div class="col-md-2">
                            <select class="form-select" name="estadoId">
                                <option value="">{{ __('all_statuses') }}</option>
                                <option value="1" {{ request('estadoId') == '1' ? 'selected' : '' }}>{{ __('ordered') }}</option>
                                <option value="2" {{ request('estadoId') == '2' ? 'selected' : '' }}>{{ __('in_process') }}</option>
                                <option value="3" {{ request('estadoId') == '3' ? 'selected' : '' }}>{{ __('in_route') }}</option>
                                <option value="4" {{ request('estadoId') == '4' ? 'selected' : '' }}>{{ __('delivered') }}</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-outline-primary w-100">{{ __('search') }}</button>
                        </div>
                    </div>
                </form>

                <div class="table-responsive">
                    <table class="table table-hover table-striped">
                        <thead class="table-light">
                            <tr>
                                <th>{{ __('id') }}</th>
                                <th>{{ __('invoice') }}</th>
                                <th>{{ __('customer') }}</th>
                                <th>{{ __('sales') }}</th>
                                <th>{{ __('route') }}</th>
                                <th>{{ __('date') }}</th>
                                <th>{{ __('status') }}</th>
                                <th>{{ __('evidence') }}</th>
                                <th>{{ __('actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($pedidos as $pedido)
                                <tr>
                                    <td>{{ $pedido->id }}</td>
                                    <td>{{ $pedido->numeroFactura }}</td>
                                    <td>{{ $pedido->cliente->numeroCliente }} - {{ $pedido->cliente->telefono }}</td>
                                    <td>{{ $pedido->usuario ? $pedido->usuario->nombre : 'N/A' }}</td>
                                    <td>{{ $pedido->routeUsuario ? $pedido->routeUsuario->nombre : 'N/A' }}</td>
                                    <td>{{ $pedido->fechaPedido ? $pedido->fechaPedido->format('d/m/Y') : 'N/A' }}</td>
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
                                    <td>
                                        <div class="d-flex gap-1">
                                            <a href="{{ route('pedidos.evidencias.index', $pedido) }}" class="btn btn-sm btn-secondary text-white">
                                                <svg class="icon me-1"><use xlink:href="{{ asset('assets/icons/sprites/free.svg#cil-image') }}"></use></svg> {{ __('view') }}
                                            </a>
                                            @if(auth()->user()->role->nombreRol == 'Route' || auth()->user()->role->nombreRol == 'Admin')
                                                <a href="{{ route('pedidos.evidencias.create', $pedido) }}" class="btn btn-sm btn-success text-white">
                                                    <svg class="icon me-1"><use xlink:href="{{ asset('assets/icons/sprites/free.svg#cil-plus') }}"></use></svg> {{ __('add') }}
                                                </a>
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('pedidos.show', $pedido) }}" class="btn btn-sm btn-info text-white">
                                                <svg class="icon me-1"><use xlink:href="{{ asset('assets/icons/sprites/free.svg#cil-eye') }}"></use></svg> {{ __('view') }}
                                            </a>
                                            <a href="{{ route('pedidos.edit', $pedido) }}" class="btn btn-sm btn-warning text-white">
                                                <svg class="icon me-1"><use xlink:href="{{ asset('assets/icons/sprites/free.svg#cil-pencil') }}"></use></svg> {{ __('edit') }}
                                            </a>
                                            <form action="{{ route('pedidos.destroy', $pedido) }}" method="POST" class="d-inline" onsubmit="return confirm('{{ __('confirm_deactivate') }}');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger text-white">
                                                    <svg class="icon me-1"><use xlink:href="{{ asset('assets/icons/sprites/free.svg#cil-trash') }}"></use></svg> {{ __('deactivate') }}
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center">{{ __('no_orders') }}</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                <div class="d-flex justify-content-center mt-3">
                    {{ $pedidos->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection