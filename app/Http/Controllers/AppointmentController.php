<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\appointment;
use App\Rules\AppointementInRange;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
class AppointmentController extends Controller
{

    //add appointmnent from " mobile application " ----> patient_id == auth::user()->id in mobile ;

    public function store(Request $request){
        $request->validate([
            "doctor_id"=>"required",
            "appointment_time"=>["required",new AppointementInRange]

        ]);

        $app = appointment::create([
            "patient_id"=>2,
            "doctor_id"=>$request->doctor_id,
            "appointment_time"=>$request->appointment_time,
            "status"=>"pending"
        ]);
        return response()->json($app,201);
    }

// list appointment by connected doctor :

public function appointments(){

    
  //  $appointments=appointment::where("doctor_id","=",Auth::user()->id);

  $appointments=appointment::where("doctor_id","=",1)->get();

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


public function testEmail()
{
    $appointment = Appointment::first(); 

    $data = [
        'appointment' => $appointment,
    ];

    Mail::send('emails.appointment-reminder', $data, function ($message) use ($appointment) {
        $message->to("yacinejmaiel@gmail.com")
                ->subject('Test Appointment Reminder');
    });

    return "Test email sent!";
}


}
