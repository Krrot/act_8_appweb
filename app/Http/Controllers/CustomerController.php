<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\Cliente;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        return view('customer.index');
    }

    public function checkStatus(Request $request)
    {
        $request->validate([
            'numeroCliente' => 'required|string',
            'numeroFactura' => 'required|string',
        ]);

        $cliente = Cliente::where('numeroCliente', $request->numeroCliente)->first();

        if (!$cliente) {
            return back()->withErrors(['numeroCliente' => 'Customer number not found.']);
        }

        $pedido = Pedido::where('clienteId', $cliente->id)
                        ->where('numeroFactura', $request->numeroFactura)
                        ->where('activo', true)
                        ->with('evidencias')
                        ->first();

        if (!$pedido) {
            return back()->withErrors(['numeroFactura' => 'Invoice number not found for this customer.']);
        }

        return view('customer.status', compact('pedido'));
    }
}