@extends('layouts.masters.backend')
@section('title', 'Annexure 4')
@section('content')

<div class="row">
    @include('layouts.partials.backend._stepper')
    <div class="col-md-12">
        @include('layouts.partials.backend._flash')
        <div class="box box-primary">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">

                        <div class="box-header with-border">
                            <a class="btn btn-success btn-sm" href="javascript:;"
                                onclick="$('#show_data').toggle('slow')"><i class="fa fa-plus"></i> Add</a>

                        </div>

                        <div class="box-body">
                            @if ($errors->any())
                            @foreach ($errors->all() as $error)
                            <span class="invalid-feedback all_valid_class" style="display:block">
                                {{ $error }} </span>
                            @endforeach
                            @endif
                            <form action="{{ URL::to('/users/annexure-four-three')}}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('POST')
                                <table class="table table-bordered" id="show_data"
                                    style="display:@if($annexuredata!=null)  @else none @endif">
                                    <tr>
                                        <th>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label for="">Make and Model</label>
                                                    <input type="text" name="make_and_model"
                                                        placeholder="Enter Make and Model" id="make_and_model"
                                                        class="form-control" maxlength="70"
                                                        value="{{ $annexuredata->make_and_model ?? '' }}">

                                                </div>
                                                <div class="col-md-4">
                                                    <label for="">Machine Serial No.</label>
                                                    <input type="text" name="machine_serial_no"
                                                        placeholder="Enter Machine Serial No." id="machine_serial_no"
                                                        class="form-control" maxlength="70"
                                                        value="{{ $annexuredata->machine_serial_no ?? '' }}">
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="">Calibration Done by <i
                                                            class="text-primary">(Lab/Agency/Company Name with
                                                            Address)</i></label>
                                                    <input type="text" name="calibration_done_by" placeholder="Lab/Agency/Company Name with
                                                            Address" id="calibration_done_by" class="form-control"
                                                        value="{{ $annexuredata->calibration_done_by ?? '' }}">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="">Last Calibration Date</label>
                                                    <input type="date" name="last_calibration_date"
                                                        placeholder="Rated Manufacturing Capacity"
                                                        id="last_calibration_date" class="form-control" maxlength="70"
                                                        value="{{ $annexuredata->last_calibration_date ?? '' }}">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="">Calibration Valid Upto</label>
                                                    <input type="date" name="calibration_valid_upto"
                                                        placeholder="Rated Manufacturing Capacity"
                                                        id="calibration_valid_upto" class="form-control" maxlength="70"
                                                        value="{{ $annexuredata->calibration_valid_upto ?? '' }}">
                                                </div>



                                            </div>
                                        </th>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="submit" name="submit"
                                                value="@if(isset($annexuredata->id) && $annexuredata->id !='')Update @else Save @endif"
                                                class="btn btn-success" id="">
                                            <input type="hidden" name="edit_id" id="edit_id"
                                                value="@if(isset($annexuredata->id)){{$annexuredata->id}}@endif">
                                            <input type="hidden" name="application_id" id="application_id"
                                                value="{{$application_id}}">
                                            <a href="{{URL::to('users/annexure-one-c/'.$application_id)}}"
                                                class="btn btn-danger"> Cancel </a>

                                        </td>
                                    </tr>
                                </table>


                            </form>
                            <table class="table table-bordered">
                                <thead>
                                    <tr class="bg-warning">
                                        <th>5.3</th>
                                        <th scope="col" colspan="13" class="text-left">List of Major Machines/Equipments
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th width="6%">Equipment/Module</th>
                                        <th width="5%">S.No</th>
                                        <th width="10%">Make and Model</th>
                                        <th width="10%">Machine Serial No.</th>
                                        <th>Calibration Done by (Lab/Agency/Company Name with Address)</th>
                                        <th width="10%">Last Calibration Date</th>
                                        <th width="10%">Calibration Valid Upto</th>
                                        <th width="10%"></th>

                                    </tr>
                                    @foreach($appData as $data)
                                    <tr>
                                        <td>Sun Simulator</td>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$data->make_and_model}}</td>
                                        <td>{{$data->machine_serial_no}}</td>
                                        <td>{{$data->calibration_done_by}}</td>
                                        <td>{{$data->last_calibration_date}}</td>
                                        <td>{{$data->calibration_valid_upto}}</td>
                                        <td><a
                                                href="{{URL::to('users/annexure-four-three/'.$data->application_id.'/'.$data->id)}}">Edit
                                                <i class="fa fa-edit"></i></a>
                                            <a href="{{URL::to('users/delete-annexure/4/'.$data->id)}}"
                                                onCLick="if (confirm('Are you sure to delete?')) { }else{ return false;}"
                                                class="text-danger">Delete <i class="fa fa-trash"></i></a>
                                        </td>

                                    </tr>

                                    @endforeach

                                </tbody>
                                <tr>
                                    <th colspan="13">
                                        @if(!$appData->isEmpty())

                                        <a href="{{URL::to('users/annexure-four-four/'.$application_id)}}"
                                            class="btn btn-warning" style="float:right">Next <i
                                                class="fa fa-arrow-right"></i></a>
                                        @endif
                                        <a href="{{URL::to('users/annexure-four-three/'.$application_id)}}"
                                            class="btn btn-danger" style="float:right"><i class="fa fa-arrow-left"></i>
                                            Back </a>

                                    </th>
                                </tr>
                            </table>

                        </div>

                    </div>
                    <!-- /.card -->
                </div>

                <!-- /.col-md-6 -->
            </div>
            <!-- /.row -->
        </div>
    </div>
    <style>
    .max-char {
        position: absolute;

        right: 35px;
        margin-top: -24px;
    }

    </style>

    @endsection
