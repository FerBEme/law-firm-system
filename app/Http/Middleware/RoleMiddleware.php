<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
class RoleMiddleware {
    public function handle(Request $request, Closure $next, $roles): Response {
        $user = Auth::user(); // Obtenemos el usuario autenticado
        if (!$user || !in_array($user->role, $roles)) { // Si no hay usuario autenticado o si su rol no está en la lista permitida
            abort(403, 'Acceso denegado'); // Usuario no autorizado
        }
        return $next($request); // Si está autorizado, dejamos continuar la solicitud
    }
}
