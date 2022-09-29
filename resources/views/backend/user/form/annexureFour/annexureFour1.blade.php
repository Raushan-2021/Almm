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
                        </div>

                        <div class="box-body">
                            <form action="{{ URL::to('/users/annexure-four')}}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('POST')
                                <table class="table table-bordered">
                                    <tr class="bg-warning">
                                        <th colspan="3" class=" text-left">5.1 Manufacturing facility Details</th>
                                    </tr>
                                    <tr>
                                        <th width="5%">S.No</th>
                                        <th width="45%">Particulars</th>
                                        <th>Details</th>
                                    </tr>
                                    <tr>
                                        <th>1</th>
                                        <th>Manufacturing Plant Floor Area (in m2)</th>
                                        <td><input type="text" name="plant_floor_area"
                                                placeholder="Manufacturing Plant Floor Area (in m2)"
                                                id="plant_floor_area" class="form-control" maxlength="70"
                                                value="{{ $annexuredata->plant_floor_area ?? '' }}">
                                            @error('plant_floor_area') <span
                                                class="invalid-feedback custom_valid_class">
                                                {{ $message }} </span> @enderror</td>
                                    </tr>
                                    <tr>
                                        <th>2</th>
                                        <th>Manufacturing Plant operational since</th>
                                        <td><input type="date" name="plant_operational_date" placeholder="Main Model"
                                                id="plant_operational_date" class="form-control" maxlength="70"
                                                value="{{ $annexuredata->plant_operational_date ?? '' }}"><br>
                                            @error('plant_operational_date') <span
                                                class="invalid-feedback custom_valid_class">
                                                {{ $message }} </span> @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>3</th>
                                        <th>No. of Manufacturing Lines</th>
                                        <td><input type="number" min="0" step="any" name="no_manufaturing_line"
                                                placeholder="No. of Manufacturing Lines" id="no_manufaturing_line"
                                                class="form-control" maxlength="70"
                                                value="{{ $annexuredata->no_manufaturing_line ?? '' }}">
                                            @error('no_manufaturing_line') <span
                                                class="invalid-feedback custom_valid_class">
                                                {{ $message }} </span> @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>4</th>
                                        <th>No. of Working Days in a year</th>
                                        <td><input type="number" min="0" step="any" name="no_working_day"
                                                placeholder="No. of Working Days in a year" id="no_working_day"
                                                class="form-control" maxlength="70"
                                                value="{{ $annexuredata->no_working_day ?? '' }}">
                                            @error('no_working_day') <span class="invalid-feedback custom_valid_class">
                                                {{ $message }} </span> @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>5</th>
                                        <th>Total PV model Manufacturing Capacity </th>
                                        <td><input type="number" name="manufacturing_capacity"
                                                placeholder="Total PV model Manufacturing Capacity "
                                                id="manufacturing_capacity" class="form-control" min="0" step="any"
                                                value="{{ $annexuredata->manufacturing_capacity ?? '' }}">
                                            @error('manufacturing_capacity') <span
                                                class="invalid-feedback custom_valid_class">
                                                {{ $message }} </span> @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>6</th>
                                        <th>Electricity Load Connected to manufacturing plant (in kW)</th>
                                        <td><input type="number" name="electricity_load"
                                                placeholder="Electricity Load Connected to manufacturing plant (in kW)"
                                                id="electricity_load" class="form-control" min="0" step="any"
                                                value="{{ $annexuredata->electricity_load ?? '' }}">
                                            @error('electricity_load') <span
                                                class="invalid-feedback custom_valid_class">
                                                {{ $message }} </span> @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>7</th>
                                        <th>Average Electricity Consumption per day (in kWh)</th>
                                        <td><input type="number" min="0" step="any" name="electricity_consumption"
                                                placeholder="Average Electricity Consumption per day (in kWh)"
                                                id="electricity_consumption" class="form-control" maxlength="70"
                                                value="{{ $annexuredata->electricity_consumption ?? '' }}">
                                            @error('electricity_consumption') <span
                                                class="invalid-feedback custom_valid_class">
                                                {{ $message }} </span> @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>8</th>
                                        <th>Details of Power Backup Available with capacity</th>
                                        <td><textarea name="power_backup_details" id="power_backup_details"
                                                placeholder="Details of Power Backup Available with capacity" cols="30"
                                                rows="5">{{ $annexuredata->power_backup_details ?? '' }}</textarea><br>
                                            @error('power_backup_details') <span
                                                class="invalid-feedback custom_valid_class">
                                                {{ $message }} </span> @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3">
                                            <input type="submit" name="submit"
                                                value="@if(isset($annexuredata->id) && $annexuredata->id !='')Update @else Save @endif"
                                                class="btn btn-success" id="">
                                            <input type="hidden" name="edit_id" id="edit_id"
                                                value="@if(isset($annexuredata->id)){{$annexuredata->id}}@endif">
                                            <input type="hidden" name="application_id" id="application_id"
                                                value="{{$application_id}}">
                                            <a href="{{URL::to('users/annexure-four/'.$application_id)}}"
                                                class="btn btn-danger"> Cancel </a>

                                            @if(isset($annexuredata) && $annexuredata!=null)
                                            <a href="{{URL::to('users/annexure-four-two/'.$application_id)}}"
                                                class="btn btn-warning" style="float:right">Next <i
                                                    class="fa fa-arrow-right"></i></a>
                                            @endif
                                            <a href="{{URL::to('users/annexure-three/'.$application_id)}}"
                                                class="btn btn-danger" style="float:right"><i
                                                    class="fa fa-arrow-left"></i> Back
                                            </a>

                                        </td>
                                    </tr>
                                </table>
                            </form>

                        </div>

                    </div>
                    <!-- /.card -->
                </div>

                <!-- /.col-md-6 -->
            </div>
            <!-- /.row -->
        </div>
    </div>

    @endsection
