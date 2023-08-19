<?php

namespace App\Models;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class appointment extends Model
{
    use HasFactory;
    protected $fillable = ["doctor_id","patient_id","appointment_time","status"];

    public function user(){
        return $this->belongsTo(User::class,"patient_id");
    }

    public function doctor(){
        return $this->belongsTo(User::class,"doctor_id");
    }
}
