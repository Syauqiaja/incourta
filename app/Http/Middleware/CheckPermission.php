<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$types): Response
    {
        if (!Auth::check()) {
            return redirect()->route('admin.login.form');
        }
        $user = $request->user();

        if (!$user) {
            abort(403, 'User is not logged in.');
        }
        $routeRaw = $request->route()->getName();  // misal 'property.index'
        if (!$routeRaw) {
            abort(403, 'Route is not named.');
        }
        $routeParts = explode('.', $routeRaw);
        $routeName = end($routeParts);

        foreach ($types as $type) {
            $routeParts[count($routeParts) - 1] = $type;
            $permission = implode('>', $routeParts);

            if ($user->can($permission)) {
                return $next($request);
            }
        }
        abort(403, 'User does not have the right permissions.');
    }
}
