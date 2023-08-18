@extends('theme')

@section('content')


<div class="content-wrapper">

    <section class="content-header">
        <div class="header-icon">
           <i class="fa fa-file-text-o"></i>
        </div>
        <div class="header-title">
           <h1>Schedule</h1>
           <small>Add Schedule</small>
        </div>
     </section>

    <section class="content">
        <div class="panel panel-bd lobidrag">
            <div class="panel-heading">
               <div class="btn-group" id="buttonexport">
                  <a href="#">
                     <h4>Doctor Schedule</h4>
                  </a>
               </div>
            </div>
            <div class="panel-body">
                <form id="schedule-form" action="{{ route('update-schedule') }}" method="post">
                    @csrf
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="text-center"></th>
                                            <th class="text-center">Day</th>
                                            <th class="text-center">From</th>
                                            <th class="text-center">To</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($schedules as $sch)
                                        <tr>
                                            <td class="">
                                                <input type="checkbox" name="check[]" value="{{ $sch->id }}">
                                            </td>
                                            <td class="">{{ $sch->day }}</td>
                                            <td class="text-center">
                                                <input name="time_from_{{ $sch->id }}" type="time" value="{{ $sch->time_from }}" class="form-control">
                                            </td>
                                            <td class="text-center">
                                                <input name="time_to_{{ $sch->id }}" type="time" value="{{ $sch->time_to }}" class="form-control">
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <hr>
                            <div class="row">
                                <div class="col-md-3"></div>

                        <button type="submit" class="btn btn-primary btn-sm col-md-3 mr-2">Save</button>
                        <button type="button" id="reset-button" class="btn btn-secondary btn-sm col-md-3">Reset</button>
                            <div class="col-md-2"></div>
                    </div>
                </form>
                
</div>

</div>
 
</section>

</div>
@endsection
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('#schedule-form').submit(function(event) {
        event.preventDefault();
        var formData = $(this).serialize();

        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: formData,
            success: function(response) {
                toastr.options = {
            "positionClass": "toast-top-center",
            "progressBar": true, 
            "timeOut": 1000 
        };
        toastr.success('Schedule updated successfully.');
            },
            error: function(xhr, status, error) {
                alert('An error occurred while updating the schedule.');
            }
        });
    });

    $('#reset-button').click(function() {
        $('input[name^="check"]:checked').each(function() {
            var dayId = $(this).val();
            $('input[name="time_from_' + dayId + '"]').val('');
            $('input[name="time_to_' + dayId + '"]').val('');
        });
    });
});
</script>
