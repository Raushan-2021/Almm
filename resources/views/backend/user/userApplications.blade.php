@extends('layouts.masters.backend')
@section('title', 'User Applications')
@section('content')
<!-- Small boxes (Stat box) -->
<div class="box box-primary">
    <div class="box-body">
        <div class="row">
            <div class="col-md-12">
                <!-- <button class="btn btn-sm btn-info pull-right mt-25" type="submit">Filter</button> -->
                <table id="stakeHoldersTable" class="table table-bordered" style="width:100%">
                    <thead>
                        <tr class="bg-warning">
                            <th width="5%">S.No</th>
                            <th width="10%">Application No</th>
                            <th width="13%">Application Type</th>

                            <th width="13%">Manufacturer Name</th>
                            <th width="20%">Address</th>
                            <th>Submitted on</th>
                            <th width="15%">Inspection Status</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($applications as $application)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>@if($application->application_no =='')--- @else {{$application->application_no}} @endif
                            </td>
                            <td>
                                @php
                                $url='view-application';
                                if($application->application_type=='2'){
                                $url='existing-application';
                                }
                                @endphp
                                @php
                                $url='view-application';
                                if($application->application_type=='3'){
                                $url='existing-application-step2';
                                }
                                @endphp
                                @php
                                $url='view-application';
                                if($application->application_type=='4'){
                                $url='existing-annexure-one';
                                }
                                @endphp
                                @if($application->application_type=='1')
                                New Application
                                @elseif($application->application_type=='2')
                                Model Addition
                                @elseif($application->application_type=='3')
                                Update
                                @elseif($application->application_type=='4')
                                Delete
                                @elseif($application->application_type=='5')
                                List
                                @else
                                Download
                                @endif
                            </td>
                            <td>{{$application->manufacturer_name}}</td>
                            <td>{{$application->register_office_address}}</td>

                            <td>{{ $application->updated_at}}</td>
                            <td>@if(!empty($application->inspectionData))

                                @foreach($application->inspectionData as $incData)
                                <strong class="text-success">Inspection Scheduled</strong><br>
                                Date : {{ date("d-M-Y",strtotime($incData['inspection_date']))}} <br>
                                Remark : {{$incData['remark']}}
                                @if($incData['change_request'] == 1)
                                <hr>
                                Requested for New Date<br>
                                New Proposed Date : <strong
                                    class="text-danger">{{ date("d-M-Y",strtotime($incData['proposed_date']))}}</strong><br>
                                Remark : {{$incData['request_remark']}}
                                @endif
                                @if($incData['change_request'] == 0)
                                <br><a href="javascript:;" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal{{$incData['id']}}" class="text-primary">Request for
                                    Change</a>
                                <div class="modal fade" id="exampleModal{{$incData['id']}}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">

                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Request for
                                                    Re-Schedule
                                                    Inscpection Date</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <span class="text-success" id="msg{{$incData['id']}}"></span>
                                                <span class="text-danger" id="err{{$incData['id']}}"></span>
                                                <table class="table">
                                                    <tr>
                                                        <th>Last Inspection Date</th>
                                                        <td class="text-danger">
                                                            {{ date("d-M-Y",strtotime($incData['inspection_date']))}}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>New Proposed Date</th>
                                                        <td><input type="date" class="form-control" name="proposed_date"
                                                                id="proposed_date{{$incData['id']}}"></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Mention Reason</th>
                                                        <td><textarea name="request_remark"
                                                                id="request_remark{{$incData['id']}}" cols="30"
                                                                rows="3"></textarea></td>
                                                    </tr>
                                                </table>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-primary "
                                                    onclick="requestSave({{$incData['id']}})">Submit</button>
                                                <input type="hidden" name="" value="{{$incData['inspection_date']}}"
                                                    id="last_inspection_date{{$incData['id']}}">
                                                <input type="hidden" name="" value="{{$application->id}}"
                                                    id="application{{$incData['id']}}">
                                                <button type="button" class="btn btn-danger"
                                                    data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @endforeach
                                @else
                                Pending
                                @endif
                            </td>
                            <td> @if($application->forward_status=='mnre') Not Forwarded
                                @elseif($application->forward_status=='reject') Rejected
                                @elseif($application->forward_status=='nise') Forwarded to NISE @endif</td>

                            <td>@if($application->final_submission == '0')
                                <a href="{{ url('users/'.$url.'/'.$application->id) }}"><i class="fa fa-edit"></i></a>
                                @else
                                <a href="{{url('users/'.$url.'/'.base64_encode($application->id))}}">View</a> |
                                <a href="{{url('users/track-detail/'.base64_encode($application->id))}}">Track</a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- /.row -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
<script type="text/javascript">
function requestSave(id) {

    //e.preventDefault();

    let proposed_date = $('#proposed_date' + id).val();
    let request_remark = $('#request_remark' + id).val();
    let application_id = $('#application' + id).val();


    if (proposed_date == '') {
        $('#err' + id).html('Please select schedule date');
        return false;
    }
    if (request_remark == '') {
        $('#err' + id).html('Please enter remark');
        return false;
    }

    if (Date.parse(proposed_date) < Date.parse($("#last_inspection_date" + id).val())) {
        alert('Schedule date should be greater than last inspection date');
        return false;
    }
    $.ajax({
        url: "{{url('users/changeScheduleDate')}}",
        type: "POST",
        data: {
            "_token": "{{ csrf_token() }}",
            id: id,
            proposed_date: proposed_date,
            request_remark: request_remark,
            application_id: application_id
        },
        success: function(response) {
            //console.log(response);
            $('#err' + id).html('');
            if (response) {
                $('#msg' + id).html(response.success);
                //alert(response.success);
                setTimeout(() => {
                    window.location.href = '/users/user-applications';
                }, 1500);
                //$('#success-message').text(response.success);  
            }
        },
        error: function(response) {
            alert(response.error);
            //$('#name-error').text(response.responseJSON.errors.name);
        }

    });
};
</script>
@endsection