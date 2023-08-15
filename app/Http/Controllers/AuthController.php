<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use JWTAuth;
use Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Role;


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

    public function showRegistrationForm()
{
    return view('auth.register');
}

public function register(Request $request)
{
    $this->validate($request, [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed',
    ]);

    $role = Role::where('name', $request->role)->first();

    

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role_id' => $role->id, 
    ]);

    Auth::login($user);

    return redirect()->route('dashboard'); // Redirect to the dashboard or any other page
}

}
