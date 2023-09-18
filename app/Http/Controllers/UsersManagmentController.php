<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\User;
use App\Models\Patient;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

use App\Mail\PatientCredentialsMail;


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

 
    if ($request->phone) {
        $customer->phone = $request->phone;
    }
    if ($request->birthdate) {
        $customer->birthdate = $request->birthdate;
    }
    if ($request->insurance_number) {
        $customer->insurance_number = $request->insurance_number;
    }
    if ($request->gender) {
        $customer->gender = $request->gender;
    }
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
    if ($request->email != $user->email){
        $user->email = $request->email;
    }
    
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
    $user->role_id = $role->id;
    
    if ($request->phone) {
        $user->phone = $request->phone;
    }
    if ($request->birthdate) {
        $user->birthdate = $request->birthdate;
    }
    if ($request->insurance_number) {
        $user->insurance_number = $request->insurance_number;
    }
    if ($request->gender) {
        $user->gender = $request->gender;
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


public function importPatients(Request $request){
    ini_set("auto_detect_line_endings", true);
    $request->validate([
        'csv_file' => 'required|file|mimes:csv,txt',
    ]);
        $csvFile = $request->file('csv_file');
        $file = fopen($csvFile->getPathname(), 'r');
        $header = fgetcsv($file);
            while (($data = fgetcsv($file)) !== false) {
                $patientData = array_combine($header, $data);
                $notificationDate = date_create_from_format('d/m/Y', $patientData['Notification Date']);
                $dob = date_create_from_format('d/m/Y', $patientData['DOB']);
                $startCoverage = date_create_from_format('d/m/Y', $patientData['StartCoverage']);
                $endCoverage = date_create_from_format('d/m/Y', $patientData['EndCoverage']);
                $email_exists = DB::table('patients')->where('E_mail', $patientData['E-mail'])->exists();
                $notificationDateFormatted = $notificationDate ? $notificationDate->format('Y-m-d') : null;
                if(!$email_exists){
                $patient = new Patient;
                $patient->NotificationDate = $notificationDateFormatted;
                $patient->TransactionType = $patientData['Transaction Type'];
                $patient->Name = $patientData['Name'];
                $patient->Surname = $patientData['Surname'];
                $patient->Gender = $patientData['Gender'];
                $patient->E_mail = $patientData['E-mail'];
                $patient->Relationship = $patientData['Relationship'];
                $patient->IDPolicyNumber = $patientData['IDPolicyNumber'];
                $patient->IDmainPolicyHolder = $patientData['IDmainPolicyHolder'];
                $patient->DOB = $dob;
                $patient->StartCoverage = $startCoverage;
                $patient->EndCoverage = $endCoverage;
                $patient->Language = $patientData['Language'];
                $patient->GroupName = $patientData['GroupName'];
                $patient->GroupPolicyNumber = $patientData['GroupPolicyNumber'];
                $patient->MobilePhoneNumber = $patientData['MobilePhoneNumber'];
                $patient->Address = $patientData['Address'];
                $patient->ZipCode = $patientData['ZipCode'];
                $patient->City = $patientData['City'];
                $patient->Country = $patientData['Country'];
                $patient->AreaName = $patientData['AreaName'];
                $patient->save();

                $user = new User;
                $password = Str::random(8);
                $user->name = $patientData['Name']; // You can set a name for the user
                $user->email = $patientData['E-mail'];
                $user->password = bcrypt($password);
                $user->role_id = 2; // Hash the password
                $user->save();
               
                Mail::to($user->email)->send(new PatientCredentialsMail($user, $password));
                }
}
fclose($file);
return redirect()->back()->with('success', 'Patients imported successfully');
}

}
