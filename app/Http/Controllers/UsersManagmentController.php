<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersManagmentController extends Controller{

    public function index(){
        $roles = Role::all();
    return view('add-customer', compact('roles'));
    }
    public function addCustomer(Request $request){
   
    $role = Role::where('name','=', $request->new_role)->first();

    if ($role == null && $request->role == "New Role") {
        $role = new Role;
        $role->name = $request->new_role;
        $role->description = $request->description;
        $role->save();
    } 
    elseif ($role != null) {
        $role = Role::where('name','=', $request->new_role)->first();
    }else {
        $role = Role::where('name','=', $request->role)->first();
    }

    $customer = new User;
    $customer->name = $request->name;
    $customer->email = $request->email;
    $customer->password = bcrypt($request->password);
    $customer->role_id = $role->id;
    $customer->save();
    

    
    return response()->json(['message' => 'Customer added successfully'], 200);
    }



public function displayCustomers()
{
    $customers = User::with('role')->paginate(1);
    $roles = Role::all();

    $paginationLinks = [
        'prev_page_url' => $customers->previousPageUrl(),
        'next_page_url' => $customers->nextPageUrl(),
        'current_page' => $customers->currentPage(),
        'last_page' => $customers->lastPage(),
        'url' => $customers->url($customers->currentPage()), 
    ];

    if (request()->wantsJson()) {
        return response()->json([
            'data' => $customers->items(),
            'links' => $paginationLinks,
        ]);
    }

    return view('clist', [
        'customers' => $customers,
        'roles' => $roles,
        'paginationLinks' => $paginationLinks,
    ]);
}
public function search()
{
    $customers = User::with('role')->get(); // Retrieve the users
    

    return response()->json([
        'data' => $customers, // Return the entire collection
    ]);
}
public function filterCustomers($role = null)
{
    $query = User::query();

    if ($role) {
        $query->whereHas('role', function ($q) use ($role) {
            $q->where('name', $role);
        });
    }
    
    $customers = $query->with('role')->get();
    return response()->json([
        'data' => $customers,
        
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
    $role = Role::where('name','=', $request->new_role)->first();

    if ($role == null && $request->role == "New Role") {
        $role = new Role;
        $role->name = $request->new_role;
        $role->description = $request->description;
        $role->save();
    } 
    elseif ($role != null) {
        $role = Role::where('name','=', $request->new_role)->first();
    }else {
        $role = Role::where('name','=', $request->role)->first();
    }
    $user->save();

    return redirect()->route('customerslist');
}

public function deleteUser(Request $request)
{
    $user = User::findOrFail($request->id);
    
    $user->delete();
    

    return redirect()->route('customerslist');
}
}