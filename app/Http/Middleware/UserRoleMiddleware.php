<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserRoleMiddleware
{
    public function handle(Request $request, Closure $next)
    {

        $user = Auth::user();

        if ($user->role === 'director') {
            return $next($request);
        }

        if ($user->role === 'teacher') {
            return $next($request);
        }


        return response()->json(['message' => 'Unauthorized'], 403);
    }
}
