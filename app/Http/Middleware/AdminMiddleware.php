<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check()) {
            $role = auth()->user()->role;
            if ($role === 'admin') {
                return $next($request);
            }
            if (in_array($role, ['boys_admin', 'girls_admin'])) {
                // Allow access to specific routes
                $allowedRoutes = [
                    'admin.student.updateStatus',
                    'admin.boys.dashboard',
                    'admin.girls.dashboard',
                    'admin.students.exportByInstitution',
                    'admin.talents-meet-notifications.store',
                    'admin.talents-meet-notifications.destroy',
                ];
                if (in_array($request->route()->getName(), $allowedRoutes)) {
                    return $next($request);
                }
            }
        }

        abort(403, 'Unauthorized');
    }
}


