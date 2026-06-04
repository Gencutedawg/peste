<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ValidateSessionRole
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // If user is authenticated, ensure their session matches their role
        if (auth()->check()) {
            $user = auth()->user();
            $expectedRole = $this->getExpectedRole($request);

            // If route expects a specific role and user doesn't have it, logout
            if ($expectedRole && $user->role !== $expectedRole) {
                auth()->logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return redirect('/login');
            }
        }

        return $next($request);
    }

    /**
     * Get the expected role for the current route.
     */
    private function getExpectedRole(Request $request): ?string
    {
        $path = $request->path();

        if (str_starts_with($path, 'admin')) {
            return 'admin';
        }

        if (str_starts_with($path, 'dashboard')) {
            return 'operator';
        }

        return null;
    }
}
