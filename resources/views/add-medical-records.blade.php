@extends('theme')
@section('content')

<style>
   <style>.dataTables_filter {
      display: none;
   }

   .paginate_button{

border-color: #c6c9c8 !important;


}




.dataTables_wrapper .dataTables_paginate .paginate_button{

color :#585c5b !important ;
margin-top: 13px !important;
 margin-bottom: 13px !important ;
}
.current{
background-color: #009688 ! important;

}

.dataTables_wrapper .dataTables_paginate .paginate_button:hover {

background :#009688 !important ;

}


/* Media query for screens with a maximum width of 768px (typical for mobile devices) */
@media (max-width: 768px) {
    .text-right {
        margin-right: -120; /* Reset margin for smaller screens */
        text-align: center; /* Center-align the content on smaller screens */
    }
}

</style>




<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <div class="header-icon">
         <i class="fa fa-users"></i>
      </div>
      <div class="header-title">
         <h1>Patients</h1>
         <small>Patients List</small>
      </div>
   </section>
   <!-- Main content -->
   <section class="content">
      <div class="row">
         <div class="col-sm-12">
            <div class="panel panel-bd lobidrag">
               <div class="panel-heading">
                  <div class="btn-group" id="buttonexport">
                     <a href="#">
                        <h4>Patients List</h4>
                     </a>
                  </div>
               </div>
               <div class="panel-body">
                  <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->
                  <div class="btn-group">
                    
                     <button class="btn btn-exp btn-sm dropdown-toggle" data-toggle="dropdown"><i
                           class="fa fa-bars"></i> Export Table Data</button>
                     <ul class="dropdown-menu exp-drop" role="menu">
                        <li>
                           <a href="#" onclick="$('#dataTableExample1').tableExport({type:'json',escape:'false'});">
                              <img src="assets/dist/img/json.png" width="24" alt="logo"> JSON</a>
                        </li>
                        <li>
                           <a href="#"
                              onclick="$('#dataTableExample1').tableExport({type:'json',escape:'false',ignoreColumn:'[2,3]'});">
                              <img src="assets/dist/img/json.png" width="24" alt="logo"> JSON (ignoreColumn)</a>
                        </li>
                        <li><a href="#" onclick="$('#dataTableExample1').tableExport({type:'json',escape:'true'});">
                              <img src="assets/dist/img/json.png" width="24" alt="logo"> JSON (with Escape)</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="#" onclick="$('#dataTableExample1').tableExport({type:'xml',escape:'false'});">
                              <img src="assets/dist/img/xml.png" width="24" alt="logo"> XML</a>
                        </li>
                        <li><a href="#" onclick="$('#dataTableExample1').tableExport({type:'sql'});">
                              <img src="assets/dist/img/sql.png" width="24" alt="logo"> SQL</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                           <a href="#" onclick="$('#dataTableExample1').tableExport({type:'csv',escape:'false'});">
                              <img src="assets/dist/img/csv.png" width="24" alt="logo"> CSV</a>
                        </li>
                        <li>
                           <a href="#" onclick="$('#dataTableExample1').tableExport({type:'txt',escape:'false'});">
                              <img src="assets/dist/img/txt.png" width="24" alt="logo"> TXT</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                           <a href="#" onclick="$('#dataTableExample1').tableExport({type:'excel',escape:'false'});">
                              <img src="assets/dist/img/xls.png" width="24" alt="logo"> XLS</a>
                        </li>
                        <li>
                           <a href="#" onclick="$('#dataTableExample1').tableExport({type:'doc',escape:'false'});">
                              <img src="assets/dist/img/word.png" width="24" alt="logo"> Word</a>
                        </li>
                        <li>
                           <a href="#"
                              onclick="$('#dataTableExample1').tableExport({type:'powerpoint',escape:'false'});">
                              <img src="assets/dist/img/ppt.png" width="24" alt="logo"> PowerPoint</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                           <a href="#" onclick="$('#dataTableExample1').tableExport({type:'png',escape:'false'});">
                              <img src="assets/dist/img/png.png" width="24" alt="logo"> PNG</a>
                        </li>
                        <li>
                           <a href="#"
                              onclick="$('#dataTableExample1').tableExport({type:'pdf',pdfFontSize:'7',escape:'false'});">
                              <img src="assets/dist/img/pdf.png" width="24" alt="logo"> PDF</a>
                        </li>
                     </ul>
                  </div>
                  <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->


                  <div class="text-right" style="    padding-bottom: 6px;">
                     <label class="control-label">Search:</label>
                     <input type="text" id="searchInput" placeholder="Search for users..."
                        style="height: 27px;padding: 2px 2px;font-size: 13px;border-radius: 4px; border-width: 1px;">
                 </div>

                  <div class="table-responsive" id="users-table">
                     
                     <table id="clientsTable" class="table table-bordered table-striped table-hover" style=" ; margin-left: 0px;">
                        <thead >
                           <tr class="info">
                               <th>Patient Name</th>
                               <th>Patient Email</th>
                               <th>Join</th>
                               <th>Medical Records</th>
                           </tr>
                       </thead>
                       <tbody>
                           <tr>
                               <td>James</td>
                               <td>24</td>
                               <td>USA</td>
                               <td>+123456789</td>
                           </tr>
                           
                       </tbody>
                     </table>
                  </div>

                  <div id="reloadIcon" style="display: none;">
                     <i class="fa fa-refresh fa-spin"></i>
                  </div>


               </div>
            </div>
         </div>
      </div>
      <!-- customer Modal1 -->
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
                        <form class="form-horizontal" method="POST" id="addMedicalRecordForm" action="{{ route('add-medical-record') }}">
                           @csrf
                           <fieldset>
                              <input type="hidden" name="id" value="" id="updateUserId">
                              <!-- Text input-->
                              <div class="col-md-6 form-group" id="role-description" >
                                <label>Medical Condition </label>
                                <textarea id="rold-description" class="form-control" placeholder="Enter Medical Condition"
                                   name="medical_condition" rows="4" cols="50" required></textarea>
                             </div>
                             <input type="hidden" name="patient_id" value="" id="patientId">
                              <!-- Text input-->
                              <div class="col-md-6 form-group" id="role-description" >
                                <label>Prescriptions : </label>
                                <textarea id="rold-description" class="form-control" placeholder="Enter Prescriptions"
                                   name="prescriptions" rows="4" cols="50" required></textarea>
                             </div>

                              <div class="col-md-6 form-group" id="role-description" >
                                <label>Test Results : </label>
                                <textarea id="rold-description" class="form-control" placeholder="Enter Test Results"
                                   name="test_results" rows="4" cols="50" required></textarea>
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
      <!-- /.modal -->
      <!-- Modal -->
      <!-- Customer Modal2 -->
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
                        <form class="form-horizontal" method="POST" id="updateMedicalRecordForm" action="{{ route('update-medical-record') }}">
                            @csrf
                            <fieldset>
                               <input type="hidden" name="id" value="" id="updateUserId">
                               <!-- Text input-->
                               <div class="col-md-6 form-group" id="role-description" >
                                 <label>Medical Condition </label>
                                 <textarea id="rold-description" class="form-control" placeholder="Enter Medical Condition"
                                    name="medical_condition" rows="4" cols="50" required></textarea>
                              </div>
                              <input type="hidden" name="patient_id" value="" id="patientId">
                               <!-- Text input-->
                               <div class="col-md-6 form-group" id="role-description" >
                                 <label>Prescriptions : </label>
                                 <textarea id="rold-description" class="form-control" placeholder="Enter Prescriptions"
                                    name="prescriptions" rows="4" cols="50" required></textarea>
                              </div>
 
                               <div class="col-md-6 form-group" id="role-description" >
                                 <label>Test Results : </label>
                                 <textarea id="rold-description" class="form-control" placeholder="Enter Test Results"
                                    name="test_results" rows="4" cols="50" required></textarea>
                              </div>
 
                             
                               <div class="col-md-12 form-group user-form-group">
                                  <div class="pull-right">
                                     <button type="button" class="btn btn-danger btn-sm"
                                        data-dismiss="modal">Cancel</button>
                                     <button type="submit" class="btn btn-add btn-sm update-medical-record">Save</button>
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
      <!-- /.modal -->
   </section>
   <div id="paginationResults" class="table-responsive"></div>
   <!-- /.content -->
</div>
<!-- /.content-wrapper -->

@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<script>
 



function displayUsers() {
route = "{{ route('get-patients') }}";
initDataTable(route); 
}


var dataTable = null;

var dataTable = null;

function initDataTable(route) {
   if (dataTable !== null) {
        dataTable.destroy(); 
        dataTable = null;
    }
    dataTable = $('#clientsTable').DataTable({
        ajax: {
            url: route,
            dataSrc: 'data'
        },
        columns: [
            { data: 'name' },
            { data: 'email' },
            {  data: 'created_at',
            render: function(data, type, row) {
            var date = new Date(data);
            var formattedDate = date.getFullYear() + '-' + 
                           ('0' + (date.getMonth() + 1)).slice(-2) + '-' + 
                           ('0' + date.getDate()).slice(-2) + ' ' + 
                           ('0' + date.getHours()).slice(-2) + ':' + 
                           ('0' + date.getMinutes()).slice(-2);
            return formattedDate;
            }
            },
            
            { 
                data: 'id', 
                render: function(data, type, row) {
                    return '<div><button type="button" class="btn btn-add" data-toggle="modal" data-target="#customer1" data-user-id="' + data + '" ><i class="fa fa-plus"></i> Add </button>'+
                    '<button type="button" class="btn btn-add update-button" style="margin-left: 5px;" data-toggle="modal" data-target="#customer2" data-user-id="' + data + '" ><i class="fa fa-pencil"></i> Update </button>'+
                    '<a href="{{ route('patient_record_redirect', '') }}/' + data + '">Link to Medical Record</a>' +
                    '</div>';
                    
                     
                           
                }
            }
        ],
        paging: true, 
        info: false, 
        dom: '<"table-responsive"t><"pagination-container"p>', 
        pageLength: 10, 
        
        initComplete: function () {
            
            console.log(dataTable.ajax.json());
        }
    });

    $('#clientsTable').on('click', '.btn-add', function() {
        var userId = $(this).data('user-id'); 
        $('#addMedicalRecordForm input[name="patient_id"]').val(userId); 
    });

    $('#clientsTable').on('click', '.update-button', function() {
        var userId = $(this).data('user-id'); 
        $('#updateMedicalRecordForm input[name="patient_id"]').val(userId); 
    });

   
    $('#addMedicalRecordForm').submit(function(event) {
        event.preventDefault();
       
        var formData = $(this).serialize();
        
        
        $.ajax({
            type: 'POST',
            url: 'add-medical-record', 
            data: formData ,
            success: function(response) {
                toastr.options = {
                    "positionClass": "toast-top-center",
                    "progressBar": true,
                    "timeOut": 1000
                };
                toastr.success('Medical record added successfully!'); 
            },
            error: function(xhr) {
                toastr.options = {
                    "positionClass": "toast-top-center",
                    "progressBar": true,
                    "timeOut": 3000
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
            url: 'update-medical-record', 
            data: formData ,
            success: function(response) {
                toastr.options = {
                    "positionClass": "toast-top-center",
                    "progressBar": true,
                    "timeOut": 1000
                };
                toastr.success('Medical record added successfully!'); 
            },
            error: function(xhr) {
                toastr.options = {
                    "positionClass": "toast-top-center",
                    "progressBar": true,
                    "timeOut": 4000
                };
                toastr.error('No medical record to update. Please add medical record first'); 
            }
        });
        
    });


    

   
   
}


var dataTable = null; 

function setupSearchFunctionality() {
    $('#searchInput').on('input', function() {
        var searchValue = $(this).val().toLowerCase();
        $('#pagination-search').empty();

            if (dataTable === null) {
                displayUsers();
                dataTable = $('#clientsTable').DataTable();
            }
            dataTable.search(searchValue).draw();
            $('#clientsTable').show();

    });
}

$(document).ready(function() {
    setupSearchFunctionality();
    displayUsers();
      
});
</script>


   