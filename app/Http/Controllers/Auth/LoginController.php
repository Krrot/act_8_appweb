<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @return string
     */
    protected function redirectTo()
    {
        $user = auth()->user();

        if (! $user || ! $user->role) {
            return '/home';
        }

        switch ($user->role->nombreRol) {
            case 'Admin':
                return '/role-dashboard';
            case 'Sales':
                return '/role-dashboard';
            case 'Warehouse':
                return '/role-dashboard';
            case 'Purchasing':
                return '/role-dashboard';
            case 'Route':
                return '/role-dashboard';
            case 'Customer':
                return '/customer';
            default:
                return '/home';
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return 'nombreUsuario';
    }
}
