<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicalRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medical_records', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('patient_id');
            $table->string('doctor_id')->unique();
            $table->string('blood_pressure')->nullable();
            $table->string('sugar_level')->nullable();
            $table->string('pulse_rate')->nullable();
            $table->string('weight')->nullable();
            $table->string('height')->nullable();
            $table->string('allergy_types')->nullable();
            $table->string('smoker')->nullable();
            $table->string('alcoholic')->nullable();
            $table->string('drugs')->nullable();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('medical_records');
    }
}
