<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\appointment;
use App\Rules\AppointementInRange;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class AppointmentController extends Controller
{

    //add appointmnent from " mobile application " ----> patient_id == auth::user()->id in mobile ;

    public function store(Request $request) {
        $request->validate([
            "doctor_id" => "required",
            "appointment_time" => ["required", new AppointementInRange]
        ]);
    
        $doctorId = $request->doctor_id;
        $appointmentTime = $request->appointment_time;
    
       
    
        $appointmentTime = \Carbon\Carbon::parse($request->appointment_time);

        $existingAppointments = Appointment::where('doctor_id', $doctorId)
        ->where('appointment_time', '<=', $appointmentTime)
        ->orderBy('appointment_time', 'desc')
        ->first();
    
        
        
               
        if ($existingAppointments) {
            $existingAppointmentTime = Carbon::parse($existingAppointments->appointment_time);
            $timeDifference = $appointmentTime->diffInMinutes($existingAppointmentTime);
            
            if ($timeDifference < 30) {
                $nextAvailableTime = $existingAppointmentTime->addMinutes(30)->format('Y-m-d H:i:s');
                
                $rejectedAppointmentsOnSameDay = Appointment::where('doctor_id', $doctorId)
                    ->where('status', 'rejected')
                    ->whereDate('appointment_time', $appointmentTime->format('Y-m-d'))
                    ->pluck('appointment_time');
        
                if ($rejectedAppointmentsOnSameDay->count() > 0) {
                    $rejectedDates = $rejectedAppointmentsOnSameDay->implode(', ');
                    return response()->json([
                        "error" => "There's an appointment within 30 minutes of this time. You can take the next appointment on $nextAvailableTime. Additionally, we have a  rejected appointment(s) on the same day that you can take  : $rejectedDates."
                    ], 400);
                } else {
                    return response()->json([
                        "error" => "There's an appointment within 30 minutes of this time. You can take the next appointment on $nextAvailableTime."
                    ], 400);
                }
            }
        }
        
        
        
    


           
                
        // Create the appointment
        $app = Appointment::create([
            "patient_id" => 2,
            "doctor_id" => $doctorId,
            "appointment_time" => $appointmentTime,
            "status" => "pending"
        ]);
    
        return response()->json($app, 201);
    }
    

// list appointment by connected doctor :

public function appointments(){

    
    $appointments=appointment::where("doctor_id","=",Auth::user()->id)->get();


    return view('doctors.list-appointments',compact('appointments'));
}




public function confirm($id){

    $app=appointment::find($id);

    $app->status="confirmed";

    $app->save();

    return redirect()->back()->with("confirmed","appointment confirmed successfully ","status",$app->status);

}

public function reject($id){

    $app=appointment::find($id);

    $app->status="rejected";

    $app->save();

    return redirect()->back()->with("rejected","appointment rejected successfully ","status",$app->status);


}





}
