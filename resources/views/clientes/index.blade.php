@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header bg-white fw-bold d-flex justify-content-between align-items-center">
                <span><svg class="icon me-2"><use xlink:href="{{ asset('assets/icons/sprites/free.svg#cil-people') }}"></use></svg> Client Management</span>
                <a href="{{ route('clientes.create') }}" class="btn btn-sm btn-primary">New Client</a>
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-coreui-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-coreui-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-hover table-striped">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Customer Number</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Active</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($clientes as $cliente)
                                <tr>
                                    <td>{{ $cliente->id }}</td>
                                    <td>{{ $cliente->numeroCliente }}</td>
                                    <td>{{ $cliente->telefono }}</td>
                                    <td>{{ $cliente->correoElectronico }}</td>
                                    <td>
                                        @if($cliente->activo)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-danger">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('clientes.show', $cliente) }}" class="btn btn-sm btn-info text-white">
                                                <svg class="icon me-1"><use xlink:href="{{ asset('assets/icons/sprites/free.svg#cil-eye') }}"></use></svg> View
                                            </a>
                                            <a href="{{ route('clientes.edit', $cliente) }}" class="btn btn-sm btn-warning text-white">
                                                <svg class="icon me-1"><use xlink:href="{{ asset('assets/icons/sprites/free.svg#cil-pencil') }}"></use></svg> Edit
                                            </a>
                                            <form action="{{ route('clientes.destroy', $cliente) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to deactivate this client?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger text-white">
                                                    <svg class="icon me-1"><use xlink:href="{{ asset('assets/icons/sprites/free.svg#cil-trash') }}"></use></svg> Deactivate
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">No clients registered.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                <div class="d-flex justify-content-center mt-3">
                    {{ $clientes->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection