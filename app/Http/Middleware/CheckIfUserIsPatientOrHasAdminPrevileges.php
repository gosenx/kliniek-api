<?php

namespace App\Http\Middleware;

use App\Models\Authentication\Admin;
use Closure;
use Illuminate\Support\Facades\Auth;

class CheckIfUserIsPatientOrHasAdminPrevileges
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
        $user = Auth::user();
        if ($user->hasPatientProfile() && $user->profile->patient_code == $request->patient_code
            || $user->profile_type == Admin::class) {
            return $next($request);
        }

        return response()->json([
            'message' => 'Forbidden.'
        ], 403);
    }
}
