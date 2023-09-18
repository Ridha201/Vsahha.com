<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\appointment;
use App\Rules\AppointementInRange;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;

use  App\Models\DoctorSchedule;


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
           
                
        $app = Appointment::create([
            "patient_id" => 2,
            "doctor_id" => $doctorId,
            "appointment_time" => $appointmentTime,
            "status" => "booked"
        ]);
    
        return response()->json($app, 201);
    }
    

// list appointment by connected doctor :

public function appointments(){

    
    $appointments=appointment::where("doctor_id","=",Auth::user()->id)->get();


    return view('doctors.list-appointments',compact('appointments'));
}






public function reject($id){

    $app=appointment::find($id);

    $app->status="rejected";

    $app->save();

    return redirect()->back()->with("rejected","appointment rejected successfully ","status",$app->status);


}


public function disponibleappointment($id)
{
    $doctorId = $id; // Replace with the actual doctor's ID
    $startDate = Carbon::now();
    $endDate = $startDate->copy()->addDays(30); // Replace with the desired end date

    // Create an array to store available slots grouped by day
    $availableSlotsByDay = [];

    // Iterate through each day within the date range
    $currentDate = $startDate;
    while ($currentDate <= $endDate) {
        // Get the day name (e.g., "Monday", "Tuesday") for the current date
        $dayName = $currentDate->format('l');

        // Retrieve the doctor's schedule for the current day
        $doctorSchedule = DoctorSchedule::where('doctor_id', $doctorId)
            ->where('day', $dayName)
            ->first();

        if ($doctorSchedule) {
            // Parse the start and end times
            $startTime = Carbon::parse($doctorSchedule->time_from);
            $endTime = Carbon::parse($doctorSchedule->time_to);

            // Calculate available slots for the current day
            $availableSlots = [];
            while ($startTime < $endTime) {
                $availableSlots[] = $startTime->format('H:i');
                $startTime->addMinutes(30);
            }

            // Retrieve appointments for the current date, including rejected ones
            $appointments = Appointment::where('doctor_id', $doctorId)
                ->whereDate('appointment_time', $currentDate->toDateString())
                ->get();

            // Filter out rejected appointments
            $bookedAppointments = $appointments->filter(function ($appointment) {
                return $appointment->status !== 'rejected';
            });

            // Remove booked slots from available slots and re-index the array
            foreach ($bookedAppointments as $appointment) {
                $bookedTime = Carbon::parse($appointment->appointment_time)->format('H:i');
                $key = array_search($bookedTime, $availableSlots);
                if ($key !== false) {
                    unset($availableSlots[$key]);
                }
            }

            // Re-index the available slots array
            $availableSlots = array_values($availableSlots);

            // Add available slots to the array for the current day
            $availableSlotsByDay[$currentDate->toDateString()] = $availableSlots;
        } else {
            // Handle the case where there is no schedule for the current day
            $availableSlotsByDay[$currentDate->toDateString()] = [];
        }

        // Move to the next day
        $currentDate->addDay();
    }

    // Convert the result to JSON and return it as a JSON response
    return JsonResponse::create($availableSlotsByDay);
}

public function change_show(){

    appointment::query()->update(['show' => 1]);

}
public function show()
{
    $appointments = appointment::select('appointments.*', 'users.name as patient_name')
    ->where('appointments.doctor_id', auth()->user()->id)
    ->where('appointments.show', 0)
    ->join('users', 'users.id', '=', 'appointments.patient_id')
    ->get();
    

        $count=appointment::where('doctor_id', auth()->user()->id)
        ->where('show', 0)
        ->count();

    return response()->json(['appointments' => $appointments, 'count' => $count]);
}


}


