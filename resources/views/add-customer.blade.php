@extends('theme')
@section('content')
<style>
   .image-container {
      padding-left: 150px;  
      padding-top: 40px
   }

   .image-container img {

      
       
   }
</style>
<!-- =============================================== -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <div class="header-icon">
         <i class="fa fa-users"></i>
      </div>
      <div class="header-title">
         <h1>Users</h1>
         <small>Add User</small>
      </div>
   </section>
   <!-- Main content -->
   <section class="content">
      <div class="row">
         <!-- Form controls -->
         <div class="col-sm-12">
            <div class="panel panel-bd lobidrag">
               <div class="panel-heading">
                  <div class="btn-group" id="buttonlist">
                     <a class="btn btn-add " href="{{route('customerslist')}}">
                        <i class="fa fa-list"></i> Users List </a>
                  </div>
                  <form class="form-control" action="{{route('addUsersWithCsv')}}" method="POST" enctype="multipart/form-data">
                     @csrf

                        <input type="file" class="search form-control" placeholder="What you looking for?" name="csv_file">
                        <button type="submit" class="btn btn-success">Import</button>
                       
                     

                  </form>
                 
                  
               </div>
               
               <div class="panel-body">
                  <form class="col-sm-6" method="POST" action="{{ route('add-customer') }}" id="addCustomerForm">
                     @csrf
                     <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" placeholder="Enter First Name" required name="name">
                     </div>

                     <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" placeholder="Enter Email" required name="email">
                     </div>

                     <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" placeholder="Enter Password" required
                           name="password">
                     </div>
                     <div class="form-group">
                        <label>Role</label>
                        <select class="form-control" name="role" id="roleSelect">
                           <option value="">Select A Role</option>
                           @foreach($roles as $role)
                           <option value="{{$role->name}}">{{$role->name}}</option>

                           @endforeach
                           <option value="New Role">New Role</option> <!-- Add the new option -->

                        </select>
                     </div>
                     <div class="form-group" id="phone" style="display: none;">
                        <label>Phone number </label>
                        <input type="text" class="form-control" name="phone">
                     </div>

                     <div class="form-group" id="birthdate" style="display: none;">
                        <label>Birthdate </label>
                        <input type="date" class="form-control" name="birthdate">
                     </div>

                     <div class="form-group" id="insurance_number" style="display: none;">
                        <label>Insurance Number </label>
                        <input type="text" class="form-control" name="insurance_number">
                     </div>
                     
                     <div class="form-group" id="gender" style="display: none;">
                        <label>Gender </label>
                        <input type="text" class="form-control" name="gender">
                     </div>

                     <div class="form-group" id="newRoleInput" style="display: none;">
                        <label>New Role</label>
                        <input type="text" class="form-control" name="new_role">
                     </div>

                     <div class="form-group" id="role-description" style="display: none;">
                        <label>Role Description</label>
                        <textarea id="rold-description" class="form-control" placeholder="Enter Description"
                           name="description" rows="4" cols="50"></textarea>
                     </div>
                     <div class="reset-button">
                        <button type="button" class="btn btn-warning" id="resetButton">Reset</button>
                        <button type="submit" class="btn btn-success">Save</button>
                     </div>

                  </form>
                  <div class="col-sm-6">
                     <div class="image-container">
                        <img src="assets/dist/img/téléchargement.png" alt="Untitled-1.jpg" />
                     </div>
                  </div>
               </div>
               


            </div>
         </div>
      </div>
   </section>
   <!-- /.content -->
</div>
@endsection

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const roleSelect = document.getElementById('roleSelect');
    const newRoleInput = document.getElementById('newRoleInput');
    const roleDescription = document.getElementById('role-description');
    const phone = document.getElementById('phone');
    const birthdate = document.getElementById('birthdate');
    const insuranceNumber = document.getElementById('insurance_number');
    const gender = document.getElementById('gender');

    function setDisplay(element, displayValue) {
        element.style.display = displayValue;
    }

    roleSelect.addEventListener('change', function() {
        setDisplay(newRoleInput, 'none');
        setDisplay(roleDescription, 'none');
        setDisplay(phone, 'none');
        setDisplay(birthdate, 'none');
        setDisplay(insuranceNumber, 'none');
        setDisplay(gender, 'none');

        if (roleSelect.value === 'New Role') {
            setDisplay(newRoleInput, 'block');
            setDisplay(roleDescription, 'block');
            newRoleInput.querySelector('input').setAttribute('required', 'required');
            roleDescription.querySelector('input').setAttribute('required', 'required');
        } else if (roleSelect.value === 'Patient') {
            setDisplay(phone, 'block');
            setDisplay(birthdate, 'block');
            setDisplay(insuranceNumber, 'block');
            setDisplay(gender, 'block');
            phone.querySelector('input').setAttribute('required', 'required');
            birthdate.querySelector('input').setAttribute('required', 'required');
            insuranceNumber.querySelector('input').setAttribute('required', 'required');
            gender.querySelector('input').setAttribute('required', 'required');
        } else if (roleSelect.value === 'Doctor') {
            setDisplay(phone, 'block');
            phone.querySelector('input').setAttribute('required', 'required');
        } else {
            
        }
    });
});
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

<script>
   $(document).ready(function() {
    $('#addCustomerForm').submit(function(event) {
        event.preventDefault();

        var formData = $(this).serialize();

        $.ajax({
            type: 'POST',
            url: 'add-customer', // Change this URL to match your Laravel route
            data: formData,
            success: function(response) {
                toastr.options = {
                    "positionClass": "toast-top-center",
                    "progressBar": true,
                    "timeOut": 1000
                };
                toastr.success('User added successfully!'); // Display success message
            },
            error: function(xhr) {
                toastr.options = {
                    "positionClass": "toast-top-center",
                    "progressBar": true,
                    "timeOut": 3000
                };
                toastr.error('User Already Exists'); // Display error message
            }
        });
    });
});
</script>


<script>
   $(document).ready(function() {
       // Function to reset the form fields
       function resetFormFields() {
           $('#addCustomerForm')[0].reset();
           $('#roleSelect').val('');
           $('#newRoleInput').hide();
           $('#role-description').hide();
       }
   
       // Attach click event handler to the reset button
       $('#resetButton').click(function() {
           resetFormFields();
       });
   });
   </script>