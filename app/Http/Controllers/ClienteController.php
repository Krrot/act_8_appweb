<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Direccion;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $this->authorizeRole(['Admin', 'Sales']);
        $clientes = Cliente::with('direccion')->paginate(10);
        return view('clientes.index', compact('clientes'));
    }

    public function create()
    {
        $this->authorizeRole(['Admin', 'Sales']);
        $direcciones = Direccion::all();
        return view('clientes.create', compact('direcciones'));
    }

    public function store(Request $request)
    {
        $this->authorizeRole(['Admin', 'Sales']);

        $request->validate([
            'numeroCliente' => 'required|string|max:50|unique:clientes',
            'telefono' => 'nullable|string|max:20',
            'correoElectronico' => 'nullable|email|max:100',
            'direccionesId' => 'nullable|exists:direcciones,id',
        ]);

        Cliente::create([
            'numeroCliente' => $request->numeroCliente,
            'telefono' => $request->telefono,
            'correoElectronico' => $request->correoElectronico,
            'activo' => true,
            'registroFecha' => now(),
            'direccionesId' => $request->direccionesId,
        ]);

        return redirect()->route('clientes.index')->with('success', 'Client created successfully.');
    }

    public function show(Cliente $cliente)
    {
        return view('clientes.show', compact('cliente'));
    }

    public function edit(Cliente $cliente)
    {
        $this->authorizeRole(['Admin', 'Sales']);
        $direcciones = Direccion::all();
        return view('clientes.edit', compact('cliente', 'direcciones'));
    }

    public function update(Request $request, Cliente $cliente)
    {
        $this->authorizeRole(['Admin', 'Sales']);

        $request->validate([
            'numeroCliente' => 'required|string|max:50|unique:clientes,numeroCliente,' . $cliente->id,
            'telefono' => 'nullable|string|max:20',
            'correoElectronico' => 'nullable|email|max:100',
            'direccionesId' => 'nullable|exists:direcciones,id',
            'activo' => 'boolean',
        ]);

        $cliente->update($request->only([
            'numeroCliente', 'telefono', 'correoElectronico', 'direccionesId', 'activo'
        ]));

        return redirect()->route('clientes.index')->with('success', 'Client updated successfully.');
    }

    public function destroy(Cliente $cliente)
    {
        $this->authorizeRole(['Admin']);
        $cliente->update(['activo' => false]);
        return redirect()->route('clientes.index')->with('success', 'Client deactivated successfully.');
    }
}