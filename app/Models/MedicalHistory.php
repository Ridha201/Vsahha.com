<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalHistory extends Model
{
    use HasFactory;
    protected $table = 'medical_history';
    protected $fillable = [
        'record_id',
        'medical_condition',
        'test_results',
        'prescription',
        'notes',
    ];
}
