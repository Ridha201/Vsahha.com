@extends('theme')
@section('content')

         <!-- =============================================== -->
         <!-- Content Wrapper. Contains page content -->
         <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
               <div class="header-icon">
                  <i class="fa fa-users"></i>
               </div>
               <div class="header-title">
                  <h1>Add Customer</h1>
                  <small>Customer list</small>
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
                              <i class="fa fa-list"></i>  Customer List </a>  
                           </div>
                        </div>
                        <div class="panel-body">
                           <form class="col-sm-6" method="POST" action="{{ route('add-customer') }}">
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
                                 <input type="password" class="form-control" placeholder="Enter Password" required name="password">
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
                                 <textarea id="rold-description" class="form-control" placeholder="Enter Description"  name="description" rows="4" cols="50"></textarea>
                              </div>
                              <div class="reset-button">
                                 <button  type="submit" class="btn btn-warning">Reset</button>
                                 <button  type="submit" class="btn btn-success">Save</button>
                              </div>
                              
                           </form>
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