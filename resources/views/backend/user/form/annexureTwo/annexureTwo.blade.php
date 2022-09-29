@extends('layouts.masters.backend')
@section('title', 'Annexure 2 ::Bill of Material Details')
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
                            <form action="{{ URL::to('/users/annexure-two')}}" method="POST"
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

                                                </div>
                                                <div class="col-md-4">
                                                    <label for="">Main Model</label>
                                                    <input type="text" name="model_code" placeholder="Main Model"
                                                        id="model_code" class="form-control" maxlength="70" readonly
                                                        value="{{ $annexuredata->model_code ?? '' }}">
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="">Pmax (Wp) of Main Model</label>
                                                    <input type="text" name="pmax_model"
                                                        placeholder="Pmax (Wp) of Main Model" id="pmax_model"
                                                        class="form-control" maxlength="70"
                                                        value="{{ $annexuredata->pmax_model ?? '' }}">
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="">Applicable models covered under ± 5% of Mean
                                                        Wattage</label>
                                                    <input type="text" name="applicable_mean_wattage"
                                                        placeholder="Applicable models covered under ± 5% of Mean Wattage"
                                                        id="applicable_mean_wattage" class="form-control" maxlength="70"
                                                        value="{{ $annexuredata->applicable_mean_wattage ?? '' }}">
                                                </div>



                                            </div>
                                        </th>
                                    </tr>
                                    <tr>
                                        <td>
                                            <table class=" table table-bordered module_type" id="module_type3">
                                                <tr>
                                                    <th>S.No</th>
                                                    <th>Bill Material</th>
                                                    <th>Make</th>
                                                    <th>Model</th>
                                                    <th>Specification <small class="text-primary">(Max. 200
                                                            Characters)</small></th>
                                                    <th>Country of Origin</th>
                                                    <th></th>

                                                </tr>
                                                <tbody id="add-data-3">
                                                    @if($annexuredata!=null)
                                                    @php $i=0; @endphp
                                                    @foreach($annexuredata->bill_material_id as
                                                    $value)
                                                    @php $i++; @endphp
                                                    <tr>
                                                        <td>{{$i}}</td>
                                                        <td><select name="bill_material_id[]" id=""
                                                                class="form-control">
                                                                @foreach($billMaterial as $material)
                                                                <option value="{{$material->id}}" @if(isset($value) &&
                                                                    $value==$material->id)selected
                                                                    @endif>
                                                                    {{$material->bill_title}}</option>
                                                                @endforeach

                                                            </select></td>
                                                        <td><input type="text" name="make_details[]"
                                                                placeholder="Enter Make Details" id="make_details"
                                                                class="form-control" maxlength="70"
                                                                value="{{$annexuredata->make_details[$loop->iteration-1]}}">
                                                        </td>
                                                        <td> <input type="text" name="model_details[]"
                                                                id="model_details" placeholder="Enter Model Details"
                                                                value="{{$annexuredata->model_details[$loop->iteration-1]}}">
                                                        </td>
                                                        <td> <input type="text" name="specifications[]"
                                                                id="specifications"
                                                                placeholder="Enter specifiaction Details"
                                                                value="{{$annexuredata->specifications[$loop->iteration-1]}}">
                                                        </td>
                                                        <td>
                                                            @php
                                                            $selectCountry =
                                                            $annexuredata->country_origin[$loop->iteration-1];
                                                            @endphp
                                                            <select name="country_origin[]" id="country_origin"
                                                                class="form-control">
                                                                <option value="">Select Country</option>
                                                                @foreach($countries as $country)
                                                                <option value="{{$country->countrycd}}"
                                                                    @if($selectCountry==$country->countrycd)selected
                                                                    @endif>
                                                                    {{$country->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                        <td width="8%">
                                                            @if($loop->iteration==1)
                                                            <a href="javascript:;" id="add-row-3">Add
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
                                                        <td><select name="bill_material_id[]" id=""
                                                                class="form-control">
                                                                @foreach($billMaterial as $material)
                                                                <option value="{{$material->id}}">
                                                                    {{$material->bill_title}}</option>
                                                                @endforeach

                                                            </select></td>
                                                        <td><input type="text" name="make_details[]"
                                                                placeholder="Enter Make Details" id="make_details"
                                                                class="form-control" maxlength="70" value="">
                                                        </td>
                                                        <td> <input type="text" name="model_details[]"
                                                                id="model_details" placeholder="Enter Model Details"
                                                                value="">
                                                        </td>
                                                        <td> <input type="text" name="specifications[]"
                                                                id="specifications"
                                                                placeholder="Enter specifiaction Details" value="">
                                                        </td>
                                                        <td>
                                                            <select name="country_origin[]" id="country_origin"
                                                                class="form-control">
                                                                <option value="">Select Country</option>
                                                                @foreach($countries as $country)
                                                                <option value="{{$country->countrycd}}">
                                                                    {{$country->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                        <td width="8%">
                                                            <a href="javascript:;" id="add-row-3">Add
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
                                            <a href="{{URL::to('users/annexure-two/'.$application_id)}}"
                                                class="btn btn-danger"> Cancel </a>

                                        </td>
                                    </tr>
                                </table>


                            </form>
                            <table class="table table-bordered text-center">
                                <thead>
                                    <tr class="bg-warning">
                                        <th>S.No</th>
                                        <th>Type of Modules</th>
                                        <th>Main Model</th>
                                        <th width="8%">Pmax (Wp) of Main Model</th>
                                        <th width="8%">Applicable models covered under ± 5% of Mean Wattage</th>
                                        <th>Bill of Material</th>
                                        <th>Make</th>
                                        <th>Model</th>
                                        <th>Specification</th>
                                        <th>Country of Origin</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $j=0; @endphp
                                    @foreach($aryData as $data)
                                    @php $j++; @endphp
                                    <tr>
                                        <td>{{$j}}</td>
                                        <td>{{$data->module_type}}</td>
                                        <td>{{$data->model_code}}</td>
                                        <td>{{$data->pmax_model}}</td>
                                        <td>{{$data->applicable_mean_wattage}}</td>
                                        <td>
                                            <table width="100%">
                                                @foreach (json_decode($data->bill_material_id) as
                                                $bill_material_id)
                                                <tr style="border-bottom:1px solid #ccc">
                                                    <td>{{$bill_material_id}}</td>
                                                </tr>
                                                @endforeach
                                            </table>
                                        </td>

                                        <td>
                                            <table width="100%">
                                                @foreach (json_decode($data->make_details) as
                                                $make_details)
                                                <tr style="border-bottom:1px solid #ccc">
                                                    <td>{{$make_details}}</td>
                                                </tr>
                                                @endforeach
                                            </table>
                                        </td>
                                        <td>
                                            <table width="100%">
                                                @foreach (json_decode($data->model_details) as
                                                $model_details)
                                                <tr style="border-bottom:1px solid #ccc">
                                                    <td>{{$model_details}}</td>
                                                </tr>
                                                @endforeach
                                            </table>
                                        </td>
                                        <td>
                                            <table width="100%">
                                                @foreach (json_decode($data->specifications) as
                                                $specifications)
                                                <tr style="border-bottom:1px solid #ccc">
                                                    <td>{{$specifications}}</td>
                                                </tr>
                                                @endforeach
                                            </table>
                                        </td>
                                        <td>
                                            <table width="100%">
                                                @foreach (json_decode($data->country_origin) as
                                                $country_origin)
                                                <tr style="border-bottom:1px solid #ccc">
                                                    <td>{{$country_origin}}</td>
                                                </tr>
                                                @endforeach
                                            </table>
                                        </td>
                                        <td> <a
                                                href="{{URL::to('users/annexure-two/'.$data->application_id.'/'.$data->id)}}">Edit
                                                <i class="fa fa-edit"></i></a>
                                            <a href="{{URL::to('users/delete-annexure/2/'.$data->id)}}"
                                                onCLick="if (confirm('Are you sure to delete?')) { }else{ return false;}"
                                                class="text-danger">Delete <i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tr>
                                    <th colspan="13">
                                        @if(isset($aryData) && $aryData!=null)

                                        <a href="{{URL::to('users/annexure-three/'.$application_id)}}"
                                            class="btn btn-warning" style="float:right;">Next <i
                                                class="fa fa-arrow-right"></i></a>
                                        @endif
                                        <a href="{{URL::to('users/annexure-one-c/'.$application_id)}}"
                                            class="btn btn-danger" style="float:right;"><i class="fa fa-arrow-left"></i>
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
    @push('backend-js')
    <script>
    // var a = 50;
    // var b = "60";
    // alert(a + b);

    function getDataValue(data) {
        var dt = $(data).find(':selected').attr('data-id');
        $('#model_code').val(dt);
    }

    function showParameters(val) {
        $('.module_type').hide();
        $(".record" + val).remove();
        $('#module_type' + val).show();
    }
    </script>
    <script>
    let counter = $('#add-data-3 tr').length;

    $(document).ready(function() {
        $(document).on('click', '.remove_fields', function() {

            $(this).closest('.record').remove();
            counter = counter - 1;

        });
        //Operational Ratings
        $("#add-row-3").click(function() {
            counter = counter + 1;
            markup =
                '<tr class="record record3"><td>' +
                counter +
                '</td><td><select name="bill_material_id[]" id="bill_material_id' +
                counter +
                '" class="form-control"> @foreach($billMaterial as $material) <option value="{{$material->id}}"> {{$material->bill_title}}</option> @endforeach </select></td><td><input type="text" name="make_details[]" placeholder="Enter Make Details" id="make_details' +
                counter +
                '" class="form-control" maxlength="70" value=""></td><td><input type="text" name="model_details[]" id="model_details_' +
                counter +
                '" placeholder=" Enter Making Details"  class="form-control" ></td><td><input  type="text" name="specifications[]" id="specifications_' +
                counter +
                '" placeholder="Enter specifiaction Details" value="" class="form-control" ></td><td><select name="country_of_origin[]" id="country_of_origin' +
                counter +
                '" class="form-control"> <option value="">Select Country</option> @foreach($countries as $country) <option value="{{$country->countrycd}}"> {{$country->name}}</option> @endforeach </select></td><td><a href="javascript:;" class="remove_fields">Delete <i class="fa fa-trash text-danger"></i></a></td></tr>';
            tableBody = $("#add-data-3");
            tableBody.append(markup);
        });

    });
    </script>
    @endpush
