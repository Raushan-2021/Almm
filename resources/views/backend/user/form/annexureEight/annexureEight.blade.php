@extends('layouts.masters.backend')
@section('title', 'Annexure 6 ::Details of all Manufacturing Plant under same Brand/Company name')
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


                        <div class="box-body">

                            <form action="{{ URL::to('/users/annexure-eight')}}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('POST')
                                <table class="table table-bordered" id="show_data" style="">
                                    @if($appData->id!=null)
                                    <input type="hidden" name="id" value="{{$appData->id}}">
                                    @endif
                                    <tr>
                                        <th>
                                            <div class="row">
                                                <div class="col-md-6 col-md-offset-3">
                                                    <label for="">Upload Annexure 8 <small class="text-primary">(File
                                                            should be in PDF Format and
                                                            Max. 10 MB)</small></label>
                                                    <input type="file" name="annexure8" class="form-control">
                                                    @if(isset($appData) && $appData->annexure8!=null)
                                                    <i style="display: inline-block;float: right;"><a
                                                            href="{{URL::to($docBaseUrl.$appData->annexure8)}}"
                                                            style="margin-top: -8px;display: block;"
                                                            target="_blank">View
                                                            uploaded Annexure</a></i>
                                                    @endif
                                                    @error('annexure8') <span
                                                        class="invalid-feedback custom_valid_class">
                                                        {{ $message }} </span> @enderror


                                                </div>
                                                <div style="clear:both"></div>
                                                <div class="col-md-6 col-md-offset-3"><br>
                                                    <input type="submit" name="submit"
                                                        value="@if(isset($appData->id) && $appData->annexure8!=null)Update @else Upload @endif"
                                                        class="btn btn-success" id=""><br>
                                                    <small style="color:blue"><i>Please download the annexure form 8
                                                            and
                                                            upload duly signed
                                                            copy (<a
                                                                href="{{URL::asset('public/downloadables/Annexure8.pdf')}}"
                                                                download class="text-danger">Click
                                                                Here to Download Annexure 8 Form</a>)</i></small>

                                                    <input type="hidden" name="edit_id" id="edit_id"
                                                        value="@if(isset($appData->id)){{$appData->id}}@endif">
                                                    <input type="hidden" name="application_id" id="application_id"
                                                        value="{{$application_id}}">



                                                </div>

                                            </div>
                                        </th>
                                    </tr>
                                </table>


                            </form>
                            <table class="table table-bordered">
                                <tr>
                                    <th colspan="13">
                                        @if($appData->annexure8!=null)

                                        <a href="{{URL::to('users/annexure-attachment/'.$application_id)}}"
                                            class="btn btn-warning" style="float:right">Next <i
                                                class="fa fa-arrow-right"></i></a>
                                        @endif
                                        <a href="{{URL::to('users/annexure-seven/'.$application_id)}}"
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
    @push('backend-js')
    <script>
    function showParameters(val) {
        $('.module_type').hide();
        $(".record" + val).remove();
        $('#module_type' + val).show();
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
                '</td><td><select name="option_type[]" id="option_type' +
                counter +
                '" class="form-control"> <option value="0">Main</option> <option value="1">Alternate 1</option> <option value="2">Alternate 2</option>  </select></td><td><input type="text" name="make_details[]" placeholder="Enter Make Details" id="make_details' +
                counter +
                '" class="form-control" maxlength="80" value=""></td><td><input type="text" name="model_details[]" id="model_details_' +
                counter +
                '" placeholder=" Enter Making Details"  class="form-control" ></td><td><input  type="text" name="specifications[]" id="specifications_' +
                counter +
                '" placeholder="Enter specifiaction Details" value="" class="form-control" ></td><td><input  type="text" name="country_origin[]" id="country_origin_' +
                counter +
                '" placeholder="Enter Country of Origin" value="" class="form-control" ></td><td><a href="javascript:;" class="remove_fields">Delete <i class="fa fa-trash text-danger"></i></a></td></tr>';
            tableBody = $("#add-data-3");
            tableBody.append(markup);
        });

    });
    </script>
    @endpush
