@extends('layouts.masters.backend')
@section('title', 'Annexure 3 :: BIS Certification and Module Test Reports Details')
@section('content')
@php $docBaseUrl ='users/preview-docs/Annexure/';
@endphp
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
                            <form action="{{ URL::to('/users/annexure-three')}}" method="POST"
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
                                                <div class="col-md-4">
                                                    <label for="">Pmax (Wp) of Applicable Models Model</label>
                                                    <input type="number" name="pmax_watt"
                                                        placeholder="Pmax (Wp) of Applicable Models Model"
                                                        id="pmax_watt" class="form-control" step="any" min="0"
                                                        value="{{ $annexuredata->pmax_watt ?? '' }}">
                                                </div>
                                                
                                                <div class="col-md-4">
                                                    <label for="">Details Type</label>
                                                    <select name="sub_annexure" id="sub_annexure" class="form-control"
                                                        onChange="showDetailType(this.value)">
                                                        <option value="">Select</option>
                                                        <option value="1" @if(isset($annexuredata->
                                                            sub_annexure) &&
                                                            $annexuredata->sub_annexure==1)selected @endif>BIS
                                                            Certification Details</option>
                                                        <option value="2" @if(isset($annexuredata->
                                                            sub_annexure) &&
                                                            $annexuredata->sub_annexure==2)selected @endif>Module Test
                                                            Reports Details</option>
                                                    </select>
                                                </div>
                                                <span id="detail_type_1"
                                                    style="display:@if($annexuredata!=null && $annexuredata->sub_annexure==1)  @else none @endif">
                                                    <table class="table">
                                                        <tr>
                                                            <td>
                                                                <div class="col-md-12">
                                                                    <label for="">BIS Certificate No.</label>
                                                                    <input type="text" name="bis_certificate_no"
                                                                        placeholder="BIS Certificate No." id="bis_certificate_no"
                                                                        class="form-control" maxlength="70"
                                                                        value="{{ $annexuredata->bis_certificate_no ?? '' }}">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="col-md-12">
                                                                    <label for="">BIS Certificate issue date</label>
                                                                    <input type="date" name="bis_certificate_issue"
                                                                        placeholder="BIS Certificate issue date"
                                                                        id="bis_certificate_issue" class="form-control"
                                                                        maxlength="70"
                                                                        value="{{ $annexuredata->bis_certificate_issue ?? '' }}">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="col-md-12">
                                                                    <label for="">BIS Certificate Valid Upto</label>
                                                                    <input type="date" name="bis_certificate_valid"
                                                                        placeholder="BIS Certificate issue date"
                                                                        id="bis_certificate_valid" class="form-control"
                                                                        maxlength="70"
                                                                        value="{{ $annexuredata->bis_certificate_valid ?? '' }}">
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="3">
                                                            <div class="col-md-12">
                                                                <label for="">BIS Certificate</label>
                                                                <input type="file" name="bis_certificate" id="bis_certificate" class="form-control">
                                                                @if(($annexuredata->doc_certificate ?? '')!=null)
                                                                <input type="hidden" name="old_bis_certificate" id="">
                                                                <small><a target="_blank"
                                                                        href="{{URL::to($docBaseUrl.$annexuredata->doc_certificate)}}"
                                                                        class="document">View Certificate</a></small>@endif
                                                            </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    
                                                    
                                                    
                                                    
                                                </span>
                                                <span id="detail_type_2"
                                                    style="display:@if($annexuredata!=null && $annexuredata->sub_annexure==2)  @else none @endif">
                                                    <table class="table">
                                                        <tr>
                                                            <td>
                                                                <div class="col-md-12">
                                                                    <label for="">Testing Standards</label>
                                                                    <input type="text" name="test_standard_module"
                                                                        placeholder="Testing Standards" id="test_standard_module"
                                                                        class="form-control" maxlength="100"
                                                                        value="{{ $annexuredata->test_standard_module ?? '' }}">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="col-md-12">
                                                                    <label for="">Test Report No.</label>
                                                                    <input type="text" name="test_report_no"
                                                                        placeholder="Test Report No." id="test_report_no"
                                                                        class="form-control" maxlength="70"
                                                                        value="{{ $annexuredata->test_report_no ?? '' }}">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="col-md-12">
                                                                    <label for="">Testing Laboratory</label>
                                                                    <input type="text" name="testing_laboratory"
                                                                        placeholder="Testing Laboratory" id="testing_laboratory"
                                                                        class="form-control" maxlength="70"
                                                                        value="{{ $annexuredata->testing_laboratory ?? '' }}">
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div class="col-md-12">
                                                                    <label for="">Testing Laboratory Address</label>
                                                                    <input type="text" name="testing_laboratory_address"
                                                                        placeholder="Testing Laboratory Address"
                                                                        id="testing_laboratory_address" class="form-control"
                                                                        value="{{ $annexuredata->testing_laboratory_address ?? '' }}">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="col-md-12">
                                                                    <label for="">Valid NABL Certificate No. of Test Laboratory at
                                                                        the time of testing</label>
                                                                    <input type="text" name="valid_nabl_certificate_no"
                                                                        placeholder="Valid NABL Certificate No. of Test Laboratory at the time of testing"
                                                                        id="valid_nabl_certificate_no" class="form-control"
                                                                        value="{{ $annexuredata->valid_nabl_certificate_no ?? '' }}">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="col-md-12">
                                                                    <label for="">NABL Certificate</label>
                                                                    <input type="file" name="nabl_certificate" id="nabl_certificate" class="form-control">
                                                                    @if(($annexuredata->nabl_certificate ?? '')!=null)
                                                                    <input type="hidden" name="old_nabl_certificate" id="">
                                                                    <small><a target="_blank"
                                                                            href="{{URL::to($docBaseUrl.$annexuredata->doc_certificate)}}"
                                                                            class="document">View Certificate</a></small>@endif
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    
                                                    
                                                    
                                                    
                                                    
                                                </span>



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
                                            <a href="{{URL::to('users/annexure-two/'.$application_id)}}"
                                                class="btn btn-danger"> Cancel </a>

                                        </td>
                                    </tr>
                                </table>


                            </form>
                            <table class="table table-bordered text-center">
                                <thead>
                                    <tr>
                                        <th colspan="9" class=" text-left">4.1 BIS Certification Details</th>
                                    </tr>
                                    <tr class="bg-warning">
                                        <th>S.No</th>
                                        <th>Type of Modules</th>
                                        <th>Main Model</th>
                                        <th width="8%">Pmax (Wp) of Main Model</th>
                                        <th width="8%">Applicable models covered under ± 5% of Mean Wattage</th>
                                        
                                        <th>BIS Certificate Issue</th>
                                        <th>BIS Certificate Valid</th>
                                        <th>BIS Certificate No.</th>
                                        <th>Certificate</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $j = 1 @endphp
                                    @foreach($appData as $sub_annex_1)
                                    @if($sub_annex_1->sub_annexure ==1)
                                    <tr>
                                        <td>{{$j++}}</td>
                                        <td>{{$sub_annex_1->module_type}}</td>
                                        <td>{{$sub_annex_1->model_code}}</td>
                                        <td>{{$sub_annex_1->pmax_model}}</td>
                                        <td>{{$sub_annex_1->applicable_mean_wattage}}</td>
                                        
                                        <td>{{$sub_annex_1->bis_certificate_issue}}</td>
                                        <td>{{$sub_annex_1->bis_certificate_valid}}</td>
                                        <td>{{$sub_annex_1->bis_certificate_no}}</td>
                                        <td>@if(($sub_annex_1->doc_certificate ?? '')!=null)
                                                <small><a target="_blank"
                                                        href="{{URL::to($docBaseUrl.$sub_annex_1->doc_certificate)}}"
                                                        class="document text-primary"><i class="bi bi-file-pdf fa-2x text-danger"></i></a></small>@endif</td>
                                        <td> <a
                                                href="{{URL::to('users/annexure-three/'.$sub_annex_1->application_id.'/'.$sub_annex_1->id)}}">Edit
                                                <i class="fa fa-edit"></i></a>
                                            <a href="{{URL::to('users/delete-annexure/3/'.$sub_annex_1->id)}}"
                                                onCLick="if (confirm('Are you sure to delete?')) { }else{ return false;}"
                                                class="text-danger">Delete <i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    @endif
                                    @endforeach
                                </tbody>

                            </table>
                            <br>
                            <table class="table table-bordered text-center">
                                <thead>
                                    <tr>
                                        <th colspan="9" class=" text-left">4.2 Module Test Reports Details</th>
                                    </tr>
                                    <tr class="bg-warning">
                                        <th>S.No</th>
                                        <th>Type of Modules</th>
                                        <th>Main Model</th>
                                        <th width="8%">Pmax (Wp) of Main Model</th>
                                        <th width="8%">Applicable models covered under ± 5% of Mean Wattage</th>
                                        <th>Testing Standards</th>
                                        <th>Test Report No.</th>
                                        <th>Testing Laboratory</th>
                                        <th>Testing Laboratory Address</th>
                                        <th>Valid NABL Certificate No. of Test Laboratory at the time of testing</th>
                                        <th>Certificate</th>
                                        <th width="10%"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $i = 1 @endphp
                                    @foreach($appData as $sub_annex_2)

                                    @if($sub_annex_2->sub_annexure ==2)
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>{{$sub_annex_2->module_type}}</td>
                                        <td>{{$sub_annex_2->model_code}}</td>
                                        <td>{{$sub_annex_2->pmax_model}}</td>
                                        <td>{{$sub_annex_2->applicable_mean_wattage}}</td>
                                        <td>{{$sub_annex_2->test_standard_module}}</td>
                                        <td>{{$sub_annex_2->test_report_no}}</td>
                                        <td>{{$sub_annex_2->testing_laboratory}}</td>
                                        <td>{{$sub_annex_2->testing_laboratory_address}}</td>
                                        <td>{{$sub_annex_2->valid_nabl_certificate_no}}</td>
                                        <td>@if(($sub_annex_2->doc_certificate ?? '')!=null)
                                                <small><a target="_blank"
                                                        href="{{URL::to($docBaseUrl.$sub_annex_2->doc_certificate)}}"
                                                        class="document text-primary"><i class="bi bi-file-pdf fa-2x text-danger"></i></a></small>@endif</td>
                                        </td>
                                        <td> <a
                                                href="{{URL::to('users/annexure-three/'.$sub_annex_2->application_id.'/'.$sub_annex_2->id)}}">Edit
                                                <i class="fa fa-edit"></i></a>
                                            <a href="{{URL::to('users/delete-annexure/3/'.$sub_annex_2->id)}}"
                                                onCLick="if (confirm('Are you sure to delete?')) { }else{ return false;}"
                                                class="text-danger">Delete <i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    @endif
                                    @endforeach
                                </tbody>

                            </table>
                            <table class="table text-center">
                                <tr>
                                    <th colspan="13">
                                        @if(!$appData->isEmpty())
                                        <a href="{{URL::to('users/annexure-four/'.$application_id)}}"
                                            class="btn btn-warning" style="float:right;">Next <i
                                                class="fa fa-arrow-right"></i></a>
                                        @endif
                                        <a href="{{URL::to('users/annexure-two/'.$application_id)}}"
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
    function getDataValue(data) {
        var dt = $(data).find(':selected').attr('data-id');
        $('#model_code').val(dt);
    }

    function showDetailType(type) {
        $('#detail_type_2').hide();
        $('#detail_type_1').hide();
        if (type == 1) {
            $('#detail_type_1').show();
        } else {
            $('#detail_type_2').show();
        }

    }

    function showParameters(val) {
        $('.module_type').hide();
        $(".record" + val).remove();
        $('#module_type' + val).show();
    }
    </script>
    @endpush
