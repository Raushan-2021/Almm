
<?php $__env->startSection('title', 'Annexure 6 ::Details of all Manufacturing Plant under same Brand/Company name'); ?>
<?php $__env->startSection('content'); ?>

<div class="row">
    <?php echo $__env->make('layouts.partials.backend._stepper', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="col-md-12">

        <?php echo $__env->make('layouts.partials.backend._flash', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="box box-primary">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">

                        <div class="box-header with-border">
                            <a class="btn btn-success btn-sm" href="javascript:;"
                                onclick="$('#show_data').toggle('slow')"><i class="fa fa-plus"></i> Add</a>
                        </div>

                        <div class="box-body">
                            <?php if($errors->any()): ?>
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <span class="invalid-feedback all_valid_class" style="display:block">
                                <?php echo e($error); ?> </span>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                            <form action="<?php echo e(URL::to('/users/annexure-six')); ?>" method="POST"
                                enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('POST'); ?>
                                <table class="table table-bordered" id="show_data"
                                    style="display: <?php if($annexuredata!=null): ?>  <?php else: ?> none <?php endif; ?>">
                                    <?php if($annexuredata!=null): ?>
                                    <input type="hidden" name="id" value="<?php echo e($annexuredata->id); ?>">
                                    <?php endif; ?>
                                    <tr>
                                        <th>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label for="">Name of Company</label>
                                                    <input type="text" name="name_of_company"
                                                        placeholder="Name of Company" id="name_of_company"
                                                        class="form-control" maxlength="70"
                                                        value="<?php echo e($annexuredata->name_of_company ?? ''); ?>">

                                                </div>
                                                <div class="col-md-6">
                                                    <label for="">Country</label>

                                                    <select name="country" id="country" class="form-control">
                                                        <option value="">Select</option>
                                                        <?php $__currentLoopData = $countrydata; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($country->countrycd); ?>"
                                                            <?php if(isset($annexuredata->country) &&
                                                            $annexuredata->country==$country->countrycd): ?>selected
                                                            <?php endif; ?>><?php echo e($country->name); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>

                                                </div>


                                                <div class="col-md-6">
                                                    <label for="">Whether Enlisted in ALMM</label>
                                                    <select name="whether_enlisted" id="whether_enlisted"
                                                        class="form-control">
                                                        <option value="">Select</option>
                                                        <option value="yes" <?php if(isset($annexuredata->whether_enlisted)
                                                            &&
                                                            $annexuredata->whether_enlisted=="yes"): ?>selected <?php endif; ?>>Yes
                                                        </option>
                                                        <option value="no" <?php if(isset($annexuredata->whether_enlisted) &&
                                                            $annexuredata->whether_enlisted=="no"): ?>selected <?php endif; ?>>No
                                                        </option>
                                                    </select>
                                                </div>

                                                <div class="col-md-6">
                                                    <label for="">No. of PV Models Enlisted in ALMM</label>
                                                    <input type="number" min="0" name="noofpv_models"
                                                        placeholder="No. of PV Models Enlisted in ALMM"
                                                        id="noofpv_models" class="form-control" maxlength="70"
                                                        value="<?php echo e($annexuredata->noofpv_models ?? ''); ?>">
                                                </div>

                                                <div class="col-md-6">
                                                    <label for="">Enlisted/Rated PV Modules Manufacturing
                                                        Capacity</label>
                                                    <input type="text" name="manufacturing_capacity"
                                                        placeholder="Enlisted/Rated PV Modules Manufacturing Capacity"
                                                        id="manufacturing_capacity" class="form-control" maxlength="70"
                                                        value="<?php echo e($annexuredata->manufacturing_capacity ?? ''); ?>">
                                                </div>
                                                <div class="col-md-12">
                                                    <label for="">Address</label>
                                                    <textarea name="address" id="address" class="form-control" cols="30"
                                                        rows="5"
                                                        placeholder="Complete Address of Brand/Company name"><?php echo e($annexuredata->address ?? ''); ?></textarea>

                                                </div>


                                            </div>
                                        </th>
                                    </tr>

                                    <tr>
                                        <td>
                                            <input type="submit" name="submit"
                                                value="<?php if(isset($annexuredata->id) && $annexuredata->id !=''): ?>Update <?php else: ?> Save <?php endif; ?>"
                                                class="btn btn-success" id="">
                                            <input type="hidden" name="edit_id" id="edit_id"
                                                value="<?php if(isset($annexuredata->id)): ?><?php echo e($annexuredata->id); ?><?php endif; ?>">
                                            <input type="hidden" name="application_id" id="application_id"
                                                value="<?php echo e($application_id); ?>">
                                            <!-- <a href="<?php echo e(URL::to('users/annexure-two/'.$application_id)); ?>"
                                                class="btn btn-danger"> Cancel </a> -->

                                        </td>
                                    </tr>
                                </table>


                            </form>
                            <table class="table table-bordered">
                                <thead>
                                    <tr class="bg-warning">
                                        <th>S.No</th>
                                        <th>Name of Company</th>
                                        <th>Country</th>
                                        <th>Address</th>
                                        <th>Whether Enlisted in ALMM </th>
                                        <th>No. of PV Models Enlisted in ALMM</th>
                                        <th>Enlisted/Rated PV Modules Manufacturing Capacity</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $appData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                    $result =
                                    \App\Models\Country::select('name')->where('countrycd',$data->country)->first();
                                    ?>
                                    <tr>
                                        <td><?php echo e($loop->iteration); ?></td>
                                        <td><?php echo e($data->name_of_company); ?></td>
                                        <td>
                                            <?php if($result): ?>
                                            <?php echo e($result['name']); ?>

                                            <?php else: ?>
                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo e($data->address); ?></td>
                                        <td><?php echo e($data->whether_enlisted); ?></td>
                                        <td><?php echo e($data->noofpv_models); ?></td>
                                        <td><?php echo e($data->manufacturing_capacity); ?></td>
                                        <td>
                                            <a
                                                href="<?php echo e(URL::to('users/annexure-six/'.$data->application_id.'/'.$data->id)); ?>">Edit
                                                <i class="fa fa-edit"></i></a>
                                            <a href="<?php echo e(URL::to('users/annexure-six-delete/1/'.$data->id)); ?>"
                                                onCLick="if (confirm('Are you sure to delete?')) { }else{ return false;}"
                                                class="text-danger">Delete <i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                            <table class="table table-bordered">
                                <tr>
                                    <th colspan="13">
                                        <?php if(!$appData->isEmpty()): ?>

                                        <a href="<?php echo e(URL::to('users/annexure-seven/'.$application_id)); ?>"
                                            class="btn btn-warning" style="float:right">Next <i
                                                class="fa fa-arrow-right"></i></a>
                                        <?php endif; ?>
                                        <a href="<?php echo e(URL::to('users/annexure-five/'.$application_id)); ?>"
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

    <?php $__env->stopSection(); ?>
    <?php $__env->startPush('backend-js'); ?>
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
                '" class="form-control" maxlength="70" value=""></td><td><input type="text" name="model_details[]" id="model_details_' +
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
    <?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.masters.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xamp\htdocs\ALMM\resources\views/backend/user/form/annexureSix/annexureSix.blade.php ENDPATH**/ ?>