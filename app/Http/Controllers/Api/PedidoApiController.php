<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pedido;
use Illuminate\Http\Request;

class PedidoApiController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $userRole = $user->role->nombreRol ?? 'User';
        
        $query = Pedido::with('cliente', 'usuario', 'routeUsuario');

        if ($userRole === 'Sales') {
            $query->where('usuarioId', $user->id);
        } elseif ($userRole === 'Warehouse') {
            $query->whereIn('estadoId', [1, 2]);
        } elseif ($userRole === 'Route') {
            $query->where('routeUsuarioId', $user->id);
        }

        $pedidos = $query->where('activo', true)->get();

        return response()->json($pedidos);
    }

    public function store(Request $request)
    {
        $request->validate([
            'clienteId' => 'required|exists:clientes,id',
            'fechaPedido' => 'required|date',
            'notas' => 'nullable|string',
            'routeUsuarioId' => 'nullable|exists:usuarios,id',
        ]);

        $lastPedido = Pedido::orderBy('id', 'desc')->first();
        $nextNumber = $lastPedido ? intval(substr($lastPedido->numeroFactura, 3)) + 1 : 1;
        $numeroFactura = 'INV' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);

        $pedido = Pedido::create([
            'numeroFactura' => $numeroFactura,
            'clienteId' => $request->clienteId,
            'fechaPedido' => $request->fechaPedido,
            'notas' => $request->notas,
            'estadoId' => 1,
            'usuarioId' => auth()->id(),
            'routeUsuarioId' => $request->routeUsuarioId,
            'activo' => true,
            'creacionEn' => now(),
        ]);

        return response()->json($pedido, 201);
    }

    public function show(Pedido $pedido)
    {
        $pedido->load('cliente', 'usuario', 'evidencias');
        return response()->json($pedido);
    }

    public function update(Request $request, Pedido $pedido)
    {
        $request->validate([
            'estadoId' => 'sometimes|integer|min:1|max:4',
            'notas' => 'sometimes|string',
        ]);

        $pedido->update($request->only(['estadoId', 'notas', 'routeUsuarioId', 'activo']));

        return response()->json($pedido);
    }

    public function destroy(Pedido $pedido)
    {
        $pedido->update(['activo' => false]);
        return response()->json(['message' => 'Pedido desactivado']);
    }
}
