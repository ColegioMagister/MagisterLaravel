<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string  $role
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $role)
    {
        if ($request->user() && $request->user()->employee) {
            // Verificar si el usuario tiene un rol asociado
            if ($request->user()->employee->roles) {
                // Verificar si el rol del usuario coincide con el rol requerido
                if ($request->user()->employee->roles->role_name === $role) {
                    return $next($request);
                }

                /* // Permitir acceso a las rutas de "Profesor" para el rol "Admin"
                if ($role === 'Profesor' && $request->user()->employee->roles->role_name === 'Admin') {
                    return $next($request);
                }*/
            }
        } else {
            abort(403, "Acceso no autorizado");
        }
        abort(403, "Acceso no autorizado");
    }
}

