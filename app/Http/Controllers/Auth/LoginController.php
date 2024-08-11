<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    protected $redirectTo;

    ////////////////////////
    protected function redirectTo(Request $request)
    {
        // // Obtener el rol del usuario autenticado
        // if (auth()->user()->employee->roles) {
        //     $role = auth()->user()->employee->roles->role_name;

        //     // Redirigir según el rol
        //     if ($role === 'Admin') {
        //         return '/Home';
        //     } else {
        //         return '/HomeTeacher';
        //     }
        // }else{
        //     $this->redirectTo='/login';
        //     return $this->redirectTo;

        // }
        switch (Auth::user()->employee->roles->role_name) {
            case 'Admin':
                return '/Home';

            case 'Profesor':
                return '/HomeTeacher';

            default:
                $this->redirectTo = '/login';
                return $this->redirectTo;
        }
    }
    public function redirectPath(Request $request)
    {
        if (method_exists($this, 'redirectTo')) {
            return $this->redirectTo($request);
        }

        return property_exists($this, 'redirectTo') ? $this->redirectTo : '/';
    }
    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        if ($response = $this->authenticated($request, $this->guard()->user())) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect()->intended($this->redirectPath($request));
    }
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
}
