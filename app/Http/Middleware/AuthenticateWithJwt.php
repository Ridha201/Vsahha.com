<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthenticateWithJwt
{
    public function handle(Request $request, Closure $next)
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
            if (!$user) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }
            $request->merge(['user' => $user]);
        } catch (JWTException $e) {
            return response()->json(['error' => 'Token Invalid'], 401);
        }
        
        return $next($request);
    }
}