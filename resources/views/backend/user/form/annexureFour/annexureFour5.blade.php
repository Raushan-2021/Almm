@extends('layouts.masters.backend')
@section('title', 'Annexure 4 ')
@section('content')
@php $docBaseUrl ='users/preview-docs/Certificate/';
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
                            <form action="{{ URL::to('/users/annexure-four-five')}}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('POST')
                                <table class="table table-bordered" id="show_data"
                                    style="display:@if($annexuredata!=null)  @else none @endif">
                                    <tr>
                                        <th>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label for="">ISO Certificate Title</label>
                                                    <input type="text" name="iso_certificate"
                                                        placeholder="Enter ISO Certificate Title" id="iso_certificate"
                                                        class="form-control" maxlength="70"
                                                        value="{{ $annexuredata->iso_certificate ?? '' }}">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="">ISO Certificate <small> <i>( PDF format
                                                                Only)</i></small></label>
                                                    <input type="file" name="iso_certificate_doc"
                                                        id="iso_certificate_doc" class="form-control">
                                                    @if(!empty($annexuredata->iso_certificate_doc))
                                                    <input type="hidden" name="old_iso_certificate_doc"
                                                        value="{{$annexuredata->iso_certificate_doc}}" id="">
                                                    <small><a target="_blank"
                                                            href="{{URL::to($docBaseUrl.$annexuredata->iso_certificate_doc)}}"
                                                            class="document">View
                                                            Certificate</a></small>
                                                    @endif
                                                </div>

                                                <div class="col-md-12">
                                                    <label for="">Issuing Agency with Address</label>
                                                    <textarea name="issuing_agency" id="issuing_agency" cols="30"
                                                        rows="5"
                                                        class="form-control">{{ $annexuredata->issuing_agency ?? '' }}</textarea>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="">Issuing Date</label>
                                                    <input type="date" name="issuing_date"
                                                        placeholder="Rated Manufacturing Capacity" id="issuing_date"
                                                        class="form-control" maxlength="70"
                                                        value="{{ $annexuredata->issuing_date ?? '' }}">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="">Certificate Valid Upto</label>
                                                    <input type="date" name="certificate_validate"
                                                        placeholder="Rated Manufacturing Capacity"
                                                        id="certificate_validate" class="form-control" maxlength="70"
                                                        value="{{ $annexuredata->certificate_validate ?? '' }}">
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
                                        <th>5.5</th>
                                        <th scope="col" colspan="13" class="text-left">ISO Certification Details for the
                                            Manufacturing Plant
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th width="5%">S.No</th>
                                        <th width="20%">ISO Certificate</th>
                                        <th width="30%">Issuing Agency with Address</th>
                                        <th width="10%">Issuing Date</th>
                                        <th width="10%">Certificate Valid Upto</th>
                                        <th>Certificate Document</th>
                                        <th width="10%"></th>

                                    </tr>
                                    @foreach($appData as $data)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$data->iso_certificate}}</td>
                                        <td>{{$data->issuing_agency}}</td>
                                        <td>{{$data->issuing_date}}</td>
                                        <td>{{$data->certificate_validate}}</td>
                                        <td>@if(!empty($data->iso_certificate_doc))
                                            <small><a target="_blank"
                                                    href="{{URL::to($docBaseUrl.$data->iso_certificate_doc)}}"
                                                    class="document">View
                                                    Certificate</a></small>
                                            @endif
                                        </td>
                                        <td><a
                                                href="{{URL::to('users/annexure-four-five/'.$data->application_id.'/'.$data->id)}}">Edit
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

                                        <a href="{{URL::to('users/annexure-five/'.$application_id)}}"
                                            class="btn btn-warning" style="float:right">Next <i
                                                class="fa fa-arrow-right"></i></a>
                                        @endif
                                        <a href="{{URL::to('users/annexure-four-four/'.$application_id)}}"
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
