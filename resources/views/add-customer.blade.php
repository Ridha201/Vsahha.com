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
                                 <select class="form-control" name="role">
                                    
                                    <option>Médecin</option>
                                    <option>Patient</option>
                                    <option>Administrateur</option>
                                 </select>
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