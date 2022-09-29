@extends('layouts.masters.backend')
@section('title', 'Dashboard')
@section('content')
<!-- Small boxes (Stat box) -->
<div class="row">
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-white">
            <div class="inner">
                <h3>{{$data['installations_assigned']}}</h3>

                <p>Installations Assigned</p>
            </div>
            <div class="icon">
                <i class="ion ion-bag"></i>
            </div>
            <a href="{{url('installer/systems')}}" class="small-box-footer small-box-primary">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-white">
            <div class="inner">
                <h3>{{$data['installations_complete']}}</h3>

                <p>System Installations done</p>
            </div>
            <div class="icon">
                <i class="ion ion-stats-bars"></i>
            </div>
            <a href="{{url('installer/systems')}}" class="small-box-footer small-box-success">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-white">
            <div class="inner">
                <h3>{{$data['maintenances_requests']}}</h3>

                <p>Maintenance Requests Assigned</p>
            </div>
            <div class="icon">
                <i class="ion ion-person-add"></i>
            </div>
            <a href="{{url('installer/system-maintenance')}}" class="small-box-footer small-box-warning">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-white">
            <div class="inner">
                <h3>{{$data['maintenances_completed']}}</h3>

                <p>Maintenance Requests Completed</p>
            </div>
            <div class="icon">
                <i class="ion ion-pie-graph"></i>
            </div>
            <a href="{{url('installer/system-maintenance')}}" class="small-box-footer small-box-danger">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
</div>
<!-- /.row -->
@endsection
