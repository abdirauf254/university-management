<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PermissionMiddleware
{
    public function handle(
        Request $request,
        Closure $next,
        ...$permissions
    ): Response {
        $user = $request->user();

        if (!$user) {
            return redirect()->route('login');
        }

        foreach ($permissions as $permission) {
            if ($user->roles()->whereHas(
                'permissions',
                fn ($query) => $query->where('name', $permission)
            )->exists()) {
                return $next($request);
            }
        }

        abort(403, 'You do not have the required permission.');
    }
}