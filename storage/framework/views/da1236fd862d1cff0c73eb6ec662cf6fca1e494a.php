
<?php $__env->startSection('title', 'Annexure 4 :: Details of Solar PV Modules'); ?>
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
                            <form action="<?php echo e(URL::to('/users/annexure-four-four')); ?>" method="POST"
                                enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('POST'); ?>
                                <table class="table table-bordered" id="show_data"
                                    style="display:<?php if($annexuredata!=null): ?>  <?php else: ?> none <?php endif; ?>">
                                    <tr>
                                        <th>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label for="">Module Type</label>
                                                    <select name="module_type" id="module_type">
                                                        <option value="">Select</option>
                                                        <option value="1" <?php if(isset($annexuredata->module_type) &&
                                                            $annexuredata->module_type==1): ?> selected <?php endif; ?>>Golden Module
                                                        </option>
                                                        <option value="2" <?php if(isset($annexuredata->module_type) &&
                                                            $annexuredata->module_type==2): ?> selected <?php endif; ?>>Silver Module
                                                        </option>
                                                    </select>

                                                </div>
                                                <div class="col-md-4">
                                                    <label for="">Machine Serial No.</label>
                                                    <input type="text" name="machine_serial_no"
                                                        placeholder="Enter Machine Serial No.y" id="machine_serial_no"
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
                                                <div class="col-md-4">
                                                    <label for="">Last Calibration Date</label>
                                                    <input type="date" name="last_calibration_date"
                                                        placeholder="Rated Manufacturing Capacity"
                                                        id="last_calibration_date" class="form-control" maxlength="70"
                                                        value="<?php echo e($annexuredata->last_calibration_date ?? ''); ?>">
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="">Calibration Valid Upto</label>
                                                    <input type="date" name="calibration_valid_upto"
                                                        placeholder="Rated Manufacturing Capacity"
                                                        id="calibration_valid_upto" class="form-control" maxlength="70"
                                                        value="<?php echo e($annexuredata->calibration_valid_upto ?? ''); ?>">
                                                </div>
                                                <div style="clear:both;"></div>
                                                <hr>
                                                <div class="col-md-12">Module Type and Power Rating</div><br>
                                                <div class="col-md-3">
                                                    <label for="">Technology</label>
                                                    <input type="text" name="technology_used"
                                                        placeholder="Technology Used" id="technology_used"
                                                        class="form-control" maxlength="200"
                                                        value="<?php echo e($annexuredata->technology_used ?? ''); ?>">
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="">No. of full Cell</label>
                                                    <input type="number" name="no_full_cell"
                                                        placeholder="No. of Full Cell" id="no_full_cell"
                                                        class="form-control"
                                                        value="<?php echo e($annexuredata->no_full_cell ?? '0'); ?>">
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="">No. of Half Cell</label>
                                                    <input type="number" name="no_half_cell"
                                                        placeholder="No. of Half Cell" id="no_half_cell"
                                                        class="form-control"
                                                        value="<?php echo e($annexuredata->no_half_cell ?? '0'); ?>">
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="">Capacity (Wp)</label>
                                                    <input type="number" step="any" min="0" name="capacity"
                                                        placeholder="Enter" id="capacity" class="form-control"
                                                        value="<?php echo e($annexuredata->capacity ?? '0'); ?>">
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
                                        <th>5.4</th>
                                        <th scope="col" colspan="13" class="text-left">Calibration Details of Reference
                                            Modules
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th width="10%">Module Type</th>
                                        <th width="5%">S.No</th>
                                        <th width="20%">Module Type and Power Rating</th>
                                        <th width="10%">Machine Serial No.</th>
                                        <th>Calibration Done by (Lab/Agency/Company Name with Address)</th>
                                        <th width="10%">Last Calibration Date</th>
                                        <th width="10%">Calibration Valid Upto</th>
                                        <th width="10%"></th>

                                    </tr>
                                    <?php $i=$j=0; ?>
                                    <?php $__currentLoopData = $appData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($data->module_type==1): ?> <?php $i++; ?>
                                    <tr>
                                        <?php if($i==1): ?>
                                        <td rowspan="2"><?php if($data->module_type==1): ?>Golden Module <?php else: ?> Silver
                                            Module
                                            <?php endif; ?></td><?php endif; ?>
                                        <td><?php echo e($i); ?></td>
                                        <td>
                                            <table class="" width="80%">
                                                <tr>
                                                    <th>Technology :</th>
                                                    <td><?php echo e($data->technology_used); ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Full Cell :</th>
                                                    <td><?php echo e($data->no_full_cell); ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Half Cell :</th>
                                                    <td><?php echo e($data->no_half_cell); ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Capacity :</th>
                                                    <td><?php echo e($data->capacity); ?> Wp</td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td><?php echo e($data->machine_serial_no); ?></td>
                                        <td><?php echo e($data->calibration_done_by); ?></td>
                                        <td><?php echo e($data->last_calibration_date); ?></td>
                                        <td><?php echo e($data->calibration_valid_upto); ?></td>
                                        <td><a
                                                href="<?php echo e(URL::to('users/annexure-four-four/'.$data->application_id.'/'.$data->id)); ?>">Edit
                                                <i class="fa fa-edit"></i></a>
                                            <a href="<?php echo e(URL::to('users/delete-annexure/4/'.$data->id)); ?>"
                                                onCLick="if (confirm('Are you sure to delete?')) { }else{ return false;}"
                                                class="text-danger">Delete <i class="fa fa-trash"></i></a>
                                        </td>

                                    </tr>
                                    <?php endif; ?>

                                    <?php if($data->module_type==2): ?> <?php $j++; ?>
                                    <tr>
                                        <?php if($j==1): ?>
                                        <td rowspan="2"><?php if($data->module_type==1): ?>Golden Module <?php else: ?> Silver
                                            Module
                                            <?php endif; ?></td><?php endif; ?>
                                        <td><?php echo e($j); ?></td>
                                        <td>
                                            <table class="" width="80%">
                                                <tr>
                                                    <th>Technology :</th>
                                                    <td><?php echo e($data->technology_used); ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Full Cell :</th>
                                                    <td><?php echo e($data->no_full_cell); ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Half Cell :</th>
                                                    <td><?php echo e($data->no_half_cell); ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Capacity :</th>
                                                    <td><?php echo e($data->capacity); ?> Wp</td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td><?php echo e($data->machine_serial_no); ?></td>
                                        <td><?php echo e($data->calibration_done_by); ?></td>
                                        <td><?php echo e($data->last_calibration_date); ?></td>
                                        <td><?php echo e($data->calibration_valid_upto); ?></td>
                                        <td><a
                                                href="<?php echo e(URL::to('users/annexure-four-four/'.$data->application_id.'/'.$data->id)); ?>">Edit
                                                <i class="fa fa-edit"></i></a>
                                            <a href="<?php echo e(URL::to('users/delete-annexure/4/'.$data->id)); ?>"
                                                onCLick="if (confirm('Are you sure to delete?')) { }else{ return false;}"
                                                class="text-danger">Delete <i class="fa fa-trash"></i></a>
                                        </td>

                                    </tr>
                                    <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                </tbody>
                                <tr>
                                    <th colspan="13">
                                        <?php if(!$appData->isEmpty()): ?>

                                        <a href="<?php echo e(URL::to('users/annexure-four-five/'.$application_id)); ?>"
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

<?php echo $__env->make('layouts.masters.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xamp\htdocs\ALMM\resources\views/backend/user/form/annexureFour/annexureFour4.blade.php ENDPATH**/ ?>