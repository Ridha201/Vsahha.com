<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class patient extends Model
{
    use HasFactory;
    protected $fillable = [
        'NotificationDate',
        'TransactionType',
        'Name',
        'Surname',
        'Gender',
        'Relationship',
        'IDPolicyNumber',
        'IDmainPolicyHolder',
        'DOB',
        'StartCoverage',
        'EndCoverage',
        'Language',
        'GroupName',
        'GroupPolicyNumber',
        'MobilePhoneNumber',
        'E_mail',
        'Address',
        'ZipCode',
        'City',
        'Country',
        'AreaName',
        // Add more fields here as needed
    ];


}
