@extends('theme')
@section('content')
<style>
   <style>.dataTables_filter {
      display: none;
   }

   .paginate_button{

border-color: #009688 !important;

}
.dataTables_wrapper .dataTables_paginate .paginate_button{

color :#009688 !important ;
margin-top: 13px !important;
 margin-bottom: 13px !important ;
}
.current{
background-color: #009688 ! important;

}

.dataTables_wrapper .dataTables_paginate .paginate_button:hover {

background :#009688 !important ;

}
</style>




<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <div class="header-icon">
         <i class="fa fa-users"></i>
      </div>
      <div class="header-title">
         <h1>Users</h1>
         <small>Users List</small>
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
                        <h4>Users List</h4>
                     </a>
                  </div>
               </div>
               <div class="panel-body">
                  <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->
                  <div class="btn-group">
                     <div class="buttonexport" id="buttonlist">
                        <a class="btn btn-add" href="{{route('addcustomer')}}"> <i class="fa fa-plus"></i> Add Customer
                        </a>
                     </div>
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
                     <input type="text" id="searchInput" placeholder="Search for clients..."
                        style="height: 27px;padding: 2px 2px;font-size: 13px;border-radius: 4px;">
                     <label class="control-label">Filter By Role : </label>
                     <select id="roleFilter"
                        style="height: 27px; padding: 2px 12px ; font-size: 14px; border-radius: 4px; "
                        onchange="applyRoleFilter()">
                        <option value="">All Roles</option>
                        @foreach($roles as $role)
                        <option value="{{$role->name}}">{{$role->name}}</option>
                        @endforeach
                     </select>
                  </div>

                  <div class="table-responsive" id="users-table">
                     
                     <table id="clientsTable" class="table table-bordered table-striped table-hover">
                        <thead >
                           <tr class="info">
                               <th>Name</th>
                               <th>Email</th>
                               <th>Role</th> <!-- Add Location and Contact columns -->
                               <th>Description</th>
                               <th>Join</th>
                               <th>Action</th>
                           </tr>
                       </thead>
                       <tbody>
                           <tr>
                               <td>James</td>
                               <td>24</td>
                               <td>USA</td>
                               <td>+123456789</td>
                               <td>+123456789</td>
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
                  <h3><i class="fa fa-user m-r-5"></i> Update Customer</h3>
               </div>
               <div class="modal-body">
                  <div class="row">
                     <div class="col-md-12">
                        <form class="form-horizontal" method="POST" action="{{route('update-user')}}">
                           @csrf
                           <fieldset>
                             
                              <input type="hidden" name="id" value="" id="updateUserId">

                            


                              <!-- Text input-->
                              <div class="col-md-6 form-group">
                                 <label class="control-label">Name:</label>
                                 <input type="text" placeholder="Customer Name" class="form-control" name="name">
                              </div>
                              <!-- Text input-->
                              <div class="col-md-6 form-group">
                                 <label class="control-label">Email:</label>
                                 <input type="email" placeholder="Email" class="form-control" name="email">
                              </div>

                              <!-- Text input-->


                              <div class="col-md-6 form-group">
                                 <label class="control-label">Role</label>
                                 <select class="form-control" name="role" id="roleSelect">
                                    <option>Select a Role</option>
                                    @foreach($roles as $role)
                                    <option value="{{$role->name}}">{{$role->name}}</option>
                                    @endforeach
                                    <option value="New Role">New Role</option> <!-- Add the new option -->
                                 </select>
                              </div>

                              <div class="col-md-6 form-group">
                                 <label class="control-label">Password:</label>
                                 <input type="password" placeholder="Password" class="form-control" name="password">
                              </div>
                              <div class="col-md-6 form-group" id="newRoleInput" style="display: none;">
                                 <label>New Role</label>
                                 <input type="text" class="form-control" name="new_role">
                              </div>

                              <div class="col-md-6 form-group" id="role-description" style="display: none;">
                                 <label>Role Description</label>
                                 <textarea id="rold-description" class="form-control" placeholder="Enter Description"
                                    name="description" rows="4" cols="50"></textarea>
                              </div>
                              <div class="col-md-12 form-group user-form-group">
                                 <div class="pull-right">
                                    <button type="button" class="btn btn-danger btn-sm"
                                       data-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-add btn-sm">Save</button>
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
                  <h3><i class="fa fa-user m-r-5"></i> Delete Customer</h3>
               </div>
               <div class="modal-body delete-modal">
                  <div class="row">
                     <div class="col-md-12">
                        <form class="form-horizontal">
                           <fieldset>
                              <div class="col-md-12 form-group user-form-group">
                                 <label class="control-label">Are you sure you want to Delete this User ?</label>
                                 <div class="pull-right">
                                    <button type="button" data-dismiss="modal" class="btn btn-danger btn-sm">NO</button>
                                    <a href="" class="btn btn-add btn-sm delete-btn">YES</a>
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
<script>
 
function applyRoleFilter(page) {
    var selectedRole = document.getElementById('roleFilter').value;
    route = "{{ route('filter-customers') }}" + (selectedRole ? '/' + selectedRole : '');
    initDataTable(route);
    
}


function displayUsers() {
route = "{{ route('search') }}";
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
            { data: 'role.name', defaultContent: "" },
            { data: 'role.description', defaultContent: "" },
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
                    return '<button type="button" class="btn btn-add btn-sm" data-toggle="modal" data-target="#customer1"><i class="fa fa-pencil"></i></button>' +
                           '<a href="#" class="btn btn-danger btn-sm delete-btn" data-toggle="modal" data-target="#customer2" data-user-id="' + data + '"><i class="fa fa-trash-o"></i></a>';
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

   
    $('#clientsTable').on('click', '.delete-btn', function() {
        var userId = $(this).data('user-id');
        var deleteLink = '/delete-user/' + userId;
        $('#customer2 .delete-btn').attr('href', deleteLink);
        
    });

    $('#clientsTable').on('click', '.btn-add', function() {
            var userId = $(this).closest('tr').find('.delete-btn').data('user-id');
            $('#updateUserId').val(userId);
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