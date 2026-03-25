<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Material;

class MaterialController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $this->authorizeRole(['Warehouse', 'Purchasing', 'Admin']);
        $materiales = Material::all();
        return view('materiales.index', compact('materiales'));
    }

    public function create()
    {
        return view('materiales.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'stock' => 'required|integer',
        ]);

        Material::create($request->only(['nombre', 'descripcion', 'stock']));

        return redirect()->route('materiales.index')->with('success', 'Material creado.');
    }

    public function edit($id)
    {
        $material = Material::findOrFail($id);
        return view('materiales.edit', compact('material'));
    }

    public function update(Request $request, $id)
    {
        $material = Material::findOrFail($id);
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'stock' => 'required|integer',
        ]);

        $material->update($request->only(['nombre', 'descripcion', 'stock']));

        return redirect()->route('materiales.index')->with('success', 'Material actualizado.');
    }

    public function destroy($id)
    {
        Material::findOrFail($id)->delete();
        return redirect()->route('materiales.index')->with('success', 'Material eliminado.');
    }
}
