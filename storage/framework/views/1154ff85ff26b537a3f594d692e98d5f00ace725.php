
<?php $__env->startSection('title', 'New Application Step 2'); ?>
<?php $__env->startSection('content'); ?>
<?php $docBaseUrl ='users/preview-docs/Payment/';?>
<div class="row">
    <?php echo $__env->make('layouts.partials.backend._stepper_application', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="col-md-12">
        <?php echo $__env->make('layouts.partials.backend._flash', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="box box-primary">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="box-header with-border">
                            Details of Solar Photovoltaic (PV) Module Manufacturer

                        </div>
                        <div class="box-body">
                            <form action="<?php echo e(URL::to('/users/existing-application-step2')); ?>" method="POST"
                                enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('POST'); ?>
                                <table class="table table-bordered">
                                    <tr>
                                        <th width="3%">9</th>
                                        <td width="20%"> <strong>No. of Main PV Model Applied <small
                                                    class="text-danger">*</small></strong>
                                        </td>
                                        <td>
                                            <div class="row">

                                                <div class="col-md-12">
                                                    <table class="table table-bordered">
                                                        <tr>
                                                            <th>S.No</th>
                                                            <th>Technology</th>
                                                            <th>No. of Main PV Models Applied</th>
                                                            <th>Highest Pmax (in Wp)</th>
                                                            <th></th>

                                                        </tr>
                                                        <tbody id="add-data">
                                                            <?php if(isset($pvdata) && count($pvdata)>0): ?>
                                                            <?php $__currentLoopData = $pvdata; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pv): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <tr>
                                                                <td><?php echo e($loop->iteration); ?></td>
                                                                <td><input type="text" name="technology[]"
                                                                        id="technology" placeholder="Enter Technology"
                                                                        value="<?php echo e($pv->technology ?? old('technology')); ?>">
                                                                </td>
                                                                <td> <input type="number" min="0" name="no_pv_models[]"
                                                                        id="no_pv_models"
                                                                        placeholder="No. of Main PV Models"
                                                                        value="<?php echo e($pv->no_pv_models ?? old('no_pv_models')); ?>">
                                                                </td>
                                                                <td> <input type="number" name="pmax[]" id="pmax"
                                                                        min="0" step="any"
                                                                        placeholder="Highest Pmax (in Wp)"
                                                                        value="<?php echo e($pv->pmax ?? old('pmax')); ?>">
                                                                </td>
                                                                <td width="8%">
                                                                    <?php if($loop->iteration ==1): ?>
                                                                    <a href="javascript:;" id="add-row">Add
                                                                        <i class="fa fa-plus text-success"></i></a>

                                                                    <?php else: ?>
                                                                    <a href="javascript:;" class="remove_fields">Delete
                                                                        <i class="fa fa-trash text-danger"></i></a>
                                                                    <?php endif; ?>
                                                                </td>

                                                            </tr>

                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            <?php else: ?>
                                                            <tr>
                                                                <td>1</td>
                                                                <td><input type="text" name="technology[]"
                                                                        id="technology" placeholder="Enter Technology">
                                                                    <?php $__errorArgs = ['technology.*'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                    <span class="invalid-feedback text-danger">
                                                                        <?php echo e($message); ?> </span>
                                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                                </td>
                                                                <td> <input type="number" min="0" name="no_pv_models[]"
                                                                        id="no_pv_models"
                                                                        placeholder="No. of Main PV Models">
                                                                    <?php $__errorArgs = ['no_pv_models.*'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                    <span class="invalid-feedback text-danger">
                                                                        <?php echo e($message); ?> </span>
                                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                                </td>
                                                                <td> <input type="number" name="pmax[]" id="pmax"
                                                                        min="0" step="any"
                                                                        placeholder="Highest Pmax (in Wp)">
                                                                    <?php $__errorArgs = ['pmax.*'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                    <span class="invalid-feedback text-danger">
                                                                        <?php echo e($message); ?> </span>
                                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                                </td>
                                                                <td width="8%"><a href="javascript:;" id="add-row">Add
                                                                        <i class="fa fa-plus text-success"></i></a>
                                                                </td>

                                                            </tr>
                                                            <?php endif; ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="col-md-12">
                                                    <label for=""><strong>Total No. of Main PV Models
                                                            Applied:
                                                            <?php echo e($appData->applied_pv_model ?? 'NA'); ?></strong></label>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>10</th>
                                        <td width="20%"> <strong>Total PV Manufacturing Capacity <small
                                                    class="text-danger">*</small> (in
                                                MW/year)</strong>
                                            <br><br>
                                            <i>Formula for calculating PV model Manufacturing Capacity:</i><br>
                                            <br>
                                            <small> <i>
                                                    <u><span
                                                            style="margin-top: 0px; position: absolute; margin-left: -9px;font-size: 18px;">(</span>No.
                                                        of Cells Processed in an Hour</u><br>
                                                    <span style="margin-left: 15px;">No.of cells in highest Wp
                                                        PV
                                                        model</span> <br>
                                                    x Wattage of Highest Wp PV Model x
                                                    24 x 350 x 0.9)

                                                </i> </small>
                                        </td>
                                        <th>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <input type="text" name="manufacturing_capacity"
                                                        id="manufacturing_capacity" class="form-control"
                                                        placeholder="Total PV Manufacturing Capacity (in MW)" value="">
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
                                                </div>
                                            </div>
                                        </th>
                                    </tr>
                                    <!-- <tr>
                                        <th>11</th>
                                        <td width="20%"> <strong>Whether Already Enlisted in ALMM <small
                                                    class="text-danger">*</small></strong> <br>
                                        </td>
                                        <td>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <input type="radio" name="enlisted_almm" value="0" id="" checked> No
                                                    <input type="radio" name="enlisted_almm" value="1" id=""
                                                        <?php if(isset($appData->enlisted_almm) && $appData->enlisted_almm
                                                    ==1 || (old('enlisted_almm')==1) ): ?> checked <?php endif; ?>> Yes
                                                    <hr>

                                                </div>
                                                <div class="row col-md-12 enlistData  <?php if(isset($appData->enlisted_almm) && $appData->enlisted_almm
                                                    ==1 || (old('enlisted_almm')==1) ): ?> <?php else: ?> hide <?php endif; ?>">
                                                    <div class="col-md-6">
                                                        <label for="">No. of Main PV Model Enlisted:</label>
                                                        <input type="number" name="no_enlisted_pvmodel"
                                                            id="no_enlisted_pvmodel" min="0" class="form-control"
                                                            placeholder="No. of Main PV Model Enlisted" value="">
                                                        <?php $__errorArgs = ['no_enlisted_pvmodel'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span
                                                            class="invalid-feedback custom_valid_class">
                                                            <?php echo e($message); ?> </span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="">Total PV Module Manufacturing Capacity
                                                            (MW/year):</label>
                                                        <input type="number" name="total_pv_capacity"
                                                            id="total_pv_capacity" min="0" step="any"
                                                            placeholder="Total PV Module Manufacturing Capacity (MW/year)"
                                                            class="form-control" value="">
                                                        <?php $__errorArgs = ['total_pv_capacity'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span
                                                            class="invalid-feedback custom_valid_class">
                                                            <?php echo e($message); ?> </span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <hr><label for="">ALMM Enlistment Validity:</label>

                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="">From</label>
                                                        <input type="date" name="validity_from" id="validity_from"
                                                            class="form-control" value=""><br>
                                                        <?php $__errorArgs = ['validity_from'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span
                                                            class="invalid-feedback custom_valid_class">
                                                            <?php echo e($message); ?> </span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label for="">to</label>
                                                        <input type="date" name="validity_to" id="validity_to"
                                                            class="form-control" value=""><br>
                                                        <?php $__errorArgs = ['validity_to'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span
                                                            class="invalid-feedback custom_valid_class">
                                                            <?php echo e($message); ?> </span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                    </div>
                                                </div>

                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>12</th>
                                        <td width="20%"> <strong>Details of Payment of Fee <small
                                                    class="text-danger">*</small></strong>
                                            <br><br><br><br><br>

                                        </td>
                                        <td>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label for="">Application Fees:</label>
                                                    <input type="number" name="application_fees" step="any"
                                                        id="application_fees" min="0" class="form-control" value="">
                                                    <?php $__errorArgs = ['application_fees'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span
                                                        class="invalid-feedback custom_valid_class">
                                                        <?php echo e($message); ?> </span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="">Inspection Fees:</label>
                                                    <input type="number" name="inspection_fees" step="any"
                                                        id="inspection_fees" min="0" class="form-control" value="">
                                                    <?php $__errorArgs = ['inspection_fees'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span
                                                        class="invalid-feedback custom_valid_class">
                                                        <?php echo e($message); ?> </span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                </div>
                                                <div class=" col-md-6">
                                                    <label for="">Mode of Payment:</label>
                                                    <select name="payment_mode" class="form-control" id="payment_mode">
                                                        <option value="">payment mode</option>
                                                        <option value="1" <?php if(isset($appData->payment_mode) &&
                                                            $appData->payment_mode==1): ?>selected <?php endif; ?>>Online</option>
                                                        <option value="2" <?php if(isset($appData->payment_mode) &&
                                                            $appData->payment_mode==2): ?>selected <?php endif; ?>>Offline</option>
                                                    </select>
                                                    <?php $__errorArgs = ['payment_mode'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span
                                                        class="invalid-feedback custom_valid_class">
                                                        <?php echo e($message); ?> </span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="">Total Amount Paid:</label>
                                                    <input type="number" name="total_amount" id="total_amount" min="0"
                                                        step="any" class="form-control" value="">
                                                    <?php $__errorArgs = ['total_amount'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span
                                                        class="invalid-feedback custom_valid_class">
                                                        <?php echo e($message); ?> </span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                </div>
                                                <div style="clear:both"></div>

                                                <div class="col-md-6">
                                                    <label for="">Payment Date:</label>
                                                    <input type="date" name="payment_date" id="payment_date"
                                                        class="form-control" value=""><br>
                                                    <?php $__errorArgs = ['payment_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span
                                                        class="invalid-feedback custom_valid_class">
                                                        <?php echo e($message); ?> </span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                </div>

                                                <div class="col-md-6">
                                                    <label for="">UTR/reference No:</label>
                                                    <input type="text" name="utn_no" id="utn_no" class="form-control"
                                                        value="">
                                                    <?php $__errorArgs = ['utn_no'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="invalid-feedback custom_valid_class">
                                                        <?php echo e($message); ?> </span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                </div>


                                            </div>
                                        </td>

                                    </tr> -->
                                    <!-- <tr>
                                        <th>13</th>
                                        <td width="20%"> <strong>Proposed Date for Inspection <small
                                                    class="text-danger">*</small></strong></td>
                                        <th>
                                             ALTER TABLE `application_details` ADD `inspection_date` DATE NULL DEFAULT NULL AFTER `utn_no`; 
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <input type="date" name="inspection_date" id="inspection_date"
                                                        class="form-control" placeholder="Proposed date for Inspection"
                                                        value="">
                                                    <?php $__errorArgs = ['inspection_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span
                                                        class="invalid-feedback custom_valid_class">
                                                        <?php echo e($message); ?> </span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                </div>
                                            </div>
                                        </th>
                                    </tr> -->
                                    <tr>
                                        <th colspan="3">
                                            <input type="submit" name="submit"
                                                value="<?php if(isset($appData->id) && $appData->step2 !=''): ?>Update <?php else: ?> Save <?php endif; ?>"
                                                class="btn btn-success" id="">
                                            <input type="hidden" name="edit_id" id="edit_id" value="<?php echo e($appData->id); ?>">
                                            <?php if(isset($appData->id) && $appData->step2 !=''): ?>

                                            <a href="<?php echo e(URL::to('users/existing-annexure-one/'.$appData->id)); ?>"
                                                class="btn btn-warning" style="float:right">Next <i
                                                    class="fa fa-arrow-right"></i></a>

                                            <input type="hidden" name="step1" id="step1" value="<?php echo e($appData->step2); ?>">
                                            <?php endif; ?>
                                            <a href="<?php echo e(URL::to('users/existing-application/'.$appData->id)); ?>"
                                                class="btn btn-danger" style="float:right"><i
                                                    class="fa fa-arrow-left"></i> Back </a>
                                        </th>

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
    .max-char {
        position: absolute;

        right: 35px;
        margin-top: -24px;
    }
    </style>

    <?php $__env->stopSection(); ?>
    <?php $__env->startPush('backend-js'); ?>
    <script>
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
        $("#add-row").click(function() {
            counter = counter + 1;
            markup =
                '<tr class="record"><td>' +
                counter + '</td><td><input type="text" class="form-control courseid_input_' +
                counter + '" name="technology[]" id="technology_' + counter +
                '" placeholder="Enter Technology"></td><td><input type="text" onkeypress="return event.charCode >= 48 && event.charCode <= 57" name="no_pv_models[]" id="no_pv_models_' +
                counter + '" placeholder="No. of Main PV Models" class="form-control no_pv_models_' +
                counter +
                '"></td><td><input type="number" step="any" min="0" name="pmax[]" id="pmax_' +
                counter +
                '" placeholder="Highest Pmax (in Wp)" class="form-control"></td><td><a href="javascript:;" class="remove_fields">Delete <i class="fa fa-trash text-danger"></i></a></td></tr>';
            tableBody = $("#add-data");
            tableBody.append(markup);
        });
    });
    </script>
    <?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.masters.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\almm\resources\views/backend/user/existingmodel\newExistingApplicationStep2.blade.php ENDPATH**/ ?>