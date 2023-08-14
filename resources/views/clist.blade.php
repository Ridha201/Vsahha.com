@extends('theme')
@section('content')


         <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
               <div class="header-icon">
                  <i class="fa fa-users"></i>
               </div>
               <div class="header-title">
                  <h1>Customer</h1>
                  <small>Customer List</small>
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
                                 <h4>Add customer</h4>
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
                              <button class="btn btn-exp btn-sm dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bars"></i> Export Table Data</button>
                              <ul class="dropdown-menu exp-drop" role="menu">
                                 <li>
                                    <a href="#" onclick="$('#dataTableExample1').tableExport({type:'json',escape:'false'});"> 
                                    <img src="assets/dist/img/json.png" width="24" alt="logo"> JSON</a>
                                 </li>
                                 <li>
                                    <a href="#" onclick="$('#dataTableExample1').tableExport({type:'json',escape:'false',ignoreColumn:'[2,3]'});">
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
                                    <a href="#" onclick="$('#dataTableExample1').tableExport({type:'powerpoint',escape:'false'});"> 
                                    <img src="assets/dist/img/ppt.png" width="24" alt="logo"> PowerPoint</a>
                                 </li>
                                 <li class="divider"></li>
                                 <li>
                                    <a href="#" onclick="$('#dataTableExample1').tableExport({type:'png',escape:'false'});"> 
                                    <img src="assets/dist/img/png.png" width="24" alt="logo"> PNG</a>
                                 </li>
                                 <li>
                                    <a href="#" onclick="$('#dataTableExample1').tableExport({type:'pdf',pdfFontSize:'7',escape:'false'});"> 
                                    <img src="assets/dist/img/pdf.png" width="24" alt="logo"> PDF</a>
                                 </li>
                              </ul>
                           </div>
                           <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->
                           <div class="text-right" style="    padding-bottom: 6px;">
                              <label class="control-label">Filter By Role : </label>
                              <select id="roleFilter" style="height: 27px; padding: 2px 12px ; font-size: 14px; border-radius: 4px; " onchange="applyRoleFilter()">
                                  <option value="">All Roles</option>
                                  @foreach($roles as $role)
                                  <option value="{{$role->name}}">{{$role->name}}</option>
                                  @endforeach
                              </select>
                          </div>
                          
                           <div class="table-responsive" id="users-table">
                              <table id="dataTableExample1" class="table table-bordered table-striped table-hover">
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
                                       @foreach ($customers as $customer)
                                       <input type="hidden" name="id" value="{{$customer->id}}">
                                           
                                       @endforeach

                                        
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
                                       <div class="col-md-6 form-group" id="newRoleInput"  style="display: none;">
                                          <label>New Role</label>
                                          <input type="text" class="form-control" name="new_role">
                                      </div>
                                       
                                       <div class="col-md-6 form-group" id="role-description" style="display: none;" >
                                          <label>Role Description</label>
                                          <textarea id="rold-description" class="form-control" placeholder="Enter Description"  name="description" rows="4" cols="50"></textarea>
                                       </div>
                                       <div class="col-md-12 form-group user-form-group">
                                          <div class="pull-right">
                                             <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancel</button>
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
                        <div class="modal-body">
                           <div class="row">
                              <div class="col-md-12">
                                 <form class="form-horizontal">
                                    <fieldset>
                                       <div class="col-md-12 form-group user-form-group">
                                          <label class="control-label">Are you sure you want to Delete this User ?</label>
                                          <div class="pull-right">
                                             <button type="button" data-dismiss="modal" class="btn btn-danger btn-sm">NO</button>
                                             <a href="/delete-user/{{$customer->id}}"  class="btn btn-add btn-sm">YES</a>
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

    function showReloadIcon() {
        document.getElementById('reloadIcon').style.display = 'block';
    }

    function hideReloadIcon() {
        document.getElementById('reloadIcon').style.display = 'none';
    }
function applyRoleFilter(page) {
   showReloadIcon();
    var selectedRole = document.getElementById('roleFilter').value;

    
    $.ajax({
        url: "{{ route('filter-customers') }}" + (selectedRole ? '/' + selectedRole : ''),
        type: 'GET',
        dataType: 'json',
        data: { page: page }, 
        success: function (data) {
            displayFilteredResults(data.data); 
            displayPaginationLinks(data.links); 
            hideReloadIcon();
        },
        error: function (error) {
            console.log('Error:', error);
        }
    });
}

function displayUsers(page) {
    

    
    $.ajax({
        url: "{{ route('customerslist') }}" ,
        type: 'GET',
        dataType: 'json',
        data: { page: page }, 
        success: function (data) {
            displayFilteredResults(data.data); 
            displayPaginationLinks(data.links); 
        },
        error: function (error) {
            console.log('Error:', error);
        }
    });

    
}
displayUsers();





function displayFilteredResults(customers) {
    var resultsDiv = document.getElementById('users-table');
    var tableHtml = '<table class="table table-bordered table-striped table-hover">';
   
    tableHtml += '<thead><tr class="info"><th>Customer Name</th><th>Email</th><th>Role</th><th>Description</th><th>Join</th><th>Action</th></tr></thead>';
    tableHtml += '<tbody>';
    
    
    for (var i = 0; i < customers.length; i++) {
        tableHtml += '<tr>';
        tableHtml += '<td>' + customers[i].name + '</td>';
        tableHtml += '<td>' + customers[i].email + '</td>';
        tableHtml += '<td>' + customers[i].role.name + '</td>';
        tableHtml += '<td>' + customers[i].role.description + '</td>';
        var createdAt = new Date(customers[i].created_at);
        var formattedCreatedAt = createdAt.toLocaleString(); 
        tableHtml += '<td>' + formattedCreatedAt + '</td>';
        tableHtml += '<td>';
        tableHtml += '<button type="button" class="btn btn-add btn-sm" data-toggle="modal" data-target="#customer1"><i class="fa fa-pencil"></i></button>';
        tableHtml += '<button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#customer2"><i class="fa fa-trash-o"></i></button>';
        tableHtml += '</td>';
        tableHtml += '</tr>';
    }
    
    tableHtml += '</tbody></table><nav aria-label="Page navigation example" class="text-center"><ul class="pagination" id="paginationLinks"></ul></nav>';
    resultsDiv.innerHTML = tableHtml;
}

function displayPaginationLinks(links) {
    var paginationLinksDiv = document.getElementById('paginationLinks');
    var paginationHtml = '<nav aria-label="Page navigation example" class="text-center"><ul class="pagination">';

      if (links.prev_page_url) {
    var prevPageNumber = getPageNumberFromUrl(links.prev_page_url);
    paginationHtml += '<li class="page-item">';
    paginationHtml += '<a class="page-link pagination-link" href="#" data-page="' + prevPageNumber + '" aria-label="Previous">';
    paginationHtml += '<span aria-hidden="true">&laquo;</span>';
    paginationHtml += '<span class="sr-only">Previous</span>';
    paginationHtml += '</a>';
    paginationHtml += '</li>';
} else {
    paginationHtml += '<li class="page-item disabled">';
    paginationHtml += '<span class="page-link" aria-label="Previous">';
    paginationHtml += '<span aria-hidden="true">&laquo;</span>';
    paginationHtml += '<span class="sr-only">Previous</span>';
    paginationHtml += '</span>';
    paginationHtml += '</li>';
}

for (var i = 1; i <= links.last_page; i++) {
    if (i == links.current_page) {
        paginationHtml += '<li class="page-item active"><span class="page-link">' + i + '</span></li>';
    } else {
        paginationHtml += '<li class="page-item"><a class="page-link pagination-link" href="#" data-page="' + i + '">' + i + '</a></li>';
    }
}

if (links.next_page_url) {
    var nextPageNumber = getPageNumberFromUrl(links.next_page_url);
    paginationHtml += '<li class="page-item">';
    paginationHtml += '<a class="page-link pagination-link" href="#" data-page="' + nextPageNumber + '" aria-label="Next">';
    paginationHtml += '<span aria-hidden="true">&raquo;</span>';
    paginationHtml += '<span class="sr-only">Next</span>';
    paginationHtml += '</a>';
    paginationHtml += '</li>';
} else {
    paginationHtml += '<li class="page-item disabled">';
    paginationHtml += '<span class="page-link" aria-label="Next">';
    paginationHtml += '<span aria-hidden="true">&raquo;</span>';
    paginationHtml += '<span class="sr-only">Next</span>';
    paginationHtml += '</span>';
    paginationHtml += '</li>';
}


function getPageNumberFromUrl(url) {
    var urlParts = url.split('?');
    if (urlParts.length > 1) {
        var queryString = urlParts[1];
        var params = new URLSearchParams(queryString);
        return params.get('page');
    }
    return null;
}
    paginationHtml += '</ul></nav>';
    paginationLinksDiv.innerHTML = paginationHtml;

    
    $('.pagination-link').on('click', function (e) {
        e.preventDefault();
        var page = $(this).data('page');
        applyRoleFilter(page); 
    });
}



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