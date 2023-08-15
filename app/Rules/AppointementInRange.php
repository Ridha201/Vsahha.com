<?php

namespace App\Rules;

use App\Models\appointment;
use App\Models\DoctorSchedule;
use DateTime;
use Illuminate\Contracts\Validation\Rule;

class AppointementInRange implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $doctorId = request()->input('doctor_id');

        $day = date("l",strtotime($value));
        $dt = new DateTime($value);
$time = $dt->format('G:i:s');
        return DoctorSchedule::where('doctor_id', $doctorId)
            ->where('time_to', '>=', $time) 
            ->where('time_from', '<=', $time)
            ->exists();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The selected appointment time is not within the valid range.';
    }
}
