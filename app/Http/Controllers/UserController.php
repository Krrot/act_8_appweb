<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with('role')->paginate(10);
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        return view('users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombreUsuario' => 'required|string|max:50|unique:usuarios',
            'contrasena' => 'required|string|min:6',
            'nombre' => 'required|string|max:100',
            'nombreApellido' => 'nullable|string|max:100',
            'rolId' => 'required|exists:roles,id',
        ]);

        User::create([
            'nombreUsuario' => $request->nombreUsuario,
            'contrasena' => Hash::make($request->contrasena),
            'nombre' => $request->nombre,
            'nombreApellido' => $request->nombreApellido,
            'rolId' => $request->rolId,
            'activo' => true,
        ]);

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        return view('users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'nombreUsuario' => 'required|string|max:50|unique:usuarios,nombreUsuario,' . $user->id,
            'contrasena' => 'nullable|string|min:6',
            'nombre' => 'required|string|max:100',
            'nombreApellido' => 'nullable|string|max:100',
            'rolId' => 'required|exists:roles,id',
            'activo' => 'boolean',
        ]);

        $user->update([
            'nombreUsuario' => $request->nombreUsuario,
            'contrasena' => $request->filled('contrasena') ? Hash::make($request->contrasena) : $user->contrasena,
            'nombre' => $request->nombre,
            'nombreApellido' => $request->nombreApellido,
            'rolId' => $request->rolId,
            'activo' => $request->activo,
        ]);

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        if (auth()->id() === $user->id) {
            return redirect()->route('users.index')->with('error', 'You cannot deactivate yourself.');
        }

        $user->update(['activo' => false]);
        return redirect()->route('users.index')->with('success', 'User deactivated successfully.');
    }
}
