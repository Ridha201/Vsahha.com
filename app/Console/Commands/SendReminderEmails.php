<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Appointment;
use Illuminate\Support\Facades\Mail;
use App\Mail\AppointmentReminder;
use Carbon\Carbon;


class SendReminderEmails extends Command
{
    protected $signature = 'email:send-reminders';
    protected $description = 'Send reminder emails to patients';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $reminders = Appointment::where('appointment_time', '<=', now()->addHours(24))->where("rappel","=","0")
        ->where("status","=","booked")
        ->get();
        foreach ($reminders as $appointment) {
            $data = [
                
                'appointment' => $appointment->appointment_time,
                'patient_name'=>$appointment->user->name , 
                'doctor_name'=>$appointment->doctor->name,
                
            ];

            Mail::send('emails.appointment-reminder', $data, function ($message) use ($appointment) {
                $message->to($appointment->user->email)
                        ->from('yassinetech0@gmail.com', 'vsahha.com')
                        ->subject('Appointment Reminder');
            });
            $appointment->rappel="1";
            $appointment->save();
        }
    }
}
