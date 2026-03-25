<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EvidenciaFotografica;

class EvidenciaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $this->authorizeRole(['Route', 'Admin']);
        $evidencias = EvidenciaFotografica::with('pedido')->orderBy('fechaSubida', 'desc')->get();
        return view('evidencias.index', compact('evidencias'));
    }

    public function create()
    {
        return view('evidencias.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'pedidoId' => 'required|exists:pedidos,id',
            'descripcion' => 'nullable|string',
            'rutaImagen' => 'nullable|string',
        ]);

        EvidenciaFotografica::create([
            'pedidoId' => $request->pedidoId,
            'usuarioId' => auth()->id(),
            'tipo' => 'ENTREGA',
            'urlFoto' => $request->rutaImagen,
            'fechaSubida' => now(),
            'descripcion' => $request->descripcion,
            'rutaImagen' => $request->rutaImagen,
        ]);

        return redirect()->route('evidencias.index')->with('success', 'Evidencia registrada.');
    }
}
