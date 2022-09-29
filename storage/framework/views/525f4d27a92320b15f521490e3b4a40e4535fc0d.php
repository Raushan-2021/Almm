
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
                        </div>

                        <div class="box-body">
                            <form action="<?php echo e(URL::to('/users/annexure-four')); ?>" method="POST"
                                enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('POST'); ?>
                                <table class="table table-bordered">
                                    <tr class="bg-warning">
                                        <th colspan="3" class=" text-left">5.1 Manufacturing facility Details</th>
                                    </tr>
                                    <tr>
                                        <th width="5%">S.No</th>
                                        <th width="45%">Particulars</th>
                                        <th>Details</th>
                                    </tr>
                                    <tr>
                                        <th>1</th>
                                        <th>Manufacturing Plant Floor Area (in m2)</th>
                                        <td><input type="text" name="plant_floor_area"
                                                placeholder="Manufacturing Plant Floor Area (in m2)"
                                                id="plant_floor_area" class="form-control" maxlength="70"
                                                value="<?php echo e($annexuredata->plant_floor_area ?? ''); ?>">
                                            <?php $__errorArgs = ['plant_floor_area'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span
                                                class="invalid-feedback custom_valid_class">
                                                <?php echo e($message); ?> </span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?></td>
                                    </tr>
                                    <tr>
                                        <th>2</th>
                                        <th>Manufacturing Plant operational since</th>
                                        <td><input type="date" name="plant_operational_date" placeholder="Main Model"
                                                id="plant_operational_date" class="form-control" maxlength="70"
                                                value="<?php echo e($annexuredata->plant_operational_date ?? ''); ?>"><br>
                                            <?php $__errorArgs = ['plant_operational_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span
                                                class="invalid-feedback custom_valid_class">
                                                <?php echo e($message); ?> </span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>3</th>
                                        <th>No. of Manufacturing Lines</th>
                                        <td><input type="number" min="0" step="any" name="no_manufaturing_line"
                                                placeholder="No. of Manufacturing Lines" id="no_manufaturing_line"
                                                class="form-control" maxlength="70"
                                                value="<?php echo e($annexuredata->no_manufaturing_line ?? ''); ?>">
                                            <?php $__errorArgs = ['no_manufaturing_line'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span
                                                class="invalid-feedback custom_valid_class">
                                                <?php echo e($message); ?> </span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>4</th>
                                        <th>No. of Working Days in a year</th>
                                        <td><input type="number" min="0" step="any" name="no_working_day"
                                                placeholder="No. of Working Days in a year" id="no_working_day"
                                                class="form-control" maxlength="70"
                                                value="<?php echo e($annexuredata->no_working_day ?? ''); ?>">
                                            <?php $__errorArgs = ['no_working_day'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="invalid-feedback custom_valid_class">
                                                <?php echo e($message); ?> </span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>5</th>
                                        <th>Total PV model Manufacturing Capacity </th>
                                        <td><input type="number" name="manufacturing_capacity"
                                                placeholder="Total PV model Manufacturing Capacity "
                                                id="manufacturing_capacity" class="form-control" min="0" step="any"
                                                value="<?php echo e($annexuredata->manufacturing_capacity ?? ''); ?>">
                                            <?php $__errorArgs = ['manufacturing_capacity'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span
                                                class="invalid-feedback custom_valid_class">
                                                <?php echo e($message); ?> </span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>6</th>
                                        <th>Electricity Load Connected to manufacturing plant (in kW)</th>
                                        <td><input type="number" name="electricity_load"
                                                placeholder="Electricity Load Connected to manufacturing plant (in kW)"
                                                id="electricity_load" class="form-control" min="0" step="any"
                                                value="<?php echo e($annexuredata->electricity_load ?? ''); ?>">
                                            <?php $__errorArgs = ['electricity_load'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span
                                                class="invalid-feedback custom_valid_class">
                                                <?php echo e($message); ?> </span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>7</th>
                                        <th>Average Electricity Consumption per day (in kWh)</th>
                                        <td><input type="number" min="0" step="any" name="electricity_consumption"
                                                placeholder="Average Electricity Consumption per day (in kWh)"
                                                id="electricity_consumption" class="form-control" maxlength="70"
                                                value="<?php echo e($annexuredata->electricity_consumption ?? ''); ?>">
                                            <?php $__errorArgs = ['electricity_consumption'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span
                                                class="invalid-feedback custom_valid_class">
                                                <?php echo e($message); ?> </span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>8</th>
                                        <th>Details of Power Backup Available with capacity</th>
                                        <td><textarea name="power_backup_details" id="power_backup_details"
                                                placeholder="Details of Power Backup Available with capacity" cols="30"
                                                rows="5"><?php echo e($annexuredata->power_backup_details ?? ''); ?></textarea><br>
                                            <?php $__errorArgs = ['power_backup_details'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span
                                                class="invalid-feedback custom_valid_class">
                                                <?php echo e($message); ?> </span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3">
                                            <input type="submit" name="submit"
                                                value="<?php if(isset($annexuredata->id) && $annexuredata->id !=''): ?>Update <?php else: ?> Save <?php endif; ?>"
                                                class="btn btn-success" id="">
                                            <input type="hidden" name="edit_id" id="edit_id"
                                                value="<?php if(isset($annexuredata->id)): ?><?php echo e($annexuredata->id); ?><?php endif; ?>">
                                            <input type="hidden" name="application_id" id="application_id"
                                                value="<?php echo e($application_id); ?>">
                                            <a href="<?php echo e(URL::to('users/annexure-four/'.$application_id)); ?>"
                                                class="btn btn-danger"> Cancel </a>

                                            <?php if(isset($annexuredata) && $annexuredata!=null): ?>
                                            <a href="<?php echo e(URL::to('users/annexure-four-two/'.$application_id)); ?>"
                                                class="btn btn-warning" style="float:right">Next <i
                                                    class="fa fa-arrow-right"></i></a>
                                            <?php endif; ?>
                                            <a href="<?php echo e(URL::to('users/annexure-three/'.$application_id)); ?>"
                                                class="btn btn-danger" style="float:right"><i
                                                    class="fa fa-arrow-left"></i> Back
                                            </a>

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

    <?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.masters.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xamp\htdocs\ALMM\resources\views/backend/user/form/annexureFour/annexureFour1.blade.php ENDPATH**/ ?>