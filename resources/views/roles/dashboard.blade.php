@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Role Dashboard</h1>
    <p>Bienvenido, <strong>{{ auth()->user()->nombreCompleto }}</strong>. Tu rol: <strong>{{ $role }}</strong>.</p>

    <ul>
        @if(in_array($role, ['Admin']))
            <li><a href="{{ route('users.index') }}">Gestión de Usuarios</a></li>
            <li><a href="{{ route('clientes.index') }}">Gestión de Clientes</a></li>
            <li><a href="{{ route('pedidos.index') }}">Gestión de Pedidos</a></li>
            <li><a href="{{ route('materiales.index') }}">Gestión de Materiales</a></li>
        @endif

        @if(in_array($role, ['Sales']))
            <li><a href="{{ route('clientes.index') }}">Ver y editar clientes</a></li>
            <li><a href="{{ route('pedidos.index') }}">Ver y editar pedidos de ventas</a></li>
        @endif

        @if(in_array($role, ['Warehouse']))
            <li><a href="{{ route('materiales.index') }}">Ver y gestionar materiales</a></li>
            <li><a href="{{ route('pedidos.index') }}">Ver y actualizar estado de pedidos</a></li>
        @endif

        @if(in_array($role, ['Purchasing']))
            <li><a href="{{ route('materiales.index') }}">Gestionar inventario y compras</a></li>
        @endif

        @if(in_array($role, ['Route']))
            <li><a href="{{ route('pedidos.index') }}">Registrar evidencias de entregas y marcar pedidos como entregados</a></li>
        @endif

        @if(in_array($role, ['Customer']))
            <li><a href="{{ route('customer.index') }}">Status de pedido (cliente)</a></li>
        @endif
    </ul>
</div>
@endsection