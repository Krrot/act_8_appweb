<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthApiController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
            'device_name' => 'required',
        ]);

        $user = User::where('nombreUsuario', $request->username)->first();

        // Note: The User model has 'contrasena' which is hashed. 
        // Laravel's Auth uses 'password' by default, but we use 'contrasena' in the model.
        if (! $user || ! Hash::check($request->password, $user->contrasena)) {
            throw ValidationException::withMessages([
                'username' => ['Las credenciales proporcionadas son incorrectas.'],
            ]);
        }

        $token = $user->createToken($request->device_name)->plainTextToken;

        return response()->json([
            'token' => $token,
            'user' => [
                'id' => $user->id,
                'name' => $user->nombre,
                'username' => $user->nombreUsuario,
                'role' => $user->role->nombreRol ?? 'User',
            ]
        ]);
    }
}
