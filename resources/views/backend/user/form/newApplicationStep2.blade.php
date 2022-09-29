@extends('layouts.masters.backend')
@section('title', 'New Application Step 2')
@section('content')
@php $docBaseUrl ='users/preview-docs/Payment/';@endphp
<div class="row">
    @include('layouts.partials.backend._stepper_application')
    <div class="col-md-12">
        @include('layouts.partials.backend._flash')
        <div class="box box-primary">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="box-header with-border">
                            Details of Solar Photovoltaic (PV) Module Manufacturer

                        </div>
                        <div class="box-body">
                            <form action="{{URL::to('/users/new-application-step2')}}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('POST')
                                <table class="table table-bordered">
                                    <tr>
                                        <th width="3%">9</th>
                                        <td width="20%"> <strong>No. of Main PV Model Applied <small
                                                    class="text-danger">*</small></strong>
                                        </td>
                                        <td>
                                            <div class="row">

                                                <div class="col-md-12">
                                                    <table class="table table-bordered">
                                                        <tr>
                                                            <th>S.No</th>
                                                            <th>Technology</th>
                                                            <th>No. of Main PV Models Applied</th>
                                                            <th>Highest Pmax (in Wp)</th>
                                                            <th></th>

                                                        </tr>
                                                        <tbody id="add-data">
                                                            @if(isset($pvdata) && count($pvdata)>0)
                                                            @foreach($pvdata as $pv)
                                                            <tr>
                                                                <td>{{$loop->iteration}}</td>
                                                                <td><input type="text" name="technology[]"
                                                                        id="technology" placeholder="Enter Technology"
                                                                        value="{{ $pv->technology ?? old('technology')}}">
                                                                </td>
                                                                <td> <input type="number" min="0" name="no_pv_models[]"
                                                                        id="no_pv_models"
                                                                        placeholder="No. of Main PV Models"
                                                                        value="{{ $pv->no_pv_models ?? old('no_pv_models')}}">
                                                                </td>
                                                                <td> <input type="number" name="pmax[]" id="pmax"
                                                                        min="0" step="any"
                                                                        placeholder="Highest Pmax (in Wp)"
                                                                        value="{{ $pv->pmax ?? old('pmax')}}">
                                                                </td>
                                                                <td width="8%">
                                                                    @if($loop->iteration ==1)
                                                                    <a href="javascript:;" id="add-row">Add
                                                                        <i class="fa fa-plus text-success"></i></a>

                                                                    @else
                                                                    <a href="javascript:;" class="remove_fields">Delete
                                                                        <i class="fa fa-trash text-danger"></i></a>
                                                                    @endif
                                                                </td>

                                                            </tr>

                                                            @endforeach
                                                            @else
                                                            <tr>
                                                                <td>1</td>
                                                                <td><input type="text" name="technology[]"
                                                                        id="technology" placeholder="Enter Technology">
                                                                    @error('technology.*')
                                                                    <span class="invalid-feedback text-danger">
                                                                        {{ $message }} </span>
                                                                    @enderror
                                                                </td>
                                                                <td> <input type="number" min="0" name="no_pv_models[]"
                                                                        id="no_pv_models"
                                                                        placeholder="No. of Main PV Models">
                                                                    @error('no_pv_models.*')
                                                                    <span class="invalid-feedback text-danger">
                                                                        {{ $message }} </span>
                                                                    @enderror
                                                                </td>
                                                                <td> <input type="number" name="pmax[]" id="pmax"
                                                                        min="0" step="any"
                                                                        placeholder="Highest Pmax (in Wp)">
                                                                    @error('pmax.*')
                                                                    <span class="invalid-feedback text-danger">
                                                                        {{ $message }} </span>
                                                                    @enderror
                                                                </td>
                                                                <td width="8%"><a href="javascript:;" id="add-row">Add
                                                                        <i class="fa fa-plus text-success"></i></a>
                                                                </td>

                                                            </tr>
                                                            @endif
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="col-md-12">
                                                    <label for=""><strong>Total No. of Main PV Models
                                                            Applied:
                                                            {{ $appData->applied_pv_model ?? 'NA'}}</strong></label>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>10</th>
                                        <td width="20%"> <strong>Total PV Manufacturing Capacity <small
                                                    class="text-danger">*</small> (in
                                                MW/year)</strong>
                                            <br><br>
                                            <i>Formula for calculating PV model Manufacturing Capacity:</i><br>
                                            <br>
                                            <small> <i>
                                                    <u><span
                                                            style="margin-top: 0px; position: absolute; margin-left: -9px;font-size: 18px;">(</span>No.
                                                        of Cells Processed in an Hour</u><br>
                                                    <span style="margin-left: 15px;">No.of cells in highest Wp
                                                        PV
                                                        model</span> <br>
                                                    x Wattage of Highest Wp PV Model x
                                                    24 x 350 x 0.9)

                                                </i> </small>
                                        </td>
                                        <th>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <input type="text" name="manufacturing_capacity"
                                                        id="manufacturing_capacity" class="form-control"
                                                        placeholder="Total PV Manufacturing Capacity (in MW)"
                                                        value="{{ old('manufacturing_capacity') ?? $appData->manufacturing_capacity}}">
                                                    @error('manufacturing_capacity') <span
                                                        class="invalid-feedback custom_valid_class">
                                                        {{ $message }} </span> @enderror
                                                </div>
                                            </div>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>11</th>
                                        <td width="20%"> <strong>Whether Already Enlisted in ALMM <small
                                                    class="text-danger">*</small></strong> <br>
                                        </td>
                                        <td>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <input type="radio" name="enlisted_almm" value="0" id="" checked> No
                                                    <input type="radio" name="enlisted_almm" value="1" id=""
                                                        @if(isset($appData->enlisted_almm) && $appData->enlisted_almm
                                                    ==1 || (old('enlisted_almm')==1) ) checked @endif> Yes
                                                    <hr>

                                                </div>
                                                <div class="row col-md-12 enlistData  @if(isset($appData->enlisted_almm) && $appData->enlisted_almm
                                                    ==1 || (old('enlisted_almm')==1) ) @else hide @endif">
                                                    <div class="col-md-6">
                                                        <label for="">No. of Main PV Model Enlisted:</label>
                                                        <input type="number" name="no_enlisted_pvmodel"
                                                            id="no_enlisted_pvmodel" min="0" class="form-control"
                                                            placeholder="No. of Main PV Model Enlisted"
                                                            value="{{ old('no_enlisted_pvmodel') ?? $appData->no_enlisted_pvmodel}}">
                                                        @error('no_enlisted_pvmodel') <span
                                                            class="invalid-feedback custom_valid_class">
                                                            {{ $message }} </span> @enderror
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="">Total PV Module Manufacturing Capacity
                                                            (MW/year):</label>
                                                        <input type="number" name="total_pv_capacity"
                                                            id="total_pv_capacity" min="0" step="any"
                                                            placeholder="Total PV Module Manufacturing Capacity (MW/year)"
                                                            class="form-control"
                                                            value="{{ old('total_pv_capacity') ?? $appData->total_pv_capacity}}">
                                                        @error('total_pv_capacity') <span
                                                            class="invalid-feedback custom_valid_class">
                                                            {{ $message }} </span> @enderror
                                                    </div>
                                                    <div class="col-md-12">
                                                        <hr><label for="">ALMM Enlistment Validity:</label>

                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="">From</label>
                                                        <input type="date" name="validity_from" id="validity_from"
                                                            class="form-control"
                                                            value="{{ old('validity_from') ?? $appData->validity_from}}"><br>
                                                        @error('validity_from') <span
                                                            class="invalid-feedback custom_valid_class">
                                                            {{ $message }} </span> @enderror
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label for="">to</label>
                                                        <input type="date" name="validity_to" id="validity_to"
                                                            class="form-control"
                                                            value="{{ old('validity_to') ?? $appData->validity_to}}"><br>
                                                        @error('validity_to') <span
                                                            class="invalid-feedback custom_valid_class">
                                                            {{ $message }} </span> @enderror
                                                    </div>
                                                </div>

                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>12</th>
                                        <td width="20%"> <strong>Details of Payment of Fee <small
                                                    class="text-danger">*</small></strong>
                                            <br><br><br><br><br>
                                            
                                        </td>
                                        <td>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label for="">Application Fees:</label>
                                                    <input type="number" name="application_fees" step="any"
                                                        id="application_fees" min="0" class="form-control"
                                                        value="{{ old('application_fees') ?? $appData->application_fees}}">
                                                    @error('application_fees') <span
                                                        class="invalid-feedback custom_valid_class">
                                                        {{ $message }} </span> @enderror
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="">Inspection Fees:</label>
                                                    <input type="number" name="inspection_fees" step="any"
                                                        id="inspection_fees" min="0" class="form-control"
                                                        value="{{ old('inspection_fees') ?? $appData->inspection_fees}}">
                                                    @error('inspection_fees') <span
                                                        class="invalid-feedback custom_valid_class">
                                                        {{ $message }} </span> @enderror
                                                </div>
                                                <div class=" col-md-6">
                                                    <label for="">Mode of Payment:</label>
                                                    <select name="payment_mode" class="form-control" id="payment_mode">
                                                        <option value="">payment mode</option>
                                                        <option value="1" @if(isset($appData->payment_mode) &&
                                                            $appData->payment_mode==1)selected @endif>Online</option>
                                                        <option value="2" @if(isset($appData->payment_mode) &&
                                                            $appData->payment_mode==2)selected @endif>Offline</option>
                                                    </select>
                                                    @error('payment_mode') <span
                                                        class="invalid-feedback custom_valid_class">
                                                        {{ $message }} </span> @enderror
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="">Total Amount Paid:</label>
                                                    <input type="number" name="total_amount" id="total_amount" min="0"
                                                        step="any" class="form-control"
                                                        value="{{ old('total_amount') ?? $appData->total_amount}}">
                                                    @error('total_amount') <span
                                                        class="invalid-feedback custom_valid_class">
                                                        {{ $message }} </span> @enderror
                                                </div>
                                                <div style="clear:both"></div>

                                                <div class="col-md-6">
                                                    <label for="">Payment Date:</label>
                                                    <input type="date" name="payment_date" id="payment_date"
                                                        class="form-control"
                                                        value="{{ old('payment_date') ?? $appData->payment_date}}"><br>
                                                    @error('payment_date') <span
                                                        class="invalid-feedback custom_valid_class">
                                                        {{ $message }} </span> @enderror
                                                </div>

                                                <div class="col-md-6">
                                                    <label for="">UTR/reference No:</label>
                                                    <input type="text" name="utn_no" id="utn_no" class="form-control"
                                                        value="{{ old('utn_no') ?? $appData->utn_no}}">
                                                    @error('utn_no') <span class="invalid-feedback custom_valid_class">
                                                        {{ $message }} </span> @enderror
                                                </div>


                                            </div>
                                        </td>

                                    </tr>
                                    <!-- <tr>
                                        <th>13</th>
                                        <td width="20%"> <strong>Proposed Date for Inspection <small
                                                    class="text-danger">*</small></strong></td>
                                        <th>
                                             ALTER TABLE `application_details` ADD `inspection_date` DATE NULL DEFAULT NULL AFTER `utn_no`; 
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <input type="date" name="inspection_date" id="inspection_date"
                                                        class="form-control" placeholder="Proposed date for Inspection"
                                                        value="{{ old('inspection_date') ?? $appData->inspection_date}}">
                                                    @error('inspection_date') <span
                                                        class="invalid-feedback custom_valid_class">
                                                        {{ $message }} </span> @enderror
                                                </div>
                                            </div>
                                        </th>
                                    </tr> -->
                                    <tr>
                                        <th colspan="3">
                                            <input type="submit" name="submit"
                                                value="@if(isset($appData->id) && $appData->step2 !='')Update @else Save @endif"
                                                class="btn btn-success" id="">
                                            <input type="hidden" name="edit_id" id="edit_id" value="{{$appData->id}}">
                                            @if(isset($appData->id) && $appData->step2 !='')

                                            <a href="{{URL::to('users/annexure-one/'.$appData->id)}}"
                                                class="btn btn-warning" style="float:right">Next <i
                                                    class="fa fa-arrow-right"></i></a>

                                            <input type="hidden" name="step1" id="step1" value="{{$appData->step2}}">
                                            @endif
                                            <a href="{{URL::to('users/new-application/'.$appData->id)}}"
                                                class="btn btn-danger" style="float:right"><i
                                                    class="fa fa-arrow-left"></i> Back </a>


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
                counter + '</td><td><input type="text" class="form-control courseid_input_' +
                counter + '" name="technology[]" id="technology_' + counter +
                '" placeholder="Enter Technology"></td><td><input type="text" onkeypress="return event.charCode >= 48 && event.charCode <= 57" name="no_pv_models[]" id="no_pv_models_' +
                counter + '" placeholder="No. of Main PV Models" class="form-control no_pv_models_' +
                counter +
                '"></td><td><input type="number" step="any" min="0" name="pmax[]" id="pmax_' +
                counter +
                '" placeholder="Highest Pmax (in Wp)" class="form-control"></td><td><a href="javascript:;" class="remove_fields">Delete <i class="fa fa-trash text-danger"></i></a></td></tr>';
            tableBody = $("#add-data");
            tableBody.append(markup);
        });
    });
    </script>
    @endpush
