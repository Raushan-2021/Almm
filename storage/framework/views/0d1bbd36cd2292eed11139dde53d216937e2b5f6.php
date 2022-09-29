
<?php $__env->startSection('title', 'Annexure 4'); ?>
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
                            <form action="<?php echo e(URL::to('/users/annexure-four-three')); ?>" method="POST"
                                enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('POST'); ?>
                                <table class="table table-bordered" id="show_data"
                                    style="display:<?php if($annexuredata!=null): ?>  <?php else: ?> none <?php endif; ?>">
                                    <tr>
                                        <th>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label for="">Make and Model</label>
                                                    <input type="text" name="make_and_model"
                                                        placeholder="Enter Make and Model" id="make_and_model"
                                                        class="form-control" maxlength="70"
                                                        value="<?php echo e($annexuredata->make_and_model ?? ''); ?>">

                                                </div>
                                                <div class="col-md-4">
                                                    <label for="">Machine Serial No.</label>
                                                    <input type="text" name="machine_serial_no"
                                                        placeholder="Enter Machine Serial No." id="machine_serial_no"
                                                        class="form-control" maxlength="70"
                                                        value="<?php echo e($annexuredata->machine_serial_no ?? ''); ?>">
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="">Calibration Done by <i
                                                            class="text-primary">(Lab/Agency/Company Name with
                                                            Address)</i></label>
                                                    <input type="text" name="calibration_done_by" placeholder="Lab/Agency/Company Name with
                                                            Address" id="calibration_done_by" class="form-control"
                                                        value="<?php echo e($annexuredata->calibration_done_by ?? ''); ?>">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="">Last Calibration Date</label>
                                                    <input type="date" name="last_calibration_date"
                                                        placeholder="Rated Manufacturing Capacity"
                                                        id="last_calibration_date" class="form-control" maxlength="70"
                                                        value="<?php echo e($annexuredata->last_calibration_date ?? ''); ?>">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="">Calibration Valid Upto</label>
                                                    <input type="date" name="calibration_valid_upto"
                                                        placeholder="Rated Manufacturing Capacity"
                                                        id="calibration_valid_upto" class="form-control" maxlength="70"
                                                        value="<?php echo e($annexuredata->calibration_valid_upto ?? ''); ?>">
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
                                            <a href="<?php echo e(URL::to('users/annexure-one-c/'.$application_id)); ?>"
                                                class="btn btn-danger"> Cancel </a>

                                        </td>
                                    </tr>
                                </table>


                            </form>
                            <table class="table table-bordered">
                                <thead>
                                    <tr class="bg-warning">
                                        <th>5.3</th>
                                        <th scope="col" colspan="13" class="text-left">List of Major Machines/Equipments
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th width="6%">Equipment/Module</th>
                                        <th width="5%">S.No</th>
                                        <th width="10%">Make and Model</th>
                                        <th width="10%">Machine Serial No.</th>
                                        <th>Calibration Done by (Lab/Agency/Company Name with Address)</th>
                                        <th width="10%">Last Calibration Date</th>
                                        <th width="10%">Calibration Valid Upto</th>
                                        <th width="10%"></th>

                                    </tr>
                                    <?php $__currentLoopData = $appData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td>Sun Simulator</td>
                                        <td><?php echo e($loop->iteration); ?></td>
                                        <td><?php echo e($data->make_and_model); ?></td>
                                        <td><?php echo e($data->machine_serial_no); ?></td>
                                        <td><?php echo e($data->calibration_done_by); ?></td>
                                        <td><?php echo e($data->last_calibration_date); ?></td>
                                        <td><?php echo e($data->calibration_valid_upto); ?></td>
                                        <td><a
                                                href="<?php echo e(URL::to('users/annexure-four-three/'.$data->application_id.'/'.$data->id)); ?>">Edit
                                                <i class="fa fa-edit"></i></a>
                                            <a href="<?php echo e(URL::to('users/delete-annexure/4/'.$data->id)); ?>"
                                                onCLick="if (confirm('Are you sure to delete?')) { }else{ return false;}"
                                                class="text-danger">Delete <i class="fa fa-trash"></i></a>
                                        </td>

                                    </tr>

                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                </tbody>
                                <tr>
                                    <th colspan="13">
                                        <?php if(!$appData->isEmpty()): ?>

                                        <a href="<?php echo e(URL::to('users/annexure-four-four/'.$application_id)); ?>"
                                            class="btn btn-warning" style="float:right">Next <i
                                                class="fa fa-arrow-right"></i></a>
                                        <?php endif; ?>
                                        <a href="<?php echo e(URL::to('users/annexure-four-three/'.$application_id)); ?>"
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

<?php echo $__env->make('layouts.masters.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\almm\resources\views/backend/user/form/annexureFour/annexureFour3.blade.php ENDPATH**/ ?>