<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\DoctorSchedule;
use Illuminate\Http\Request;

class doctorSchedulesController extends Controller
{
    public function schedules(){

        $schedules=DoctorSchedule::where("doctor_id","=",auth::user()->id)->get();

        return view("doctors.doctor-schedule",compact('schedules'));
    }

    public function updateschedule(Request $req)
    {
        $days = $req->input('check');
        if (is_null($days) || !isset($days) || count($days) == 0) {
            return response()->json(['error' => 'You must select a day'], 400);
        }
    
        foreach ($days as $day) {
            $schedule = DoctorSchedule::find($day);

            if($req->input("time_to_$day")<$req->input("time_from_$day")){
                return response()->json(['error' => 'An error occurred'], 500);
            }
    
            $schedule->time_from = $req->input("time_from_$day");
            $schedule->time_to = $req->input("time_to_$day");
    
            $schedule->save();
        }
    
        return response()->json(['success' => 'Schedule updated successfully'], 200);

    }
    
    
    }
