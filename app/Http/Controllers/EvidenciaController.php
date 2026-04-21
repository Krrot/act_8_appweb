<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EvidenciaFotografica;
use App\Models\Pedido;

class EvidenciaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Pedido $pedido)
    {
        $this->authorizeRole(['Route', 'Admin', 'Warehouse', 'Sales']);
        $evidencias = $pedido->evidencias()->with('usuario')->orderBy('fechaSubida', 'desc')->get();
        return view('evidencias.index', compact('evidencias', 'pedido'));
    }

    public function create(Pedido $pedido)
    {
        $this->authorizeRole(['Route', 'Admin']);
        return view('evidencias.create', compact('pedido'));
    }

    public function store(Request $request, Pedido $pedido)
    {
        $this->authorizeRole(['Route', 'Admin']);
        
        $request->validate([
            'tipo' => 'required|in:LOADED,DELIVERED,DAMAGE,INSTALLATION',
            'urlFoto' => 'nullable|string',
            'descripcion' => 'nullable|string',
        ]);

        $evidencia = $pedido->evidencias()->create([
            'usuarioId' => auth()->id(),
            'tipo' => $request->tipo,
            'urlFoto' => $request->urlFoto,
            'fechaSubida' => now(),
            'descripcion' => $request->descripcion,
        ]);

        // Si es evidencia de entrega, cambiar estado a Delivered
        if ($request->tipo === 'DELIVERED') {
            $pedido->update(['estadoId' => 4]);
        }

        return redirect()->route('pedidos.evidencias.index', $pedido)->with('success', 'Evidencia registrada.');
    }

    public function show(Pedido $pedido, EvidenciaFotografica $evidencia)
    {
        return view('evidencias.show', compact('evidencia', 'pedido'));
    }

    public function edit(Pedido $pedido, EvidenciaFotografica $evidencia)
    {
        $this->authorizeRole(['Route', 'Admin']);
        return view('evidencias.edit', compact('evidencia', 'pedido'));
    }

    public function update(Request $request, Pedido $pedido, EvidenciaFotografica $evidencia)
    {
        $this->authorizeRole(['Route', 'Admin']);
        
        $request->validate([
            'tipo' => 'required|in:LOADED,DELIVERED,DAMAGE,INSTALLATION',
            'urlFoto' => 'nullable|string',
            'descripcion' => 'nullable|string',
        ]);

        $evidencia->update([
            'tipo' => $request->tipo,
            'urlFoto' => $request->urlFoto,
            'descripcion' => $request->descripcion,
        ]);

        // Si es evidencia de entrega, cambiar estado a Delivered
        if ($request->tipo === 'DELIVERED') {
            $pedido->update(['estadoId' => 4]);
        }

        return redirect()->route('pedidos.evidencias.index', $pedido)->with('success', 'Evidencia actualizada.');
    }

    public function destroy(Pedido $pedido, EvidenciaFotografica $evidencia)
    {
        $this->authorizeRole(['Route', 'Admin']);
        $evidencia->delete();
        return redirect()->route('pedidos.evidencias.index', $pedido)->with('success', 'Evidencia eliminada.');
    }
}
