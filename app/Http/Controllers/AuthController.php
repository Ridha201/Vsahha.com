<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use JWTAuth;
use Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        
        if (Auth::attempt($credentials)) {
            $token = JWTAuth::fromUser(Auth::user());
    
            if ($request->wantsJson()) {
                // For API requests
                return response()->json(['token' => $token]);
            } else {
                // For web requests, redirect to the dashboard
                return redirect()->route('dashboard');
            }
        }
        
        return redirect()->route('login');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

}
