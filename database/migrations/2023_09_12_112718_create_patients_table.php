<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->date('NotificationDate')->nullable();
            $table->string('TransactionType')->nullable();
            $table->string('Name')->nullable();
            $table->string('Surname')->nullable();
            $table->string('Gender')->nullable();
            $table->string('Relationship')->nullable();
            $table->string('IDPolicyNumber')->nullable();
            $table->string('IDmainPolicyHolder')->nullable();
            $table->date('DOB')->nullable();
            $table->date('StartCoverage')->nullable();
            $table->date('EndCoverage')->nullable();
            $table->string('Language')->nullable();
            $table->string('GroupName')->nullable();
            $table->string('GroupPolicyNumber')->nullable();
            $table->string('MobilePhoneNumber')->nullable();
            $table->string('E-mail')->nullable();
            $table->string('Address')->nullable();
            $table->string('ZipCode')->nullable();
            $table->string('City')->nullable();
            $table->string('Country')->nullable();
            $table->string('AreaName')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patients');
    }
}
