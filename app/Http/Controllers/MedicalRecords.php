<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\User;
use App\Models\MedicalRecord;


class MedicalRecords extends Controller
{
    public function getPatients()
{
    $query = User::query();
    $role = Role::where('name','=', 'patient')->first();

    $patients = $query->where('role_id', $role->id)->get();
    return response()->json([
        'data' => $patients, 
    ]);
}
    public function addMedicalRecord(Request $request)
    {
        $medicalRecord = new MedicalRecord();
        $medicalRecord->patient_id = $request->patient_id;
        $medicalRecord->medical_condition = $request->medical_condition;
        $medicalRecord->prescriptions = $request->prescriptions;
        $medicalRecord->test_results = $request->test_results;
        $medicalRecord->save();
        return response()->json(['message' => 'Medical record has been added successfully'], 200);
    }

    public function updateMedicalRecord(Request $request)
    {
        $medicalRecord = MedicalRecord::where('patient_id', $request->patient_id)->first();
        $medicalRecord->medical_condition = $request->medical_condition;
        $medicalRecord->prescriptions = $request->prescriptions;
        $medicalRecord->test_results = $request->test_results;
        $medicalRecord->save();
        return response()->json(['message' => 'Medical record has been updated successfully'], 200);
    }
}
