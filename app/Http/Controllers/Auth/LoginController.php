<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
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
     * @var string
     */
    /**protected $redirectTo = '/Home';*/
    protected $redirectTo = RouteServiceProvider::HOME;

    public function username()
    {
        return 'username';
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

////////////////////////
    protected function redirectTo()
    {
    // Obtener el rol del usuario autenticado
    if (auth()->user()->employee->roles) {
        $role = auth()->user()->employee->roles->role_name;

        // Redirigir según el rol
        if ($role === 'Admin') {
            return '/Home';
        } else {
            return '/HomeTeacher';
        }
    }else{
        return '/';
    }
}
}
