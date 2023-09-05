<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\User;
use App\Models\MedicalRecord;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use App\Models\MedicalHistory;


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
        $patientId = Crypt::decrypt($request->patient_id);
        $medicalRecord = new MedicalRecord();
        $medicalRecord->patient_id = $patientId;
        $medicalRecord->doctor_id = $request->doctor_id;
        $medicalRecord->weight = $request->weight;
        $medicalRecord->height = $request->height;
        $medicalRecord->blood_pressure = $request->blood_pressure;
        $medicalRecord->pulse_rate = $request->pulse_rate;
        $medicalRecord->sugar_level = $request->sugar_level;
        $medicalRecord->allergy_types = $request->allergy_types;
        $medicalRecord->smoker= $request->smoker;
        $medicalRecord->alcoholic = $request->alcoholic;
        $medicalRecord->drugs= $request->drugs;
        $medicalRecord->save();
        $medicaHistory = new MedicalHistory();
        $medicaHistory->record_id = $medicalRecord->id;
        $medicaHistory->medical_condition = $request->medical_condition;
        $medicaHistory->test_results = $request->test_results;
        $medicaHistory->prescription = $request->prescriptions;
        $medicaHistory->notes = $request->notes;
        $medicaHistory->save();
        return response()->json(['message' => 'Medical record has been added successfully'], 200);
    }

    public function updateMedicalRecord(Request $request)
    {
        $patientId = Crypt::decrypt($request->patient_id);
        $medicalRecord = MedicalRecord::where('patient_id', $patientId)->where('doctor_id', $request->doctor_id)->first();
        $medicalRecord->weight = $request->weight;
        $medicalRecord->height = $request->height;
        $medicalRecord->blood_pressure = $request->blood_pressure;
        $medicalRecord->pulse_rate = $request->pulse_rate;
        $medicalRecord->sugar_level = $request->sugar_level;
        $medicalRecord->allergy_types = $request->allergy_types;
        $medicalRecord->smoker= $request->smoker;
        $medicalRecord->alcoholic = $request->alcoholic;
        $medicalRecord->drugs= $request->drugs;
        $medicalRecord->save();
        $medicaHistory = new MedicalHistory();
        $medicaHistory->record_id = $medicalRecord->id;
        $medicaHistory->medical_condition = $request->medical_condition;
        $medicaHistory->test_results = $request->test_results;
        $medicaHistory->prescription = $request->prescriptions;
        $medicaHistory->notes = $request->notes;
        $medicaHistory->save();
        return response()->json(['message' => 'Medical record has been updated successfully'], 200);
    }

    public function viewMedicalRecord($id)
    {
        
        try {
            $decryptedId = Crypt::decrypt($id);
            $patient = User::find($decryptedId);
            $medicalRecords = MedicalRecord::where('patient_id', $decryptedId)->get();
            if ($medicalRecords->isEmpty()) {
                return view ('record', ['patient' => $patient, 'medicalRecords' => $medicalRecords, 'id' => $id]);
            }
            $doctors_tab;
            foreach ($medicalRecords as $medicalRecord) {
                $doctor = User::find($medicalRecord->doctor_id);
                $doctors_tab[$medicalRecord->doctor_id] = $doctor;
            }
            $latestMedicalRecord = MedicalRecord::where('patient_id', $decryptedId)->latest()->first();
        } catch (DecryptException $e) {
            return response()->json(['message' => 'Invalid patient id'], 400);
        }
    
        return view('record', ['patient' => $patient, 'medicalRecords' => $medicalRecords, 'id' => $id, 'doctors_tab' => $doctors_tab , 'latestMedicalRecord' => $latestMedicalRecord]);
    }

    public function deleteRecord(Request $request)
    {
        $patient_id = Crypt::decrypt($request->patient_id);
        $medicalRecord = MedicalRecord::where('patient_id', $patient_id)->where('doctor_id', $request->doctor_id)->first();
        $medicalRecord->delete();
        return response()->json(['message' => 'Deleting...'], 200);
    }

    public function getMedicalHistory(Request $request)
    {
        $id = $request->input('id'); // Get the 'id' parameter from the request
        $medicalHistory = MedicalHistory::where('record_id', $id)->get();
        
        return response()->json(['data' => $medicalHistory], 200);
    }
  

}