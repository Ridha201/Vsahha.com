<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // You can access the authenticated user using $request->user()
        $user = $request->user();
        
        // Your logic to display the dashboard view or return data
        return view('dashboard', compact('user'));
    }
}


