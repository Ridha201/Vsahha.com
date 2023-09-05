@extends('theme')
@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
   integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg=="
   crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
   /*--- Component: Table ---*/
   .contact-info table {
      table-layout: fixed;
      width: 100%;
   }

   .contact-info th,
   .contact-info td {
      padding: 8px;
      border: 1px solid #ddd;
      word-wrap: break-word;
      white-space: normal;
   }


   .patient-info-list {
      list-style: none;
      padding: 0;
      margin: 0;
      padding-left: 13px;
   }

   .patient-info-list li {
      margin-bottom: 8px;
      line-height: 2.2;
   }

   .patient-info-list li i {
      margin-right: 8px;
      color: #337ab7;
      /* Adjust the color as needed */
   }
</style>

<!-- Mirrored from thememinister.com/crm/message.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 10 Aug 2023 11:58:28 GMT -->

<!-- =============================================== -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
   <!-- Main content -->
   <section class="content">
      <div class="row">
         <div class="col-sm-12">
            <div class="mailbox">
               <div class="mailbox-header">
                  <div class="row">
                     <div class="col-xs-4">
                        <div class="inbox-avatar">
                           <i class="fa fa-user-circle fa-lg"></i>
                           <div class="inbox-avatar-text hidden-xs hidden-sm">
                              <div class="avatar-name">{{$patient->name}}</div>
                              <div><small>Insurance Number : {{$patient->insurance_number}}</small></div>
                           </div>
                        </div>
                     </div>

                  </div>
               </div>
               <div class="mailbox-body">
                  <div class="row m-0">
                     <div class="col-sm-3 p-0 inbox-nav hidden-xs hidden-sm">
                        <div class="mailbox-sideber">
                           <div class="profile-usermenu">
                              <h6>Latest Global Informations</h6>
                              <ul class="patient-info-list">
                                 <li><strong><i class="fas fa-envelope"></i>Email :</strong> {{$patient->email}}</li>
                                 <li><strong><i class="fas fa-phone-alt"></i>Phone Number :</strong> {{$patient->phone}}
                                 </li>
                                 <li><strong><i class="fas fa-calendar"></i>Birthdate :</strong> {{$patient->birthdate}}
                                 </li>
                                 <li><strong><i class="fas fa-mars"></i>Gender :</strong> {{$patient->gender}}</li>
                                 @if(count($medicalRecords) != 0)
                                 @if($latestMedicalRecord->allergy_types != null)
                                 <li><strong><i class="fas fa-allergies"></i>Allergy Types :</strong>
                                    {{$latestMedicalRecord->allergy_types}}</li>
                                 @endif
                                 @if($latestMedicalRecord->weight != null)
                                 <li><strong><i class="fas fa-weight"></i>Weight :</strong>
                                    {{$latestMedicalRecord->weight}}KG</li>
                                 @endif
                                 @if($latestMedicalRecord->height != null)
                                 <li><strong><i class="fas fa-ruler-combined"></i>Height :</strong>
                                    {{$latestMedicalRecord->height}}CM</li>
                                 @endif

                                 @php
                                 $heightInMeters = $latestMedicalRecord->height / 100; // Convert height to meters
                                 $bmi = $latestMedicalRecord->weight / ($heightInMeters * $heightInMeters);
                                 @endphp

                                 <li><strong><i class="fas fa-tachometer-alt"></i>BMI Level :</strong>
                                    {{number_format($bmi, 1) }}</li>
                                 @if($latestMedicalRecord->blood_pressure != null)
                                 <li><strong><i class="fas fa-tint"></i>Blood Pressure :</strong>
                                    {{$latestMedicalRecord->blood_pressure}}mm Hg</li>
                                 @endif
                                 @if($latestMedicalRecord->sugar_level != null)
                                 <li><strong><i class="fas fa-chart-line"></i>Blood Sugar Levels (Glucose) :</strong>
                                    {{$latestMedicalRecord->sugar_level}}mg/dL</li>
                                 @endif
                                 @if($latestMedicalRecord->pulse_rate != null)
                                 <li><strong><i class="fas fa-heartbeat"></i>Pulse Rate :</strong>
                                    {{$latestMedicalRecord->pulse_rate }}bmp</li>
                                 @endif
                                 @if($latestMedicalRecord->smoker != null)
                                 <li><strong><i class="fa-solid fa-smoking"></i>Smoker :</strong>
                                    {{$latestMedicalRecord->smoker}}</li>
                                 @endif
                                 @if($latestMedicalRecord->alcoholic != null)
                                 <li><strong><i class="fa-solid fa-wine-bottle"></i>Alcoholic :</strong>
                                    {{$latestMedicalRecord->alcoholic}}</li>
                                 @endif

                                 @if($latestMedicalRecord->drugs != null)
                                 <li><strong><i class="fa-solid fa-syringe"></i>Drugs :</strong>
                                    {{$latestMedicalRecord->drugs}}</li>
                                 @endif
                                 @endif


                              </ul>
                              <hr>
                           </div>
                        </div>
                     </div>
                     <div class="col-xs-12 col-sm-12 col-md-9 p-0 inbox-mail">

                        <div class="table-responsive" id="users-table">

                           <table id="clientsTable" class="table table-bordered table-striped table-hover"
                              style=" ; margin-left: 0px;">
                              <thead>
                                 <tr class="info">
                                    <th>Record Title</th>
                                    <th>Doctor</th>
                                    <th>Doctor Email</th>
                                    <th>Doctor Phone Number</th>
                                    <th>Date Consulted</th>
                                    <th>Action </th>

                                 </tr>
                              </thead>
                              <tbody>
                                 @if(count($medicalRecords) != 0)
                                 @php
                                 $userFound = false;
                                 @endphp
                                 @foreach ($medicalRecords as $medicalRecord)
                                 <tr>
                                    @if($medicalRecord->doctor_id == Auth::user()->id)
                                    @php
                                    $userFound = true;
                                    @endphp
                                    @endif
                                    <td>Record {{ $medicalRecord->id }}</td>
                                    <td>{{ $doctors_tab[$medicalRecord->doctor_id]->name }}</td>
                                    <td>{{ $doctors_tab[$medicalRecord->doctor_id]->email }}</td>
                                    <td> +21624259326</td>
                                    <td>{{ $medicalRecord->updated_at }}</td>
                                    <td>
                                       @if($medicalRecord->doctor_id == Auth::user()->id)
                                       <div class="hidden-xs hidden-sm btn-group">
                                          <button type="button" class="btn btn-add" data-toggle="modal"
                                             data-target="#customer2">
                                             <span class="fa fa-pencil"></span>
                                          </button>
                                       </div>
                                       <div class="hidden-xs hidden-sm btn-group">
                                          <button type="button" class="btn btn-danger" data-toggle="modal"
                                             data-target="#delete-modal">
                                             <span class="fa fa-trash"></span>
                                          </button>
                                       </div>
                                       <div class="hidden-xs hidden-sm btn-group">
                                          <button type="button" class="btn btn-warning" data-toggle="modal"
                                             data-target="#record-modal" data-medical-record="{{ $medicalRecord }}"
                                             data-doctor-name="{{ $doctors_tab[$medicalRecord->doctor_id]->name }}"
                                             data-patient-record="{{ $patient }}">

                                             <span class="fa fa-eye"></span>
                                          </button>
                                       </div>
                                       @else
                                       <div class="hidden-xs hidden-sm btn-group">
                                          <button type="button" class="btn btn-warning" data-toggle="modal"
                                             data-target="#record-modal" data-medical-record="{{ $medicalRecord }}"
                                             data-doctor-name="{{ $doctors_tab[$medicalRecord->doctor_id]->name }}"
                                             data-patient-record="{{ $patient }}">

                                             <span class="fa fa-eye"></span>
                                          </button>
                                       </div>
                                       @endif
                                    </td>
                                 </tr>
                                 @endforeach
                                 @if($userFound == false)
                                 <tr>
                                    <td colspan="6"
                                       style="text-align: center; font-weight:bold ;color:rgb(128, 128, 128)">Add A
                                       Record For This Patient &nbsp <button type="button" class="btn btn-add"
                                          data-toggle="modal" data-target="#customer1"><span
                                             class="fa fa-plus"></span></button></td>
                                 </tr>
                                 @endif
                                 @else
                                 <tr>
                                    <td colspan="6" style="text-align: center;">No Medical Records Found. Add A
                                       Record For This Patient &nbsp <button type="button" class="btn btn-add"
                                          data-toggle="modal" data-target="#customer1"><span
                                             class="fa fa-plus"></span></button>
                                    </td>
                                 </tr>
                                 @endif
                              </tbody>
                           </table>
                        </div>

                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>

      <div class="modal fade" id="customer1" tabindex="-1" role="dialog" aria-hidden="true">
         <div class="modal-dialog">
            <div class="modal-content">
               <div class="modal-header modal-header-primary">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                  <h3><i class="fa fa-user m-r-5"></i> Add Medical Record </h3>
               </div>
               <div class="modal-body">
                  <div class="row">
                     <div class="col-md-12">
                        <form class="form-horizontal" method="POST" id="addMedicalRecordForm"
                           action="{{ route('add-medical-record') }}">
                           @csrf
                           <fieldset>
                              <input type="hidden" id="patient_id" name="patient_id" value="{{$id}}">
                              <input type="hidden" id="doctor_id" name="doctor_id" value="{{Auth::user()->id}}">
                              <div class="col-md-4 form-group" style="width: 34.8%;">
                                 <label>Weight</label>
                                 <input type="number" class="form-control" required name="weight">
                              </div>
                              <div class="col-md-4 form-group" style="width: 34.8%;">
                                 <label>Height</label>
                                 <input type="number" class="form-control" required name="height">
                              </div>
                              <div class="col-md-4 form-group" style="width: 34.8%;">
                                 <label>Blood Pressure</label>
                                 <input type="number" class="form-control" required name="blood_pressure">
                              </div>
                              <div class="col-md-4 form-group" style="width: 34.8%;">
                                 <label>Pulse Rate</label>
                                 <input type="number" class="form-control" required name="pulse_rate">
                              </div>
                              <div class="col-md-4 form-group" style="width: 34.8%;">
                                 <label>Sugar Level</label>
                                 <input type="number" class="form-control" required name="sugar_level">
                              </div>
                              <div class="col-md-4 form-group" style="width: 34.8%;">
                                 <label>Allergy Types</label>
                                 <input type="text" class="form-control" required name="allergy_types">
                              </div>

                             

                              <!-- Text input-->
                              <div class="col-md-6 form-group" id="role-description">
                                 <label>Medical Condition </label>
                                 <textarea id="rold-description" class="form-control"
                                    placeholder="Enter Medical Condition" name="medical_condition" rows="4" cols="50"
                                    required></textarea>
                              </div>

                              <!-- Text input-->
                              <div class="col-md-6 form-group" id="role-description">
                                 <label>Test Results : </label>
                                 <textarea id="rold-description" class="form-control" placeholder="Enter Test Results"
                                    name="test_results" rows="4" cols="50" required></textarea>
                              </div>
                              <div class="col-md-6 form-group" id="role-description">
                                 <label>Prescriptions : </label>
                                 <textarea id="rold-description" class="form-control" placeholder="Enter Prescriptions"
                                    name="prescriptions" rows="4" cols="50" required></textarea>
                              </div>
                              <div class="col-md-6 form-group" id="role-description">
                                 <label>Your Notes : </label>
                                 <textarea id="rold-description" class="form-control" placeholder="Enter Notes"
                                    name="notes" rows="4" cols="50" required></textarea>
                              </div>

                              <div class="col-md-4 form-group" style="width: 34.8%;">
                                 <label>Smoker</label>
                                 <div class="form-check">
                                     <input class="form-check-input" type="radio" name="smoker" id="smokerYes" value="Yes" required>
                                     <label class="form-check-label" for="smokerYes">
                                         Yes
                                     </label>
                                 </div>
                                 <div class="form-check">
                                     <input class="form-check-input" type="radio" name="smoker" id="smokerNo" value="No" required>
                                     <label class="form-check-label" for="smokerNo">
                                         No
                                     </label>
                                 </div>
                             </div>
                             <div class="col-md-4 form-group" style="width: 34.8%;">
                              <label>Alcoholic</label>
                              <div class="form-check">
                                  <input class="form-check-input" type="radio" name="alcoholic" id="alcoholicYes" value="Yes" required>
                                  <label class="form-check-label" for="alcoholicYes">
                                      Yes
                                  </label>
                              </div>
                              <div class="form-check">
                                  <input class="form-check-input" type="radio" name="alcoholic" id="alcoholicNo" value="No" required>
                                  <label class="form-check-label" for="alcoholicNo">
                                      No
                                  </label>
                              </div>
                          </div>

                          <div class="col-md-4 form-group" style="width: 34.8%;">
                           <label>Drugs</label>
                           <div class="form-check">
                               <input class="form-check-input" type="radio" name="drugs" id="drugsYes" value="Yes" required>
                               <label class="form-check-label" for="drugsYes">
                                   Yes
                               </label>
                           </div>
                           <div class="form-check">
                               <input class="form-check-input" type="radio" name="drugs" id="drugsNo" value="No" required>
                               <label class="form-check-label" for="drugsNo">
                                   No
                               </label>
                           </div>
                       </div>




                              <div class="col-md-12 form-group user-form-group">
                                 <div class="pull-right">
                                    <button type="button" class="btn btn-danger btn-sm"
                                       data-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-add btn-sm add-medical-record">Save</button>
                                 </div>
                              </div>
                           </fieldset>
                        </form>
                     </div>
                  </div>
               </div>

            </div>
            <!-- /.modal-content -->
         </div>
         <!-- /.modal-dialog -->
      </div>

      <div class="modal fade" id="record-modal" tabindex="-1" role="dialog" aria-labelledby="record-modal-label"
         aria-hidden="true">
         <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <!-- Add "modal-lg" class here -->
            <div class="modal-content">
               <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                  </button>
                  <div class="d-flex align-items-center">
                     <img src="/assets/dist/img/vss.png" alt="medical record" width="50px" height="50px">
                     <h5 class="ml-2" id="record-modal-label" style="margin-left: 57px; margin-top: -30px;">Medical
                        Record Details</h5>
                  </div>
               </div>
               <div class="modal-body">
                  <!-- Display medical record information here -->
                  <!-- You can use JavaScript to populate the information based on the clicked record -->
                  <p><i class="fa fa-user"></i> Patient : <span id="record-id"></span></p>
                  <p><i class="fa fa-user-md"></i> Doctor : <span id="record-doctor"></span></p>
                  <p style="margin-left: 668px; margin-top: -35px;"><i class="fa fa-calendar"></i> Date : <span id="record-date"></span></p>

                  <div class="table-responsive">
                     <table class="table table-bordered  contact-info ">
                        <thead>

                           <th colspan="3" style="text-align: center; background-color:#009688">Global Informations</th>

                        </thead>


                        <tr>
                           <td style="background-color: rgb(185, 185, 185)">
                              <p ><i class="fas fa-envelope"></i> Email </p>
                           </td>

                           <td style="background-color: rgb(185, 185, 185)">
                              <p ><i class="fas fa-phone"></i> Phone Number </p>
                           </td>
                          
                           <td style="background-color: rgb(185, 185, 185)">
                              <p ><i class="fas fa-calendar"></i> Bithdate </p>
                           </td>
                        </tr>

                        <tr>
                           <td>
                              <p id="patient-email"></p>
                           </td>

                           <td>
                              <p id="patient-phone"></p>
                           </td>
                          
                           <td>
                              <p id="patient-birthdate"></p>
                           </td>
                        </tr>
                        <tr>
                           <td style="background-color: rgb(185, 185, 185)">
                              <p ><i class="fas fa-male"></i> Gender </p>
                           </td>
                           
                           <td style="background-color: rgb(185, 185, 185)">
                              <p ><i class="fa fa-id-badge"></i> Insurance Number </p>
                           </td>
                        </tr>
                        
                        <tr>
                           <td>
                              <p id="patient-gender"></p>
                           </td>
                           
                           <td >
                              <p id="patient-insurance"></p>
                           </td>
                        </tr>

                     </table>

                     <table class="table table-bordered contact-info" >
                        <thead>

                           <th colspan="5" style="text-align: center; background-color:#009688">Medical Informations
                           </th>

                        </thead>
                        <tbody>

                           <tr>
                              <td style="background-color: rgb(185, 185, 185)">
                                 <p><i class="fas fa-weight"></i> Weight </p>
                              </td>
                              <td style="background-color: rgb(185, 185, 185)">
                                 <p><i class="fas fa-ruler-combined"></i> Height  </p>
                              </td>
                              
                              <td style="background-color: rgb(185, 185, 185)">
                                 <p><i class="fas fa-tachometer-alt"></i> BMI Level </p>
                              </td>

                              <td style="background-color: rgb(185, 185, 185)">
                                 <p ><i class="fas fa-tint"></i> Blood Pressure </p>
                              </td>

                              <td style="background-color: rgb(185, 185, 185)">
                                 <p><i class="fas fa-heartbeat"></i> Pulse Rate </p>
                              </td>
                              
                           </tr>

                           <tr>
                              <td >
                                 <p id="patient-weight"></p>
                              </td>
                              <td >
                                 <p id="patient-height"></p>
                              </td>
                              
                              <td >
                                 <p id="patient-bmi"></p>
                              </td>

                              <td >
                                 <p id="patient-pressure"></p>
                              </td>

                              <td >
                                 <p id="patient-pulse"></p>
                              </td>
                           </tr>

                           <tr>
                              <td style="background-color: rgb(185, 185, 185)">
                                 <p ><i class="fas fa-chart-line"></i>  Glucose </p>
                              </td>
                              <td style="background-color: rgb(185, 185, 185)">
                                 <p><i class="fas fa-allergies"></i> Allergy Types</p>
                              </td>
                              <td style="background-color: rgb(185, 185, 185)">
                                 <p><i class="fa-solid fa-smoking"></i> Smoker </p>
                              </td>
                              <td style="background-color: rgb(185, 185, 185)">
                                 <p><i class="fa-solid fa-wine-bottle"></i> Alcoholic </p>
                              </td>
                              <td style="background-color: rgb(185, 185, 185)">
                                 <p><i class="fa-solid fa-syringe"></i> Drugs </p>
                              </td>

                           </tr>




                           <tr>
                              <td>
                                 <p id="patient-sugar"></p>
                              </td>
                              <td >
                                 <p id="patient-allergy"></p>
                              </td>
                              <td >
                                 <p id="patient-smoker"></p>
                              </td>
                              <td >
                                 <p id="patient-alcoholic"></p>
                              </td>
                              <td >
                                 <p id="patient-drugs"></p>
                              </td>
                           </tr>
                           
                        </tbody>
                     </table>
                  </div>

                  <table class="table table-bordered contact-info " style=" table-layout: fixed;" id="medical-history-table">
                    
                  </table>
                 




                  <!-- Add other fields as needed -->
               </div>
               <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button id="printPdfButton">Print PDF</button>
               </div>
            </div>
         </div>
      </div>
      <div class="modal fade" id="customer2" tabindex="-1" role="dialog" aria-hidden="true">
         <div class="modal-dialog">
            <div class="modal-content">
               <div class="modal-header modal-header-primary">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                  <h3><i class="fa fa-user m-r-5"></i> Update Medical Record</h3>
               </div>
               <div class="modal-body delete-modal">
                  <div class="row">
                     <div class="col-md-12">
                        <form class="form-horizontal" method="POST" id="updateMedicalRecordForm"
                           action="{{ route('add-medical-record') }}">
                           @csrf
                           <fieldset>
                              <input type="hidden" name="patient_id" value="{{$id}}">
                              <input type="hidden" name="doctor_id" value="{{Auth::user()->id}}">
                              <div class="col-md-4 form-group" style="width: 34.8%;">
                                 <label>Weight</label>
                                 <input type="number" class="form-control" required name="weight">
                              </div>
                              <div class="col-md-4 form-group" style="width: 34.8%;">
                                 <label>Height</label>
                                 <input type="number" class="form-control" required name="height">
                              </div>
                              <div class="col-md-4 form-group" style="width: 34.8%;">
                                 <label>Blood Pressure</label>
                                 <input type="number" class="form-control" required name="blood_pressure">
                              </div>
                              <div class="col-md-4 form-group" style="width: 34.8%;">
                                 <label>Pulse Rate</label>
                                 <input type="number" class="form-control" required name="pulse_rate">
                              </div>
                              <div class="col-md-4 form-group" style="width: 34.8%;">
                                 <label>Sugar Level</label>
                                 <input type="number" class="form-control" required name="sugar_level">
                              </div>
                              <div class="col-md-4 form-group" style="width: 34.8%;">
                                 <label>Allergy Types</label>
                                 <input type="text" class="form-control" required name="allergy_types">
                              </div>

                              <div class="col-md-4 form-group" style="width: 34.8%;">
                                 <label>Smoker</label>
                                 <div class="form-check">
                                     <input class="form-check-input" type="radio" name="smoker" id="smokerYes" value="Yes" required>
                                     <label class="form-check-label" for="smokerYes">
                                         Yes
                                     </label>
                                 </div>
                                 <div class="form-check">
                                     <input class="form-check-input" type="radio" name="smoker" id="smokerNo" value="No" required>
                                     <label class="form-check-label" for="smokerNo">
                                         No
                                     </label>
                                 </div>
                             </div>
                             <div class="col-md-4 form-group" style="width: 34.8%;">
                              <label>Alcoholic</label>
                              <div class="form-check">
                                  <input class="form-check-input" type="radio" name="alcoholic" id="alcoholicYes" value="Yes" required>
                                  <label class="form-check-label" for="alcoholicYes">
                                      Yes
                                  </label>
                              </div>
                              <div class="form-check">
                                  <input class="form-check-input" type="radio" name="alcoholic" id="alcoholicNo" value="No" required>
                                  <label class="form-check-label" for="alcoholicNo">
                                      No
                                  </label>
                              </div>
                          </div>

                          <div class="col-md-4 form-group" style="width: 34.8%;">
                           <label>Drugs</label>
                           <div class="form-check">
                               <input class="form-check-input" type="radio" name="drugs" id="drugsYes" value="Yes" required>
                               <label class="form-check-label" for="drugsYes">
                                   Yes
                               </label>
                           </div>
                           <div class="form-check">
                               <input class="form-check-input" type="radio" name="drugs" id="drugsNo" value="No" required>
                               <label class="form-check-label" for="drugsNo">
                                   No
                               </label>
                           </div>
                       </div>


                            

                              <!-- Text input-->
                              <div class="col-md-6 form-group" id="role-description">
                                 <label>Medical Condition </label>
                                 <textarea id="rold-description" class="form-control"
                                    placeholder="Enter Medical Condition" name="medical_condition" rows="4" cols="50"
                                    required></textarea>
                              </div>

                              <!-- Text input-->
                              <div class="col-md-6 form-group" id="role-description">
                                 <label>Test Results : </label>
                                 <textarea id="rold-description" class="form-control" placeholder="Enter Test Results"
                                    name="test_results" rows="4" cols="50" required></textarea>
                              </div>
                              <div class="col-md-6 form-group" id="role-description">
                                 <label>Prescriptions : </label>
                                 <textarea id="rold-description" class="form-control" placeholder="Enter Prescriptions"
                                    name="prescriptions" rows="4" cols="50" required></textarea>
                              </div>
                              <div class="col-md-6 form-group" id="role-description">
                                 <label>Your Notes : </label>
                                 <textarea id="rold-description" class="form-control" placeholder="Enter Notes"
                                    name="notes" rows="4" cols="50" required></textarea>
                              </div>

                              <div class="col-md-12 form-group user-form-group">
                                 <div class="pull-right">
                                    <button type="button" class="btn btn-danger btn-sm"
                                       data-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-add btn-sm add-medical-record">Save</button>
                                 </div>
                              </div>
                           </fieldset>
                        </form>
                     </div>
                  </div>
               </div>

            </div>
            <!-- /.modal-content -->
         </div>
         <!-- /.modal-dialog -->
      </div>
      <div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-hidden="true">
         <div class="modal-dialog">
            <div class="modal-content">
               <div class="modal-header modal-header-primary">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                  <h3><i class="fa fa-user m-r-5"></i> Delete Record</h3>
               </div>
               <div class="modal-body delete-modal">
                  <div class="row">
                     <div class="col-md-12">
                        <form class="form-horizontal " id="delete-form" method="POST">
                           <fieldset>
                              <div class="col-md-12 form-group user-form-group">
                                 <label class="control-label">Are you sure you want to delete this record ?</label>
                                 <input type="hidden" id="patient_id" name="patient_id" value="{{$id}}">
                                 <input type="hidden" id="doctor_id" name="doctor_id" value="{{Auth::user()->id}}">
                                 <div class="pull-right">
                                    <button type="button" data-dismiss="modal" class="btn btn-danger btn-sm">NO</button>
                                    <button type="submit" class="btn btn-add btn-sm delete-record">YES</button>
                                 </div>
                              </div>
                           </fieldset>
                        </form>
                     </div>
                  </div>
               </div>

            </div>
            <!-- /.modal-content -->
         </div>
         <!-- /.modal-dialog -->
      </div>
   </section>
   <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

<script>
$(document).ready(function() {
    $(document).on('click', '#printPdfButton', function() {
        const modalContent = document.getElementById('record-modal').innerHTML;
        console.log('Modal Content:', modalContent);

        $.ajaxSetup({
             headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
         });

        $.ajax({
            url: '/generate-pdf',
            type: 'POST',
            data: {
                modalContent: modalContent
            },
            success: function(response) {
                console.log('PDF Generated:', response);
            },
            error: function(xhr) {
                console.error('Error:', xhr.responseText);
            }
        });
    });
});
</script>









<script>
   $(document).ready(function() {
    $('#addMedicalRecordForm').submit(function(event) {
        event.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
            type: 'POST',
            url: '/add-medical-record', 
            data: formData ,
            dataType: 'json',
            success: function(response) {
                toastr.options = {
                    "positionClass": "toast-top-center",
                    "progressBar": true,
                    "timeOut": 1000
                };
                toastr.success(response.message); 
                setTimeout(() => {
                  document.location.reload();
                  }, 1100);

 
            },
            error: function(xhr) {
                toastr.options = {
                    "positionClass": "toast-top-center",
                    "progressBar": true,
                    "timeOut": 1000
                };
                toastr.error('Medical record Already Exists'); 
                
            }
        }); 
    });

    $('#updateMedicalRecordForm').submit(function(event) {
        event.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
            type: 'POST',
            url: '/update-medical-record', 
            data: formData ,
            dataType: 'json',
            success: function(response) {
                toastr.options = {
                    "positionClass": "toast-top-center",
                    "progressBar": true,
                    "timeOut": 1000
                };
                toastr.success(response.message); 
                setTimeout(() => {
                  document.location.reload();
                  }, 1100);
            },
            error: function(xhr) {
                toastr.options = {
                    "positionClass": "toast-top-center",
                    "progressBar": true,
                    "timeOut": 3000
                };
                toastr.error('No medical record to update. Please add medical record first'); 
            }
        }); 
    });

      $('#delete-form').submit(function(event) {
         event.preventDefault();
         var formData = $(this).serialize();
        
      
         $.ajaxSetup({
             headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
         });
         
         $.ajax({
               type: 'POST',
               url: '/delete-medical-record', 
               data: formData ,
               dataType: 'json',
               success: function(response) {
                  toastr.options = {
                     "positionClass": "toast-top-center",
                     "progressBar": true,
                     "timeOut": 800
                  };
                  toastr.success(response.message); 
                  setTimeout(() => {
                  document.location.reload();
                  }, 1000);
                  
               },
               error: function(xhr) {
                  toastr.options = {
                     "positionClass": "toast-top-center",
                     "progressBar": true,
                     "timeOut": 3000
                  };
                  toastr.error('No medical record to delete. Please add medical record first'); 
               }
         }); 
      });

      $('#record-modal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var recordId = button.data('medical-record');
        var recordDoctor = button.data('doctor-name');
        var recordPatient = button.data('patient-record');

        var modal = $(this);
        modal.find('#record-id').text(recordPatient.name);
        modal.find('#record-doctor').text(recordDoctor);
        var updatedAt = new Date(recordId.updated_at);
        var formattedDate = updatedAt.toLocaleString('en-US', {
        year: 'numeric',
        month: '2-digit',
        day: '2-digit',
        hour: '2-digit',
        minute: '2-digit'
        });

        modal.find('#record-date').text(formattedDate);
        modal.find('#patient-email').html('<span> ' + recordPatient.email + '</span>  ' );
        modal.find('#patient-phone').html('<span> ' + recordPatient.phone + '</span> ');
        modal.find('#patient-birthdate').html('<span> ' + recordPatient.birthdate + '</span>  ');
        modal.find('#patient-gender').html('<span> ' + recordPatient.gender + '</span> ');
        modal.find('#patient-insurance').html('<span> ' + recordPatient.insurance_number + '</span> ');
        modal.find('#patient-weight').html('<span> ' + recordId.weight + ' KG</span> ');
        modal.find('#patient-height').html('<span> ' + recordId.height + ' CM</span> ');
        var weight = recordId.weight;
        var height = recordId.height / 100; 
        var bmi = (weight / (height * height)).toFixed(2); 

        modal.find('#patient-bmi').html('<span> ' + bmi + '</span> ');
        modal.find('#patient-pressure').html('<span> ' + recordId.blood_pressure + 'mmHg</span> ');
        modal.find('#patient-pulse').html('<span> ' + recordId.pulse_rate + 'bmp</span> ');
        modal.find('#patient-sugar').html('<span> ' + recordId.sugar_level + 'mg/dL</span> ');
        modal.find('#patient-allergy').html('<span> ' + recordId.allergy_types + '</span> ');
        modal.find('#patient-smoker').html('<span> ' + recordId.smoker + '</span> ');
        modal.find('#patient-alcoholic').html('<span> ' + recordId.alcoholic + '</span> ');
        modal.find('#patient-drugs').html('<span> ' + recordId.drugs + '</span> ');

        


 $.ajax({
    type: 'GET',
    url: '/get-medical-history', 
    data: {id : recordId.id}, // Sending the id as an object property
    dataType: 'json',
    success: function(response) {
      
      var table = $('#medical-history-table');
      table.empty();
      var thead = $('<thead><th colspan="4" style="text-align: center; background-color:#009688">Medical History</th></thead>');
var tbody = $('<tbody>');
var headerRow = $('<tr>');
headerRow.append('<td style="background-color: rgb(185, 185, 185)"><i class="fas fa-file-medical-alt"></i> Medical Condition</td>');
headerRow.append('<td style="background-color: rgb(185, 185, 185)"><i class="fas fa-file-medical"></i> Test Results</td>');
headerRow.append('<td style="background-color: rgb(185, 185, 185)"><i class="fas fa-prescription-bottle-alt"></i> Prescriptions</td>');
headerRow.append('<td style="background-color: rgb(185, 185, 185)"><i class="fas fa-sticky-note"></i> Doctor Notes</td>');
thead.append(headerRow);

table.append(thead);
table.append(tbody);


for (var i = 0; i < response.data.length; i++) {
    var medicalHistory = response.data[i];
    var medicalCondition = medicalHistory.medical_condition;
    var testResults = medicalHistory.test_results;
    var prescriptions = medicalHistory.prescription;
    var notes = medicalHistory.notes;

    var newRow = $('<tr>');
    newRow.append('<td>' + medicalCondition + '</td>');
    newRow.append('<td>' + testResults + '</td>');
    newRow.append('<td>' + prescriptions + '</td>');
    newRow.append('<td>' + notes + '</td>');
    table.append(newRow);
}
    },
    error: function(xhr) {
        // Handle error
    }
});
  
        
    });




});


    
    




</script>