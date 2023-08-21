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
                        <button type="submit" class="btn btn-warning">Reset</button>
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

       roleSelect.addEventListener('change', function() {
           if (roleSelect.value === 'New Role') {
               newRoleInput.style.display = 'block';
               roleDescription.style.display = 'block'; 
               newRoleInput.querySelector('input').setAttribute('required', 'required');
               roleDescriptionInput.setAttribute('required', 'required');
           } else {
               newRoleInput.style.display = 'none';
               roleDescription.style.display = 'none'; 
               newRoleInput.querySelector('input').removeAttribute('required');
               roleDescriptionInput.removeAttribute('required');
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