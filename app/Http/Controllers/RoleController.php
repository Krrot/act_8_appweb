<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function dashboard()
    {
        $this->authorizeRole(['Admin', 'Sales', 'Warehouse', 'Purchasing', 'Route', 'Customer']);

        $role = auth()->user()->role->nombreRol;

        return view('roles.dashboard', compact('role'));
    }
}
