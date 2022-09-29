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
                            <th width="10%">SNo.</th>
                            <th>Application No</th>
                            <th>Type</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Submitted Date</th>
                            <th>Forward Status</th>
                            <th width="15%">Action</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($applications as $key => $application)
                        <!--$user -> MainController->mnreUsers->compact se liya h  -->
                        <tr>
                            <td>{{$key + 1}}</td>
                            <td>{{$application->application_no}}</td>
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
                            
                            <td> @if($application->forward_status=='mnre') Not Forwarded @elseif($application->forward_status=='reject') Rejected @elseif($application->forward_status=='nise') Forwarded to NISE @endif</td>
                            <td>
                                
                                
                                <a href="{{url('mnre/view-application/'.base64_encode($application->id))}}"
                                    class="btn btn-xs btn-primary-hallow">View</a> | <a href="{{url('mnre/track-detail/'.base64_encode($application->id))}}"
                                    class="btn btn-xs btn-primary-hallow">Track</a>
                            </td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="pull-right">{{ $applications->links('pagination::bootstrap-4') }}</div>
            </div>
        </div>
    </div>
</div>
@endsection