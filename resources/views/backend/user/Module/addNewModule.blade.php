@extends('layouts.masters.backend')
@section('title', 'Module Master')
@section('content')

<div class="row">
    <div class="col-md-12">
        @include('layouts.partials.backend._flash')
        <div class="box box-primary">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">

                        <div class="box-header with-border">
                            <a class="btn btn-success btn-sm" href="{{ URL::to('/users/module-master')}}"><i
                                    class="fa fa-arrow"></i> Back</a>
                        </div>

                        <div class="box-body">
                            <form action="{{ URL::to('/users/module-master')}}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('POST')
                                <table class="table table-bordered" id="show_data">
                                    <tr>
                                        <th>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label for="">Type of Model</label>
                                                    <input type="text" name="module_type" placeholder="Type of Modules"
                                                        id="module_type" class="form-control" maxlength="70"
                                                        value="{{ old('module_type') }}">
                                                    @error('module_type') <span class="invalid-feedback valid_class"
                                                        role="alert"> {{ $message }} </span> @enderror

                                                </div>
                                                <div class="col-md-4">
                                                    <label for="">Main Model</label>
                                                    <input type="text" name="main_model" placeholder="Main Model"
                                                        id="main_model" class="form-control" maxlength="70" value="">
                                                    @error('main_model') <span class="invalid-feedback valid_class"
                                                        role="alert"> {{ $message }} </span> @enderror
                                                </div>
                                                <div class="col-md-4 hide">
                                                    <label for="">Pmax (Wp) of Main Model</label>
                                                    <input type="text" name="pmax_model"
                                                        placeholder="Pmax (Wp) of Main Model" id="pmax_model"
                                                        class="form-control" maxlength="70" value="00">
                                                    @error('pmax_model') <span class="invalid-feedback valid_class"
                                                        role="alert"> {{ $message }} </span> @enderror
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

                                            <a href="" class="btn btn-danger"> Cancel </a>

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
    <style>
    .valid_class {
        color: #d34f4f;
        font-size: 10px;
        font-weight: 600;
        margin-top: -16px;
        position: absolute;
    }

    </style>

    @endsection
