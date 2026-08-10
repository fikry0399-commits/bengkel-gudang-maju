<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        if (!$request->user()) {
            return $request->expectsJson() 
                ? response()->json(['message' => 'Sesi berakhir, silahkan login kembali'], 401) 
                : redirect()->route('login');
        }

        // Ambil nama role (fleksibel baik berupa relasi objek maupun string langsung)
        $userRole = $request->user()->role->role_name ?? $request->user()->role;

        if (!in_array($userRole, $roles)) {
            if ($request->expectsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => "Anda tidak memiliki akses (Role: {$userRole}) untuk fitur ini"
                ], 403);
            }

            abort(403, 'Unauthorized');
        }

        return $next($request);
    }
}