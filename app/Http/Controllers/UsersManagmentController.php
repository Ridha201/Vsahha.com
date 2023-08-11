<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\User;

class UsersManagmentController extends Controller
{
    public function addCustomer(Request $request)
{
   

    $role = new Role;
    $role->name = $request->role;
    if ($request->role == 'Médecin') {
        $role->description = 'Médecin';
    } else if ($request->role == 'Patient') {
        $role->description = 'Patient';
    } else if ($request->role == 'Administrateur') {
        $role->description = 'Administrateur';
    }
    $role->save();
    $customer = new User;
    $customer->name = $request->name;
    $customer->email = $request->email;
    $customer->password = bcrypt($request->password);
    $customer->role_id = $role->id;
    $customer->save();
    return redirect()->route('customerslist');
}

public function displayCustomers()
{
    $customers = User::with('role')->paginate(5);

    return view('clist', compact('customers'));
}

public function filterCustomers($role = null)
{
    $query = User::query();

    if ($role) {
        $query->whereHas('role', function ($q) use ($role) {
            $q->where('name', $role);
        });
    }

    $customers = $query->with('role')->paginate(2);

    $paginationLinks = [
        'prev_page_url' => $customers->previousPageUrl(),
        'next_page_url' => $customers->nextPageUrl(),
        'current_page' => $customers->currentPage(),
        'last_page' => $customers->lastPage(),
        'url' => $customers->url($customers->currentPage()), // Correct URL generation here
    ];

    return response()->json([
        'data' => $customers->items(),
        'links' => $paginationLinks,
    ]);
}

public function updateUser(Request $request)
{
    $user = User::findOrFail($request->id);
    $user->name = $request->name;
    $user->email = $request->email;
    if ($request->password) {
        $user->password = bcrypt($request->password);
    }
    if ($request->role != "Select a Role") {
        $role = Role::where('id', $user->role_id)->first();
        $role->name = $request->role;
        if ($request->role == 'Médecin') {
            $role->description = 'Médecin';
        } else if ($request->role == 'Patient') {
            $role->description = 'Patient';
        } else if ($request->role == 'Administrateur') {
            $role->description = 'Administrateur';
        }
        $role->save(); 
        $user->role_id = $role->id;    
    }
    $user->save();

    return redirect()->route('customerslist');
}

public function deleteUser(Request $request)
{
    $user = User::findOrFail($request->id);
    $role = Role::where('id', $user->role_id)->first();
    $user->delete();
    $role->delete();

    return redirect()->route('customerslist');
}
}