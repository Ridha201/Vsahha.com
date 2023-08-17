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
    
        if (is_null($days)) {
            return redirect()->back()->with('error', 'No days selected.');
        }
    
        foreach ($days as $day) {
            $schedule = DoctorSchedule::find($day);
    
            $schedule->time_from = $req->input("time_from_$day");
            $schedule->time_to = $req->input("time_to_$day");
    
            $schedule->save();
        }
    
        return redirect()->back()->with('success', 'Schedule updated successfully.');
    }
    
    
    }
