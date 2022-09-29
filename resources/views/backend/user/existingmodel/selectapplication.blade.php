@extends('layouts.masters.backend')
@section('title', 'PV Model addition at the existing manufacturing facility')
@section('content')
<div class="row">

    <div class="col-md-12">

        <div class="box box-primary">

            <div class="container-fluid">

                <div class="row">

                    <div class="col-lg-12">



                        <div class="box-body">
                            @if ($errors->any())
                            @foreach ($errors->all() as $error)
                            <span class="invalid-feedback all_valid_class" style="display:block">
                                {{ $error }} </span>
                            @endforeach
                            @endif
                            <form action="{{URL::to('/users/select-exising-application')}}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('POST')
                                <div class="col-md-3 col-sm-6 col-12 pb-3 " style="display:inline-block">

                                    <label for="">Select Application Model</label>
                                    <select name="application" id="application" class="form-control">
                                        <option value="">Select Model</option>
                                        @foreach($application_details as $data)
                                        <option value="{{$data->id}}">{{$data->application_no}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3 col-sm-6 col-12 pb-3 " style="display:inline-block">

                                    <button type="Next" class="btn btn-primary">Next</button>
                                </div>
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
        // $("#add-row").click(function() {
        //     counter = counter + 1;
        //     markup =
        //         '<tr class="record"><td>' +
        //         counter +
        //         '</td><td><input type="number" min="0" step="any" name="pmax_applicable_model[]" id="pmax_applicable_model_' +
        //         counter +
        //         '" placeholder="Enter Pmax in (Wp)" class="form-control pmax_applicable_model_' +
        //         counter +
        //         '"></td><td><input type="text" name="no_of_cells[]" id="no_of_cells_' +
        //         counter +
        //         '" placeholder="Enter No of Cells & Cell Type " class="form-control"></td><td><input type="text" onkeypress="return event.charCode >= 48 && event.charCode <= 57" name="system_voltage[]" id="system_voltage_' +
        //         counter +
        //         '" placeholder="Enter System Voltage (VDC)" class="form-control"></td><td><a href="javascript:;" class="remove_fields">Delete <i class="fa fa-trash text-danger"></i></a></td></tr>';
        //     tableBody = $("#add-data");

        // });
    });
    </script>
    @endpush