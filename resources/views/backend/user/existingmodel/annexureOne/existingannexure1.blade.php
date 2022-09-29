@extends('layouts.masters.backend')
@section('title', 'Annexure 1 :: Details of Solar PV Modules')
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
                            <form action="{{URL::to('/users/existing-annexure-one')}}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('POST')
                                <table class="table table-bordered" id="show_data"
                                    style="display:@if($annexuredata!=null)  @else none @endif">
                                    <tr>
                                        <th>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label for="">Type of Model</label>
                                                    <select name="module_type" id="module_type" class="form-control"
                                                        onChange="getDataValue(this)">
                                                        <option value="">Select Module</option>
                                                        @foreach($moduleList as $module)
                                                        <option data-id="{{$module->main_model}}"
                                                            value="{{$module->id}}" @if(isset($annexuredata->
                                                            module_type) &&
                                                            $annexuredata->module_type==$module->id)selected @endif>
                                                            {{$module->module_type}} ({{$module->main_model}})</option>
                                                        @endforeach
                                                    </select>

                                                    <!-- <input type="text" name="module_type" placeholder="Type of Modules"
                                                        id="module_type" class="form-control" maxlength="70"
                                                        value="{{ $annexuredata->module_type ?? '' }}"> -->

                                                </div>
                                                <div class="col-md-4">
                                                    <label for="">Main Model</label>
                                                    <input type="text" name="model_code" placeholder="Main Model"
                                                        id="model_code" class="form-control" maxlength="70" readonly
                                                        value="{{ $annexuredata->model_code ?? '' }}">
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="">Pmax (Wp) of Main Model</label>
                                                    <input type="number" min="0" step="any" name="pmax_model"
                                                        placeholder="Pmax (Wp) of Main Model" id="pmax_model"
                                                        class="form-control" maxlength="70"
                                                        value="{{ $annexuredata->pmax_model ?? '' }}">
                                                </div>
                                            </div>
                                        </th>
                                    </tr>
                                    <tr>
                                        <td>
                                            <table class="table table-bordered1">
                                                <tr>
                                                    <th>S.No</th>
                                                    <th>Pmax (Wp) of Applicable Models Model</th>
                                                    <th>No of Cells & Cell Type (Full/Half/Third)</th>
                                                    <th>System Voltage (VDC)</th>
                                                    <th></th>
                                                </tr>
                                                <tbody id="add-data">
                                                    @if($annexuredata!=null)

                                                    @foreach($annexuredata->pmax_applicable_model as
                                                    $value)
                                                    <tr class="record">
                                                        <td>{{$loop->iteration}}</td>
                                                        <td> <input type="number" min="0" step="any"
                                                                name="pmax_applicable_model[]"
                                                                id="pmax_applicable_model_{{$loop->iteration}}"
                                                                placeholder="Enter Pmax in (Wp) " value="{{$value}}">
                                                        </td>
                                                        <td> <input type="text" name="no_of_cells[]"
                                                                id="no_of_cells_{{$loop->iteration}}" min="0" step="any"
                                                                placeholder="Enter No of Cells & Cell Type "
                                                                value="{{$annexuredata->pmax_applicable_model[$loop->iteration-1]}}">
                                                        </td>
                                                        <td><input type="number" name="system_voltage[]"
                                                                id="system_voltage_{{$loop->iteration}}" min="0"
                                                                step="any" placeholder="Enter System Voltage (VDC)"
                                                                value="{{$annexuredata->system_voltage[$loop->iteration-1]}}">
                                                        </td>
                                                        <td width="8%">
                                                            @if($loop->iteration==1)
                                                            <a href="javascript:;" id="add-row">Add
                                                                <i class="fa fa-plus text-success"></i></a>
                                                            @else
                                                            <a href="javascript:;" class="remove_fields">Delete <i
                                                                    class="fa fa-trash text-danger"></i></a>
                                                            @endif

                                                        </td>

                                                    </tr>
                                                    @endforeach
                                                    @else
                                                    <tr>
                                                        <td>1</td>
                                                        <td> <input type="number" min="0" step="any"
                                                                name="pmax_applicable_model[]"
                                                                id="pmax_applicable_model"
                                                                placeholder="Enter Pmax in (Wp) ">
                                                        </td>
                                                        <td> <input type="text" name="no_of_cells[]" id="no_of_cells"
                                                                min="0" step="any"
                                                                placeholder="Enter No of Cells & Cell Type ">
                                                        </td>
                                                        <td><input type="number" name="system_voltage[]"
                                                                id="system_voltage" min="0" step="any"
                                                                placeholder="Enter System Voltage (VDC)">
                                                        </td>
                                                        <td width="8%"><a href="javascript:;" id="add-row">Add
                                                                <i class="fa fa-plus text-success"></i></a>
                                                        </td>

                                                    </tr>
                                                    @endif
                                                </tbody>
                                            </table>
                                        </td>
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


                                        </td>
                                    </tr>
                                </table>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>3.1</th>
                                            <th scope="col" colspan="8">Solar PV Model
                                                Details</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row">Sr.No</th>
                                            <th>Type Of Modules</th>
                                            <th>Main Model</th>
                                            <th>Pmax (Wp) of Main Model</th>
                                            <th width="15%">Applicable models covered under +- 5%, Pmax of Main Model
                                            </th>
                                            <th width="15%">Pmax (Wp) of Applicable Models Model</th>
                                            <th width="15%">No of Cells & Cell Type (Full/Half/Third)</th>
                                            <th>System Voltage (VDC)</th>
                                            <th></th>
                                        </tr>
                                        @foreach($appData as $data)
                                        <tr>
                                            <th rowspan="">{{ $loop->iteration }}</th>
                                            <td>{{$data->module_type}}</td>
                                            <td>{{$data->model_code}}</td>
                                            <td>{{$data->pmax_model}}</td>
                                            <td class="text-center">
                                                <table width="100%">
                                                    @foreach (json_decode($data->pmax_applicable_model) as
                                                    $pmax_applicable_model)
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            {{ $data->model_code }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            <td class="text-center">
                                                <table width="100%">
                                                    @foreach (json_decode($data->pmax_applicable_model) as
                                                    $pmax_applicable_model)
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            {{ $pmax_applicable_model }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            <td class="text-center">
                                                <table width="100%">
                                                    @foreach (json_decode($data->no_of_cells) as
                                                    $no_of_cells)
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            {{ $no_of_cells }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            <td class="text-center">
                                                <table width="100%">
                                                    @foreach (json_decode($data->system_voltage) as
                                                    $system_voltage)
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            {{ $system_voltage }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            <td><a href="{{URL::to('users/existing-annexure-one/'.$data->application_id.'/'.$data->id)}}"
                                                    onClick="editAnnexureData({{$data->id}})">Edit <i
                                                        class="fa fa-edit"></i></a>
                                                <a href="{{URL::to('users/delete-annexure/1/'.$data->id)}}"
                                                    onCLick="if (confirm('Are you sure to delete?')) { }else{ return false;}"
                                                    class="text-danger">Delete <i class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tr>
                                        <th colspan="9">

                                            @if(!$appData->isEmpty())
                                            <a href="{{URL::to('users/annexure-one-b/'.$application_id)}}"
                                                class="btn btn-warning" style="float:right;">Next <i
                                                    class="fa fa-arrow-right"></i></a>

                                            <a href="{{URL::to('users/existing-application-step2/'.$application_id)}}"
                                                class="btn btn-danger" style="float:right;"><i
                                                    class="fa fa-arrow-left"></i>
                                                Back
                                            </a>
                                            @endif
                                        </th>
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
    <style>
    .max-char {
        position: absolute;

        right: 35px;
        margin-top: -24px;
    }
    </style>

    @endsection
    @push('backend-js')
    <script>
    function getDataValue(data) {
        var dt = $(data).find(':selected').attr('data-id');
        $('#model_code').val(dt);
    }
    $('input[type=radio][name=enlisted_almm]').change(function() {
        if (this.value == 0) {
            $('.enlistData').addClass('hide');
        } else if (this.value == 1) {
            $('.enlistData').removeClass('hide');
        }
    });
    </script>
    <script>
    let counter = $('#add-data tr').length;

    $(document).ready(function() {
        $(document).on('click', '.remove_fields', function() {

            $(this).closest('.record').remove();
            counter = counter - 1;

        });
        //<button type="button" class="remove_fields btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
        $("#add-row").click(function() {
            counter = counter + 1;
            markup =
                '<tr class="record"><td>' +
                counter +
                '</td><td><input type="number" min="0" step="any" name="pmax_applicable_model[]" id="pmax_applicable_model_' +
                counter +
                '" placeholder="Enter Pmax in (Wp)" class="form-control pmax_applicable_model_' +
                counter +
                '"></td><td><input type="text" name="no_of_cells[]" id="no_of_cells_' +
                counter +
                '" placeholder="Enter No of Cells & Cell Type " class="form-control"></td><td><input type="text" onkeypress="return event.charCode >= 48 && event.charCode <= 57" name="system_voltage[]" id="system_voltage_' +
                counter +
                '" placeholder="Enter System Voltage (VDC)" class="form-control"></td><td><a href="javascript:;" class="remove_fields">Delete <i class="fa fa-trash text-danger"></i></a></td></tr>';
            tableBody = $("#add-data");
            tableBody.append(markup);
        });
    });
    </script>
    @endpush