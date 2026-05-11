<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Material;
use Illuminate\Http\Request;

class MaterialApiController extends Controller
{
    public function index()
    {
        return response()->json(Material::all());
    }

    public function show(Material $material)
    {
        return response()->json($material);
    }
}
