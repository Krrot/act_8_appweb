@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header bg-white fw-bold">
                <span><svg class="icon me-2"><use xlink:href="{{ asset('assets/icons/sprites/free.svg#cil-trash') }}"></use></svg> Deleted Orders</span>
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-coreui-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-hover table-striped">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Invoice</th>
                                <th>Customer</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($pedidos as $pedido)
                                <tr>
                                    <td>{{ $pedido->id }}</td>
                                    <td>{{ $pedido->numeroFactura }}</td>
                                    <td>{{ $pedido->cliente->numeroCliente }} - {{ $pedido->cliente->telefono }}</td>
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
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('pedidos.show', $pedido) }}" class="btn btn-sm btn-info text-white">
                                                <svg class="icon me-1"><use xlink:href="{{ asset('assets/icons/sprites/free.svg#cil-eye') }}"></use></svg> View
                                            </a>
                                            <a href="{{ route('pedidos.edit', $pedido) }}" class="btn btn-sm btn-warning text-white">
                                                <svg class="icon me-1"><use xlink:href="{{ asset('assets/icons/sprites/free.svg#cil-pencil') }}"></use></svg> Edit
                                            </a>
                                            <form action="{{ route('pedidos.restore', $pedido) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to restore this order?');">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-sm btn-success text-white">
                                                    <svg class="icon me-1"><use xlink:href="{{ asset('assets/icons/sprites/free.svg#cil-reload') }}"></use></svg> Restore
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">No deleted orders found.</td>
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