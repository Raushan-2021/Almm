@extends('layouts.masters.backend')
@section('title', 'Annexure Attachment')
@section('content')
@php $docBaseUrl ='users/preview-docs/Attachment/';
@endphp
<div class="row">
    @include('layouts.partials.backend._stepper_application')
    <div class="col-md-12">
        @include('layouts.partials.backend._flash')
        <div class="box box-primary">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">

                        <div class="box-body">

                            <form action="{{ URL::to('/users/annexure-attachment')}}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('POST')
                                <br>
                                <table class="table table-bordered">
                                    <tr>
                                        <th width="5%">S.No</th>
                                        <th>Attachment Title</th>
                                        <th width="20%">Available</th>
                                        <th width="10%"></th>
                                    </tr>
                                    <tr>
                                        <th> 1</th>
                                        <td>Copy of Certificate of Incorporation of the applying entity issued by
                                            Registrar
                                            of Companies, Ministry of Corporate Affairs, Government of India.</td>
                                        <td>
                                            @if(($appData->attc_incorporation_cerificate ?? '')!=null)
                                            <i class="fa fa-check text-success"></i> Yes <a
                                                href="{{URL::to('users/annexure-attachment/'.$application_id.'/attachment_1')}}"
                                                onCLick="if (confirm('Are you sure to delete?')) { }else{ return false;}"
                                                class="text-danger">Remove <i class="fa fa-trash"></i></a>
                                            @else
                                            <input type="radio" value="0" name="rdo_incorporation_cerificate" id=""
                                                checked>No
                                            <input type="radio" value="1" name="rdo_incorporation_cerificate" id="">Yes
                                            @error('attc_incorporation_cerificate') <span class="valid_class">
                                                {{ $message }} </span> @enderror

                                            @endif
                                            <input type="file" name="attc_incorporation_cerificate"
                                                id="incorporation_cerificate" class="hide" onchange="form.submit()">

                                        </td>
                                        <td>
                                            @if(($appData->attc_incorporation_cerificate ?? '')!=null)
                                            <small><a target="_blank"
                                                    href="{{URL::to($docBaseUrl.$appData->attc_incorporation_cerificate)}}"
                                                    class="document">Attachment No. 1</a></small>@endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th> 2</th>
                                        <td>Details of Payment of Application and Inspection Fee</td>
                                        <td>
                                            @if(($appData->attc_application_inspection_payment ?? '')!=null)
                                            <i class="fa fa-check text-success"></i> Yes <a
                                                href="{{URL::to('users/annexure-attachment/'.$application_id.'/attachment_2')}}"
                                                onCLick="if (confirm('Are you sure to delete?')) { }else{ return false;}"
                                                class="text-danger">Remove <i class="fa fa-trash"></i></a>
                                            @else
                                            <input type="radio" value="0" name="rdo_application_inspection_payment"
                                                id="" checked>No
                                            <input type="radio" value="1" name="rdo_application_inspection_payment"
                                                id="">Yes
                                            @error('attc_application_inspection_payment') <span class="valid_class">
                                                {{ $message }} </span> @enderror
                                            @endif

                                            <input type="file" name="attc_application_inspection_payment"
                                                id="application_inspection_payment" class="hide"
                                                onchange="form.submit()">
                                        </td>
                                        <td>@if(($appData->attc_application_inspection_payment ?? '')!=null)
                                            <small><a target="_blank"
                                                    href="{{URL::to($docBaseUrl.$appData->attc_application_inspection_payment)}}"
                                                    class="document">Attachment No. 2</a></small>@endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th> 3</th>
                                        <td>Datasheets of the modules applied for enlistment in ALMM</td>
                                        <td>
                                            @if(($appData->attc_enlisted_module_datalist ?? '')!=null)
                                            <i class="fa fa-check text-success"></i> Yes <a
                                                href="{{URL::to('users/annexure-attachment/'.$application_id.'/attachment_3')}}"
                                                onCLick="if (confirm('Are you sure to delete?')) { }else{ return false;}"
                                                class="text-danger">Remove <i class="fa fa-trash"></i></a>
                                            @else
                                            <input type="radio" value="0" name="rdo_enlisted_module_datalist" id=""
                                                checked>No
                                            <input type="radio" value="1" name="rdo_enlisted_module_datalist" id="">Yes
                                            @error('attc_enlisted_module_datalist') <span class="valid_class">
                                                {{ $message }} </span> @enderror
                                            @endif
                                            <input type="file" name="attc_enlisted_module_datalist"
                                                id="enlisted_module_datalist" class="hide" onchange="form.submit()">
                                        </td>
                                        <td>@if(($appData->attc_enlisted_module_datalist ?? '')!=null)
                                            <small><a target="_blank"
                                                    href="{{URL::to($docBaseUrl.$appData->attc_enlisted_module_datalist)}}"
                                                    class="document">Attachment No. 3</a></small>@endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th> 4</th>
                                        <td>Datasheets of the solar cells used in the modules</td>
                                        <td>
                                            @if(($appData->attc_solar_cell_datalist ?? '')!=null)
                                            <i class="fa fa-check text-success"></i> Yes <a
                                                href="{{URL::to('users/annexure-attachment/'.$application_id.'/attachment_4')}}"
                                                onCLick="if (confirm('Are you sure to delete?')) { }else{ return false;}"
                                                class="text-danger">Remove <i class="fa fa-trash"></i></a>
                                            @else
                                            <input type="radio" value="0" name="rdo_solar_cell_datalist" id=""
                                                checked>No
                                            <input type="radio" value="1" name="rdo_solar_cell_datalist" id="">Yes
                                            @error('attc_solar_cell_datalist') <span class="valid_class">
                                                {{ $message }} </span> @enderror
                                            @endif
                                            <input type="file" name="attc_solar_cell_datalist" id="solar_cell_datalist"
                                                class="hide" onchange="form.submit()">
                                        </td>
                                        <td>@if(($appData->attc_solar_cell_datalist ?? '')!=null)
                                            <small><a target="_blank"
                                                    href="{{URL::to($docBaseUrl.$appData->attc_solar_cell_datalist)}}"
                                                    class="document">Attachment No. 4</a></small>@endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th> 5</th>
                                        <td>Details of Balance of Materials as sought in Application Form</td>
                                        <td>
                                            @if(($appData->attc_bom_details ?? '')!=null)
                                            <i class="fa fa-check text-success"></i> Yes <a
                                                href="{{URL::to('users/annexure-attachment/'.$application_id.'/attachment_5')}}"
                                                onCLick="if (confirm('Are you sure to delete?')) { }else{ return false;}"
                                                class="text-danger">Remove <i class="fa fa-trash"></i></a>
                                            @else
                                            <input type="radio" value="0" name="rdo_bom_details" id="" checked>No
                                            <input type="radio" value="1" name="rdo_bom_details" id="">Yes
                                            @error('attc_bom_details') <span class="valid_class">
                                                {{ $message }} </span> @enderror
                                            @endif
                                            <input type="file" name="attc_bom_details" id="bom_details" class="hide"
                                                onchange="form.submit()">
                                        </td>
                                        <td>@if(($appData->attc_bom_details ?? '')!=null)
                                            <small><a target="_blank"
                                                    href="{{URL::to($docBaseUrl.$appData->attc_bom_details)}}"
                                                    class="document">Attachment No. 5</a></small>@endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th> 6</th>
                                        <td>Copy of Certificate for BIS Registration/ Certification</td>
                                        <td>
                                            @if(($appData->attc_bis_certificate ?? '')!=null)
                                            <i class="fa fa-check text-success"></i> Yes <a
                                                href="{{URL::to('users/annexure-attachment/'.$application_id.'/attachment_6')}}"
                                                onCLick="if (confirm('Are you sure to delete?')) { }else{ return false;}"
                                                class="text-danger">Remove <i class="fa fa-trash"></i></a>
                                            @else
                                            <input type="radio" value="0" name="rdo_bis_certificate" id="" checked>No
                                            <input type="radio" value="1" name="rdo_bis_certificate" id="">Yes
                                            @error('attc_bis_certificate') <span class="valid_class">
                                                {{ $message }} </span> @enderror
                                            @endif
                                            <input type="file" name="attc_bis_certificate" id="bis_certificate"
                                                class="hide" onchange="form.submit()">
                                        </td>
                                        <td><a href="">@if(($appData->attc_bis_certificate ?? '')!=null)
                                                <small><a target="_blank"
                                                        href="{{URL::to($docBaseUrl.$appData->attc_bis_certificate)}}"
                                                        class="document">Attachment No. 6</a></small>@endif</a></td>
                                    </tr>
                                    <tr>
                                        <th> 7</th>
                                        <td>Copy of the Accreditation Certificate of the Lab which has given test
                                            certificates required for BIS Registration/ Certification</td>
                                        <td>
                                            @if(($appData->attc_accreditation_certificate ?? '')!=null)
                                            <i class="fa fa-check text-success"></i> Yes <a
                                                href="{{URL::to('users/annexure-attachment/'.$application_id.'/attachment_7')}}"
                                                onCLick="if (confirm('Are you sure to delete?')) { }else{ return false;}"
                                                class="text-danger">Remove <i class="fa fa-trash"></i></a>
                                            @else
                                            <input type="radio" value="0" name="rdo_accreditation_certificate" id=""
                                                checked>No
                                            <input type="radio" value="1" name="rdo_accreditation_certificate" id="">Yes
                                            @error('attc_accreditation_certificate') <span class="valid_class">
                                                {{ $message }} </span> @enderror
                                            @endif
                                            <input type="file" name="attc_accreditation_certificate"
                                                id="accreditation_certificate" class="hide" onchange="form.submit()">
                                        </td>
                                        <td><a href="">@if(($appData->attc_accreditation_certificate ?? '')!=null)
                                                <small><a target="_blank"
                                                        href="{{URL::to($docBaseUrl.$appData->attc_accreditation_certificate)}}"
                                                        class="document">Attachment No. 7</a></small>@endif</a></td>
                                    </tr>
                                    <tr>
                                        <th> 8</th>
                                        <td>Calibration Report of Sun Simulator</td>
                                        <td>
                                            @if(($appData->attc_calibration_report_sun_simulator ?? '')!=null)
                                            <i class="fa fa-check text-success"></i> Yes <a
                                                href="{{URL::to('users/annexure-attachment/'.$application_id.'/attachment_8')}}"
                                                onCLick="if (confirm('Are you sure to delete?')) { }else{ return false;}"
                                                class="text-danger">Remove <i class="fa fa-trash"></i></a>
                                            @else
                                            <input type="radio" value="0" name="rdo_calibration_report_sun_simulator"
                                                id="" checked>No
                                            <input type="radio" value="1"
                                                name="rdo_calibration_report_sun_simulator">Yes
                                            @error('attc_calibration_report_sun_simulator') <span class="valid_class">
                                                {{ $message }} </span> @enderror

                                            @endif
                                            <input type="file" name="attc_calibration_report_sun_simulator"
                                                id="calibration_report_sun_simulator" class="hide"
                                                onchange="form.submit()">
                                        </td>
                                        <td><a href="">@if(($appData->attc_calibration_report_sun_simulator ??
                                                '')!=null)
                                                <small><a target="_blank"
                                                        href="{{URL::to($docBaseUrl.$appData->attc_calibration_report_sun_simulator)}}"
                                                        class="document">Attachment No. 8</a></small>@endif</a></td>
                                    </tr>
                                    <!-- <tr>
                                        <th>9</th>
                                        <td>Calibration Report of Golden and Silver Module</td>
                                        <td>
                                            @if(($appData->attc_calibration_report_module ?? '')!=null)
                                            <i class="fa fa-check text-success"></i> Yes <a
                                                href="{{URL::to('users/annexure-attachment/'.$application_id.'/attachment_9')}}"
                                                onCLick="if (confirm('Are you sure to delete?')) { }else{ return false;}"
                                                class="text-danger">Remove <i class="fa fa-trash"></i></a>
                                            @else
                                            <input type="radio" value="0" name="rdo_calibration_report_module" id=""
                                                checked>No
                                            <input type="radio" value="1" name="rdo_calibration_report_module" id="">Yes
                                            @error('attc_calibration_report_module') <span class="valid_class">
                                                {{ $message }} </span> @enderror

                                            @endif
                                            <input type="file" name="attc_calibration_report_module"
                                                id="calibration_report_module" class="hide" onchange="form.submit()">
                                        </td>
                                        <td><a href="">@if(($appData->attc_calibration_report_module ?? '')!=null)
                                                <small><a target="_blank"
                                                        href="{{URL::to($docBaseUrl.$appData->attc_calibration_report_module)}}"
                                                        class="document">Attachment No. 9</a></small>@endif</a></td>
                                    </tr> -->
                                    <tr>
                                        <th> 9</th>
                                        <td>Copy of valid ISO Certificate for quality management system. Copy of
                                            Accreditation certificate of ISO certifying body</td>
                                        <td>
                                            @if(($appData->attc_iso_certificate ?? '')!=null)
                                            <i class="fa fa-check text-success"></i> Yes <a
                                                href="{{URL::to('users/annexure-attachment/'.$application_id.'/attachment_10')}}"
                                                onCLick="if (confirm('Are you sure to delete?')) { }else{ return false;}"
                                                class="text-danger">Remove <i class="fa fa-trash"></i></a>
                                            @else
                                            <input type="radio" value="0" name="rdo_iso_certificate" id="" checked>No
                                            <input type="radio" value="1" name="rdo_iso_certificate" id="">Yes
                                            @error('attc_iso_certificate') <span class="valid_class">
                                                {{ $message }} </span> @enderror

                                            @endif
                                            <input type="file" name="attc_iso_certificate" id="iso_certificate"
                                                class="hide" onchange="form.submit()">
                                        </td>
                                        <td><a href="">@if(($appData->attc_iso_certificate ?? '')!=null)
                                                <small><a target="_blank"
                                                        href="{{URL::to($docBaseUrl.$appData->attc_iso_certificate)}}"
                                                        class="document">Attachment No. 10</a></small>@endif</a></td>
                                    </tr>
                                    <tr>
                                        <th> 10</th>
                                        <td>Balance Sheet for last three years or the period of existence of such units,
                                            whichever is less</td>
                                        <td>
                                            @if(($appData->attc_balance_sheet_last_years ?? '')!=null)
                                            <i class="fa fa-check text-success"></i> Yes <a
                                                href="{{URL::to('users/annexure-attachment/'.$application_id.'/attachment_11')}}"
                                                onCLick="if (confirm('Are you sure to delete?')) { }else{ return false;}"
                                                class="text-danger">Remove <i class="fa fa-trash"></i></a>
                                            @else
                                            <input type="radio" value="0" name="rdo_balance_sheet_last_years" id=""
                                                checked>No
                                            <input type="radio" value="1" name="rdo_balance_sheet_last_years" id="">Yes
                                            @error('attc_balance_sheet_last_years') <span class="valid_class">
                                                {{ $message }} </span> @enderror

                                            @endif
                                            <input type="file" name="attc_balance_sheet_last_years"
                                                id="balance_sheet_last_years" class="hide" onchange="form.submit()">
                                        </td>
                                        <td><a href="">@if(($appData->attc_balance_sheet_last_years ?? '')!=null)
                                                <small><a target="_blank"
                                                        href="{{URL::to($docBaseUrl.$appData->attc_balance_sheet_last_years)}}"
                                                        class="document">Attachment No. 10</a></small>@endif</a></td>
                                    </tr>
                                    <tr>
                                        <th> 11</th>
                                        <td>Trademark Registration Certificate</td>
                                        <td>
                                            @if(($appData->attc_trademark_certificate ?? '')!=null)
                                            <i class="fa fa-check text-success"></i> Yes <a
                                                href="{{URL::to('users/annexure-attachment/'.$application_id.'/attachment_12')}}"
                                                onCLick="if (confirm('Are you sure to delete?')) { }else{ return false;}"
                                                class="text-danger">Remove <i class="fa fa-trash"></i></a>
                                            @else
                                            <input type="radio" value="0" name="rdo_trademark_certificate" id=""
                                                checked>No
                                            <input type="radio" value="1" name="rdo_trademark_certificate" id="">Yes
                                            @error('attc_trademark_certificate') <span class="valid_class">
                                                {{ $message }} </span> @enderror

                                            @endif
                                            <input type="file" name="attc_trademark_certificate"
                                                id="trademark_certificate" class="hide" onchange="form.submit()">
                                        </td>
                                        <td><a href="">@if(($appData->attc_trademark_certificate ?? '')!=null)
                                                <small><a target="_blank"
                                                        href="{{URL::to($docBaseUrl.$appData->attc_trademark_certificate)}}"
                                                        class="document">Attachment No. 11</a></small>@endif</a></td>
                                    </tr>
                                    <tr>
                                        <th> 12</th>
                                        <td>Construction Data Form(CDF) from BIS lab Report</td>
                                        <td>
                                            @if(($appData->attc_bis_lab_report ?? '')!=null)
                                            <i class="fa fa-check text-success"></i> Yes <a
                                                href="{{URL::to('users/annexure-attachment/'.$application_id.'/attachment_13')}}"
                                                onCLick="if (confirm('Are you sure to delete?')) { }else{ return false;}"
                                                class="text-danger">Remove <i class="fa fa-trash"></i></a>
                                            @else
                                            <input type="radio" value="0" name="rdo_bis_lab_report" id=""
                                                checked>No
                                            <input type="radio" value="1" name="rdo_bis_lab_report" id="">Yes
                                            @error('attc_bis_lab_report') <span class="valid_class">
                                                {{ $message }} </span> @enderror

                                            @endif
                                            <input type="file" name="attc_bis_lab_report"
                                                id="bis_lab_report" class="hide" onchange="form.submit()">
                                        </td>
                                        <td><a href="">@if(($appData->attc_bis_lab_report ?? '')!=null)
                                                <small><a target="_blank"
                                                        href="{{URL::to($docBaseUrl.$appData->attc_bis_lab_report)}}"
                                                        class="document">Attachment No. 12</a></small>@endif</a></td>
                                    </tr>
                                </table>

                                <br>
                                <table class="table table-bordered">
                                    <tr>
                                        <th colspan="13">
                                            @if($appData->attachment_uploaded==1)

                                            <a href="{{URL::to('users/application-submission/'.$application_id)}}"
                                                class="btn btn-warning" style="float:right">Next <i
                                                    class="fa fa-arrow-right"></i></a>
                                            @endif
                                            <input type="hidden" name="application_id" id="application_id"
                                                value="{{$application_id}}">
                                            <a href="{{URL::to('users/annexure-eight/'.$application_id)}}"
                                                class="btn btn-primary" style="float:right"><i
                                                    class="fa fa-arrow-left"></i>
                                                Back </a>

                                        </th>
                                    </tr>
                                </table>
                                <input type="hidden" name="application_id" value="{{$application_id}}" id="">
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

    .valid_class {
        color: #e73434;
        font-weight: 100;
        font-family: arial;
        font-size: 11px;
        /* margin-top: -14px; */
        /* position: absolute; */
        display: block;
    }

    </style>
    @endsection
    @push('backend-js')
    <script>
    $('input:radio[name="rdo_incorporation_cerificate"]').change(
        function() {
            $('#incorporation_cerificate').addClass('hide');
            if ($(this).val() == 1) {
                $('#incorporation_cerificate').removeClass('hide');
            }
        });
    $('input:radio[name="rdo_application_inspection_payment"]').change(
        function() {
            $('#application_inspection_payment').addClass('hide');
            if ($(this).val() == 1) {
                $('#application_inspection_payment').removeClass('hide');
            }
        });
    $('input:radio[name="rdo_enlisted_module_datalist"]').change(
        function() {
            $('#enlisted_module_datalist').addClass('hide');
            if ($(this).val() == 1) {
                $('#enlisted_module_datalist').removeClass('hide');
            }
        });
    $('input:radio[name="rdo_solar_cell_datalist"]').change(
        function() {
            $('#solar_cell_datalist').addClass('hide');
            if ($(this).val() == 1) {
                $('#solar_cell_datalist').removeClass('hide');
            }
        });
    $('input:radio[name="rdo_bom_details"]').change(
        function() {
            $('#bom_details').addClass('hide');
            if ($(this).val() == 1) {
                $('#bom_details').removeClass('hide');
            }
        });
    $('input:radio[name="rdo_bis_certificate"]').change(
        function() {
            $('#bis_certificate').addClass('hide');
            if ($(this).val() == 1) {
                $('#bis_certificate').removeClass('hide');
            }
        });
    $('input:radio[name="rdo_accreditation_certificate"]').change(
        function() {
            $('#accreditation_certificate').addClass('hide');
            if ($(this).val() == 1) {
                $('#accreditation_certificate').removeClass('hide');
            }
        });
    $('input:radio[name="rdo_calibration_report_sun_simulator"]').change(
        function() {
            $('#calibration_report_sun_simulator').addClass('hide');
            if ($(this).val() == 1) {
                $('#calibration_report_sun_simulator').removeClass('hide');
            }
        });
    $('input:radio[name="rdo_calibration_report_module"]').change(
        function() {
            $('#calibration_report_module').addClass('hide');
            if ($(this).val() == 1) {
                $('#calibration_report_module').removeClass('hide');
            }
        });
    $('input:radio[name="rdo_iso_certificate"]').change(
        function() {
            $('#iso_certificate').addClass('hide');
            if ($(this).val() == 1) {
                $('#iso_certificate').removeClass('hide');
            }
        });
    $('input:radio[name="rdo_balance_sheet_last_years"]').change(
        function() {
            $('#balance_sheet_last_years').addClass('hide');
            if ($(this).val() == 1) {
                $('#balance_sheet_last_years').removeClass('hide');
            }
        });
    $('input:radio[name="rdo_trademark_certificate"]').change(
        function() {
            $('#trademark_certificate').addClass('hide');
            if ($(this).val() == 1) {
                $('#trademark_certificate').removeClass('hide');
            }
        });
    $('input:radio[name="rdo_bis_lab_report"]').change(
        function() {
            $('#bis_lab_report').addClass('hide');
            if ($(this).val() == 1) {
                $('#bis_lab_report').removeClass('hide');
            }
        });
    </script>
    @endpush
