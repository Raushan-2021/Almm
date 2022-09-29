@extends('layouts.masters.backend')
@section('content')
@section('title', $installation->bpmr_no ?? 'System')
<div class="row">
    <div class="col-md-12">
        @include('layouts.partials.backend._flash')
        <div class="clearfix"></div>
        <ul id="installations-tabs" class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#system"><b>Installation (Stage 1)</b></a></li>
            @if (count($logs ?? 0) > 0)
                <li class=""><a data-toggle="tab" href="#logs"><b>Logs</b></a></li>
            @endif
        </ul>
        <div class="tab-content">
            <div id="system" class="tab-pane fade in {{Auth::getDefaultDriver() !== 'inspector' ? 'active' : ''}}">
                <div class="box box-primary p-10">
                    <form action="{{URL::to('/'.Auth::getDefaultDriver().'/add-edit-system/'.$installation->id)}}" method="POST" id="installationForm" enctype="multipart/form-data">
                        @csrf
                        <ul id="installations-tabs" class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#general"><b>System Details</b></a></li>
                            <li class=""><a data-toggle="tab" href="#bank"><b>Bank Details</b></a></li>
                            <li class=""><a data-toggle="tab" href="#documents"><b>Documents</b></a></li>
                        </ul>
                        <div class="tab-content">
                            <div id="general" class="tab-pane fade in active">
                                <div class="box-body">
                                    @include('backend.common.system-sections.general')
                                </div>
                                <div class="box-footer @if($editable == 'disabled') hidden @endif">
                                    <a href="javascript:void(0)" class="btn btn-danger sNc" data-tab="general" data-form="installationForm" data-next="bank" data-tabination="installations-tabs">Save & Continue</a>
                                </div>
                            </div>
                            <div id="bank" class="tab-pane fade">
                                <div class="box-body">
                                    @include('backend.common.system-sections.bank')
                                </div>
                                <div class="box-footer @if($editable == 'disabled') hidden @endif">
                                    <a href="javascript:void(0)" class="btn btn-danger sNc" data-tab="bank" data-form="installationForm" data-next="documents" data-tabination="installations-tabs">Save & Continue</a>
                                </div>
                            </div>
                            <div id="documents" class="tab-pane fade">
                                <div class="box-body">
                                    @include('backend.installer.elements.systemdocuments')
                                </div>
                                <div class="box-footer @if($editable == 'disabled') hidden @endif">
                                    <input type="hidden" name="systemId" id="systemId" value="{{$installation->id}}">
                                    <input type="submit" class="btn btn-primary" value="Submit" onclick="activateLoader()">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div id="logs" class="tab-pane fade">
                <div class="box box-primary">
                    <div class="box-body">
                        @include('backend.common.system-sections.logs')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('backend-js')
<script type="text/javascript" src="{{asset('public/js/installation.js')}}"></script>
<script type="text/javascript">
    $(function(){
        $(".om-routines").datepicker({
            autoclose: true,
            format: "dd-mm-yyyy",
            orientation: "top",
            startDate: new Date()
        });
        $(".completion-date").datepicker({
            autoclose: true,
            format: "dd-mm-yyyy",
            orientation: "bottom",
            startDate: new Date()
        });
        $(".construction-start-date").datepicker({
            autoclose: true,
            format: "dd-mm-yyyy",
            orientation: "bottom",
            startDate: new Date()
        });
        validator = $('#installationForm').validate();
        @if(isset($installation['id']))
            setDistrictBySubDistrict('{{$installation["sub_district_id"]}}', 'district_id', '{{$installation["district_id"]}}');
            setStateByDistrict('{{$installation["district_id"]}}', 'state_id', '{{$installation["state_id"]}}');
        @endif
    })
</script>
@endpush


