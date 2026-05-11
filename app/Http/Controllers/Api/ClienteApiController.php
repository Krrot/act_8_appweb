<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteApiController extends Controller
{
    public function index()
    {
        return response()->json(Cliente::all());
    }

    public function show(Cliente $cliente)
    {
        return response()->json($cliente);
    }
}
