@extends('layouts.masters.backend')
@section('content')
@section('title', 'Applications list')
<div class="box box-primary">
    <div class="box-body">
        <div class="row">
            <div class="col-md-12">
                <!-- <a href="{{URL::to('mnre/create-mnre-user')}}" class="btn btn-info">
                    <span class="btn-icon-wrapper pr-2 opacity-7"><i class="fa fa-plus-circle fa-w-20"></i></span> ADD
                    USER
                </a> -->
            </div>
            <div class="col-md-12">
                @include('layouts.partials.backend._flash')
                <table id="stakeHoldersTable" class="table table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th width="5%">SNo.</th>
                            <th>Application No</th>
                            <th>Type</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Submitted Date</th>
                            <th>Initial Inspection Proposed Date</th>
                            <th width="20%">Inspection Status</th>
                            <th width="10%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($applications as $application)
                        <!--$user -> MainController->mnreUsers->compact se liya h  -->
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$application['application_no']}}</td>
                            <td>
                                @if($application->application_type==1)
                                New Application
                                @elseif($application->application_type==2)
                                PV Model Addition at
                                the existing manufacturing facility
                                @elseif($application->application_type==3)
                                Application for new
                                manufacturing facility
                                @elseif($application->application_type==4)
                                Renewal
                                @elseif($application->application_type==5)
                                Co-ALMM
                                @endif
                            </td>
                            <td>{{$application->manufacturer_name}}</td>
                            <td> @if($application->status==1) Activate @else InActivate @endif</td>
                            <td>{{ date("d, M Y",strtotime($application->updated_at)) }}</td>
                            <th class="text-success"><span
                                    class="btn-success">{{date("d-M-Y",strtotime($application->inspection_date))}}</span>

                            </th>
                            <td>@if(!empty($application->inspectionData))

                                @foreach($application->inspectionData as $incData)
                                <strong class="text-success">Inspection Scheduled</strong><br>
                                Date : {{ date("d-M-Y",strtotime($incData['inspection_date']))}} <br>
                                Remark : {{$incData['remark']}}
                                @if($incData['change_request'] == 1)
                                <hr>
                                User Request for New Date<br>
                                New Proposed Date : <strong
                                    class="text-danger">{{ date("d-M-Y",strtotime($incData['proposed_date']))}}</strong><br>
                                Remark : {{$incData['request_remark']}}
                                @endif
                                @endforeach
                                @else
                                Pending
                                @endif
                            </td>
                            <td>


                                <a href="{{url('nise/view-application/'.base64_encode($application->id))}}"
                                    class="">View</a> | <a
                                    href="{{url('nise/track-detail/'.base64_encode($application->id))}}"
                                    class="">Track</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>
@endsection
