<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Role;
use Illuminate\Validation\ValidationException;
use App\Models\DoctorSchedule;





class AuthController extends Controller
{
    public function login(Request $request)
{
    $credentials = $request->only('email', 'password');
    
    if (Auth::attempt($credentials)) {
        $token = JWTAuth::fromUser(Auth::user());

        if ($request->wantsJson()) {
            return response()->json(['token' => $token]);
        } else {
            
            return redirect()->route(Auth::user()->role->name); 
        }
    }
    
    if ($request->wantsJson()) {
        return response()->json(['message' => 'Invalid credentials'], 401);
    } else {
        return back()->with('error', 'Invalid credentials');
    }
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
    try {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $role = Role::where('name', $request->role)->first();

        if (!$role) {
            return response()->json(['message' => 'Invalid role'], 400);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $role->id, 
        ]);

        Auth::login($user);

        if ($request->role == "Doctor") {
            $daysOfWeek = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
    
            foreach ($daysOfWeek as $day) {
    
                DoctorSchedule::create([
                    'doctor_id' => $user->id,
                    'day' => $day,
                    'time_from' => null,
                    'time_to' => null,
                ]);
            }
        }

        if ($request->wantsJson()) {
            return response()->json(['message' => 'User registered successfully', 'user' => $user], 201);
        } else {
            return redirect()->route('dashboard'); // Redirect to the dashboard
        }
    } catch (ValidationException $e) {
        if ($request->wantsJson()) {
            return response()->json(['message' => 'Validation error', 'errors' => $e->errors()], 422);
        } else {
            return back()->withErrors($e->errors())->withInput();
        }
    } catch (\Exception $e) {
        if ($request->wantsJson()) {
            return response()->json(['message' => 'Registration failed', 'error' => $e->getMessage()], 500);
        } else {
            return back()->with('error', 'Registration failed: ' . $e->getMessage());
        }
    }

   
}

public function logout(Request $request)
{
    Auth::logout();

    if ($request->wantsJson()) {
        return response()->json(['message' => 'Logged out successfully']);
    } else {
        return redirect()->route('login');
    }
}

public function doctor()
{
    return view('doctor');

}



public function patient()
{
    return view('patient');
}

}