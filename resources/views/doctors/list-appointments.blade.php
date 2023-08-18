@extends('theme')
@section('content')


<style> 

.paginate_button{

   border-color: #009688 !important;

}
.dataTables_wrapper .dataTables_paginate .paginate_button{

   color :#009688 !important ;
   margin-top: 13px !important;
    margin-bottom: 13px !important ;
}
.current{
   background-color: aquamarine ! important;

}

.dataTables_wrapper .dataTables_paginate .paginate_button:hover {

   background :#009688 !important ;

}

</style>


<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<meta name="csrf-token" content="{{ csrf_token() }}">



<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
       <div class="header-icon">
          <i class="fa fa-file-text-o"></i>
       </div>
       <div class="header-title">
          <h1>appointments</h1>
          <small>Appointment List</small>
       </div>
    </section>
    <!-- Main content -->
    <section class="content">
       <div class="row">
          <div class="col-sm-12">
             <div class="panel panel-bd lobidrag">
                <div class="panel-heading">
                   <div class="btn-group" >
                      <a href="#">
                         <h4>Appointment List</h4>
                      </a>
                   </div>
                </div>
                  
                 <div class="container" style="margin-top: 10px">
               
                  <table id="exemple" class="table table-bordered table-striped table-hover">
                     <thead>
                         <tr class="info">
                             <th>Schedule</th>
                             <th>Patient</th>
                             <th>Status</th>
                             <th>Action</th>
                         </tr>
                     </thead>
                     <tbody>
                         @foreach($appointments as $app)
                         <tr>
                            
                            
                             <td>{{strtoupper( \carbon\Carbon::parse($app->appointment_time)->translatedFormat('l M j, Y h:i a') )}}</td>
                             
                             <td>{{$app->user->name}}</td>
                          
                 
                 
                 
                 
                          
                              <td class="appointment-status-{{$app->id}}">
                                 @if($app->status=="confirmed")
                                <span class="label-custom label label-default">{{$app->status}}</span>
                                @elseif($app->status=="rejected")
                                <span class="label-danger label label-default">{{$app->status}}</span>
                                @elseif($app->status=="pending")
                                <span class="label-warning label label-default">{{$app->status}}</span>
                                  @endif
                 
                              </td>
                 
                            <td>
                               <button type="button" class="btn btn-add btn-sm" data-toggle="modal" data-target="#customer{{$app->id}}" ><i class="fa fa-check"></i></button>
                               <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#reject{{$app->id}}"><i class="fa fa-trash-o"></i> </button>
                            </td>
                         </tr>
                        @endforeach
                     </tbody>
                 </table>
                </div>
             </div>
          </div>
       
       <!-- customer Modal1 -->
      @foreach($appointments as $appreject)
       <div class="modal fade" id="reject{{$appreject->id}}" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="modal-dialog">
             <div class="modal-content">
                <div class="modal-header modal-header-primary">
                   <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                   <h3><i class="fa fa-user m-r-5"></i> Reject Appointment</h3>
                </div>
                <div class="modal-body">
                   <div class="row">
                      <div class="col-md-12">
                         <form class="form-horizontal">
                            <fieldset>
                               <div class="col-md-12 form-group user-form-group">
                                  <label class="control-label">Reject Appointment</label>
                                  <div class="pull-right">
                                     <button type="button" class="btn btn-danger btn-sm">NO</button>
                                     <a   data-appid="{{$appreject->id}}" data-dismiss="modal"  class="btn btn-add btn-sm reject-button" >YES</a>
                                    </div>
                               </div>
                            </fieldset>
                         </form>
                      </div>
                   </div>
                </div>
                <div class="modal-footer">
                   <button type="button" class="btn btn-danger pull-left" data-dismiss="modal" >Close</button>
                </div>
             </div>
             <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
       </div>
       @endforeach


       @foreach($appointments as $app)


       <div class="modal fade" id="customer{{$app->id}}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
           <div class="modal-content">
              <div class="modal-header modal-header-primary">
                 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                 <h3><i class="fa fa-user m-r-5"></i> Confirm Appointment</h3>
              </div>
              <div class="modal-body">
                 <div class="row">
                    <div class="col-md-12">
                       <form class="form-horizontal">
                          <fieldset>
                             <div class="col-md-12 form-group user-form-group">
                                <label class="control-label">Confirm Appointment</label>
                                <div class="pull-right">
                                   <button type="button" class="btn btn-danger btn-sm">NO</button>
                                   <a class="btn btn-add btn-sm confirm-button" data-appid="{{$app->id}}" data-dismiss="modal">YES</a>
                                </div>
                             </div>
                          </fieldset>
                       </form>
                    </div>
                 </div>
              </div>
              <div class="modal-footer">
                 <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>
              </div>
           </div>
           <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
     </div>

     @endforeach
       <!-- /.modal -->
    </section>
    <!-- /.content -->
 </div>

@endsection


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<script>
   $(document).ready(function() {
      $('.confirm-button').on('click', function() {
          var appId = $(this).data('appid');
          var status = $('.appointment-status-' + appId); 
          confirmAppointment(appId, status);
      });
   
      function confirmAppointment(appId, status) {
          var confirmed = '<span class="label-custom label label-default">confirmed</span>';
   
          $.ajax({
    type: 'GET',
    url: '{{ route("confirm-appointment", ["id" => "__ID__"]) }}'.replace('__ID__', appId),
    success: function(response) {
        console.log('Appointment confirmed successfully.');
        status.empty();
        status.html(confirmed);
        
        toastr.options = {
            "positionClass": "toast-top-center",
            "progressBar": true, 
            "timeOut": 1000 
        };
        toastr.success('Appointment confirmed successfully.');
    },
    error: function(xhr, status, error) {
        console.error('Error confirming appointment:', error);
    }
});

      }
   });
</script>
<script>
   $(document).ready(function() {
      $('.reject-button').on('click', function() {
          var appId = $(this).data('appid');
          var status = $('.appointment-status-' + appId); 
          confirmAppointment(appId, status);
      });
   
      function confirmAppointment(appId, status) {
          var rejected = '<span class="label-danger label label-default">rejected</span>';
   
          $.ajax({
              type: 'GET',
              url: '{{ route("reject-appointment", ["id" => "__ID__"]) }}'.replace('__ID__', appId),
              success: function(response) {
                  console.log('Appointment rejected successfully.');
                  status.empty();
                  status.html(rejected);
                  
                  toastr.options = {
            "positionClass": "toast-top-center",
            "progressBar": true, 
            "timeOut": 1000 ,

        };
        toastr.success('Appointment rejected successfully.');
                  
              },
              error: function(xhr, status, error) {
                  console.error('Error rejected appointment:', error);
              }
          });
      }
   });
   </script>

   
   