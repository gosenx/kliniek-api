<?php

namespace App\Http\Middleware;

use App\Models\Authentication\Admin;
use Closure;
use Illuminate\Support\Facades\Auth;

class HasAdminPrivileges
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->profile_type == Admin::class) {
            return $next($request);
        }

        return response()->json([
            'message' => 'Forbidden.'
        ], 403);
    }
}
