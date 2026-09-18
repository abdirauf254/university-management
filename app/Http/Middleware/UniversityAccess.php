<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UniversityAccess
{
    public function handle(
        Request $request,
        Closure $next
    ): Response {
        $user = $request->user();

        if (!$user) {
            return redirect()->route('login');
        }

        if ($user->hasRole('super_admin')) {
            return $next($request);
        }

        if (!$user->university_id) {
            abort(403, 'Your account is not assigned to a university.');
        }

        return $next($request);
    }
}