<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\Cliente;
use App\Models\User;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    public function index(Request $request)
    {
        $query = Pedido::with('cliente', 'usuario');

        if ($request->filled('numeroFactura')) {
            $query->where('numeroFactura', 'like', '%' . $request->numeroFactura . '%');
        }

        if ($request->filled('numeroCliente')) {
            $query->whereHas('cliente', function ($q) use ($request) {
                $q->where('numeroCliente', 'like', '%' . $request->numeroCliente . '%');
            });
        }

        if ($request->filled('fecha')) {
            $query->whereDate('fechaPedido', $request->fecha);
        }

        if ($request->filled('estadoId')) {
            $query->where('estadoId', $request->estadoId);
        }

        $pedidos = $query->where('activo', true)->paginate(10);

        return view('pedidos.index', compact('pedidos'));
    }

    public function create()
    {
        $clientes = Cliente::all();
        $usuarios = User::all();
        return view('pedidos.create', compact('clientes', 'usuarios'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'numeroFactura' => 'required|string|max:50',
            'clienteId' => 'required|exists:clientes,id',
            'fechaPedido' => 'required|date',
            'notas' => 'nullable|string',
            'usuarioId' => 'required|exists:usuarios,id',
        ]);

        Pedido::create([
            'numeroFactura' => $request->numeroFactura,
            'clienteId' => $request->clienteId,
            'fechaPedido' => $request->fechaPedido,
            'notas' => $request->notas,
            'estadoId' => 1, // Ordered
            'usuarioId' => $request->usuarioId,
            'activo' => true,
            'creacionEn' => now(),
        ]);

        return redirect()->route('pedidos.index')->with('success', 'Order created successfully.');
    }

    public function show(Pedido $pedido)
    {
        $pedido->load('cliente', 'usuario', 'evidencias');
        return view('pedidos.show', compact('pedido'));
    }

    public function edit(Pedido $pedido)
    {
        $clientes = Cliente::all();
        $usuarios = User::all();
        return view('pedidos.edit', compact('pedido', 'clientes', 'usuarios'));
    }

    public function update(Request $request, Pedido $pedido)
    {
        $request->validate([
            'numeroFactura' => 'required|string|max:50',
            'clienteId' => 'required|exists:clientes,id',
            'fechaPedido' => 'required|date',
            'notas' => 'nullable|string',
            'estadoId' => 'required|integer|min:1|max:4',
            'usuarioId' => 'required|exists:usuarios,id',
            'activo' => 'boolean',
        ]);

        $pedido->update($request->only([
            'numeroFactura', 'clienteId', 'fechaPedido', 'notas', 'estadoId', 'usuarioId', 'activo'
        ]));

        return redirect()->route('pedidos.index')->with('success', 'Order updated successfully.');
    }

    public function destroy(Pedido $pedido)
    {
        $pedido->update(['activo' => false]);
        return redirect()->route('pedidos.index')->with('success', 'Order deactivated successfully.');
    }

    public function deleted()
    {
        $pedidos = Pedido::with('cliente', 'usuario')->where('activo', false)->paginate(10);
        return view('pedidos.deleted', compact('pedidos'));
    }

    public function restore($id)
    {
        $pedido = Pedido::findOrFail($id);
        $pedido->update(['activo' => true]);
        return redirect()->route('pedidos.deleted')->with('success', 'Order restored successfully.');
    }
}