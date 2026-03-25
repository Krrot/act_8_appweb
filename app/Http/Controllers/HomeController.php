<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard with role-driven landing pages.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = auth()->user();

        if (! $user || ! $user->role) {
            return view('home');
        }

        if ($user->role->nombreRol === 'Customer') {
            return redirect()->route('customer.index');
        }

        return redirect()->route('role.dashboard');
    }
}
