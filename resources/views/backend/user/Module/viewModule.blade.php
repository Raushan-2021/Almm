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
                            <a class="btn btn-success btn-sm" href="{{ URL::to('/users/module-master/add')}}"><i
                                    class="fa fa-plus"></i> Add</a>
                        </div>

                        <div class="box-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr class="bg-warning">
                                        <th width="7%">S.No</th>
                                        <th width="24%">Type of Modules</th>
                                        <th width="24%">Main Model</th>
                                        <th width="8%"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($moduleData as $data)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$data->module_type}}</td>
                                        <td>{{$data->main_model}}</td>
                                        <td>
                                            <a href="javascript:;"> <i class="fa fa-pencil"></i>Edit</a> |
                                            <a href="javascript:;" class="text-danger"> <i
                                                    class="fa fa-trash"></i>Delete</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
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


    @endsection
