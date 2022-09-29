
<?php $__env->startSection('title', 'Annexure 1 :: Details of Solar PV Modules'); ?>
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
                            <form action="<?php echo e(URL::to('/users/annexure-one')); ?>" method="POST"
                                enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('POST'); ?>
                                <table class="table table-bordered" id="show_data"
                                    style="display:<?php if($annexuredata!=null): ?>  <?php else: ?> none <?php endif; ?>">
                                    <tr>
                                        <th>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label for="">Type of Model</label>
                                                    <select name="module_type" id="module_type" class="form-control"
                                                        onChange="getDataValue(this)">
                                                        <option value="">Select Module</option>
                                                        <?php $__currentLoopData = $moduleList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $module): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option data-id="<?php echo e($module->main_model); ?>"
                                                            value="<?php echo e($module->id); ?>" <?php if(isset($annexuredata->
                                                            module_type) &&
                                                            $annexuredata->module_type==$module->id): ?>selected <?php endif; ?>>
                                                            <?php echo e($module->module_type); ?> (<?php echo e($module->main_model); ?>)</option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>

                                                    <!-- <input type="text" name="module_type" placeholder="Type of Modules"
                                                        id="module_type" class="form-control" maxlength="70"
                                                        value="<?php echo e($annexuredata->module_type ?? ''); ?>"> -->

                                                </div>
                                                <div class="col-md-4">
                                                    <label for="">Main Model</label>
                                                    <input type="text" name="model_code" placeholder="Main Model"
                                                        id="model_code" class="form-control" maxlength="70" readonly
                                                        value="<?php echo e($annexuredata->model_code ?? ''); ?>">
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="">Pmax (Wp) of Main Model</label>
                                                    <input type="number" min="0" step="any" name="pmax_model"
                                                        placeholder="Pmax (Wp) of Main Model" id="pmax_model"
                                                        class="form-control" maxlength="70"
                                                        value="<?php echo e($annexuredata->pmax_model ?? ''); ?>">
                                                </div>


                                            </div>
                                        </th>
                                    </tr>
                                    <tr>
                                        <td>
                                            <table class="table table-bordered1">
                                                <tr>
                                                    <th>S.No</th>
                                                    <th>Pmax (Wp) of Applicable Models Model</th>
                                                    <th>No of Cells & Cell Type (Full/Half/Third)</th>
                                                    <th>System Voltage (VDC)</th>
                                                    <th></th>

                                                </tr>
                                                <tbody id="add-data">
                                                    <?php if($annexuredata!=null): ?>

                                                    <?php $__currentLoopData = $annexuredata->pmax_applicable_model; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr class="record">
                                                        <td><?php echo e($loop->iteration); ?></td>
                                                        <td> <input type="number" min="0" step="any"
                                                                name="pmax_applicable_model[]"
                                                                id="pmax_applicable_model_<?php echo e($loop->iteration); ?>"
                                                                placeholder="Enter Pmax in (Wp) " value="<?php echo e($value); ?>">
                                                        </td>
                                                        <td> <input type="text" name="no_of_cells[]"
                                                                id="no_of_cells_<?php echo e($loop->iteration); ?>" min="0" step="any"
                                                                placeholder="Enter No of Cells & Cell Type "
                                                                value="<?php echo e($annexuredata->pmax_applicable_model[$loop->iteration-1]); ?>">
                                                        </td>
                                                        <td><input type="number" name="system_voltage[]"
                                                                id="system_voltage_<?php echo e($loop->iteration); ?>" min="0"
                                                                step="any" placeholder="Enter System Voltage (VDC)"
                                                                value="<?php echo e($annexuredata->system_voltage[$loop->iteration-1]); ?>">
                                                        </td>
                                                        <td width="8%">
                                                            <?php if($loop->iteration==1): ?>
                                                            <a href="javascript:;" id="add-row">Add
                                                                <i class="fa fa-plus text-success"></i></a>
                                                            <?php else: ?>
                                                            <a href="javascript:;" class="remove_fields">Delete <i
                                                                    class="fa fa-trash text-danger"></i></a>
                                                            <?php endif; ?>

                                                        </td>

                                                    </tr>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php else: ?>
                                                    <tr>
                                                        <td>1</td>
                                                        <td> <input type="number" min="0" step="any"
                                                                name="pmax_applicable_model[]"
                                                                id="pmax_applicable_model"
                                                                placeholder="Enter Pmax in (Wp) ">
                                                        </td>
                                                        <td> <input type="text" name="no_of_cells[]" id="no_of_cells"
                                                                min="0" step="any"
                                                                placeholder="Enter No of Cells & Cell Type ">
                                                        </td>
                                                        <td><input type="number" name="system_voltage[]"
                                                                id="system_voltage" min="0" step="any"
                                                                placeholder="Enter System Voltage (VDC)"></td>
                                                        <td width="8%"><a href="javascript:;" id="add-row">Add
                                                                <i class="fa fa-plus text-success"></i></a>
                                                        </td>

                                                    </tr>
                                                    <?php endif; ?>
                                                </tbody>
                                            </table>
                                        </td>
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


                                        </td>
                                    </tr>
                                </table>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>3.1</th>
                                            <th scope="col" colspan="8">Solar PV Model
                                                Details</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row">Sr.No</th>
                                            <th>Type Of Modules</th>
                                            <th>Main Model</th>
                                            <th>Pmax (Wp) of Main Model</th>
                                            <th width="15%">Applicable models covered under +- 5% of
                                                Mean Wattege</th>
                                            <th width="15%">Pmax (Wp) of Applicable Models Model</th>
                                            <th width="15%">No of Cells & Cell Type (Full/Half/Third)</th>
                                            <th>System Voltage (VDC)</th>
                                            <th></th>
                                        </tr>
                                        <?php $__currentLoopData = $appData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <th rowspan=""><?php echo e($loop->iteration); ?></th>
                                            <td><?php echo e($data->module_type); ?></td>
                                            <td><?php echo e($data->model_code); ?></td>
                                            <td><?php echo e($data->pmax_model); ?></td>
                                            <td class="text-center">
                                                <table width="100%">
                                                    <?php $__currentLoopData = json_decode($data->pmax_applicable_model); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pmax_applicable_model): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            <?php echo e($data->model_code); ?></td>
                                                    </tr>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </table>
                                            </td>
                                            <td class="text-center">
                                                <table width="100%">
                                                    <?php $__currentLoopData = json_decode($data->pmax_applicable_model); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pmax_applicable_model): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            <?php echo e($pmax_applicable_model); ?></td>
                                                    </tr>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </table>
                                            </td>
                                            <td class="text-center">
                                                <table width="100%">
                                                    <?php $__currentLoopData = json_decode($data->no_of_cells); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $no_of_cells): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            <?php echo e($no_of_cells); ?></td>
                                                    </tr>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </table>
                                            </td>
                                            <td class="text-center">
                                                <table width="100%">
                                                    <?php $__currentLoopData = json_decode($data->system_voltage); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $system_voltage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            <?php echo e($system_voltage); ?></td>
                                                    </tr>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </table>
                                            </td>
                                            <td><a href="<?php echo e(URL::to('users/annexure-one/'.$data->application_id.'/'.$data->id)); ?>"
                                                    onClick="editAnnexureData(<?php echo e($data->id); ?>)">Edit <i
                                                        class="fa fa-edit"></i></a>
                                                <a href="<?php echo e(URL::to('users/delete-annexure/1/'.$data->id)); ?>"
                                                    onCLick="if (confirm('Are you sure to delete?')) { }else{ return false;}"
                                                    class="text-danger">Delete <i class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                    <tr>
                                        <th colspan="9">
                                            <?php if(!$appData->isEmpty()): ?>

                                            <a href="<?php echo e(URL::to('users/annexure-one-b/'.$application_id)); ?>"
                                                class="btn btn-warning" style="float:right;">Next <i
                                                    class="fa fa-arrow-right"></i></a>
                                            <?php endif; ?>
                                            <a href="<?php echo e(URL::to('users/new-application-step2/'.$application_id)); ?>"
                                                class="btn btn-danger" style="float:right;"><i
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
        $("#add-row").click(function() {
            counter = counter + 1;
            markup =
                '<tr class="record"><td>' +
                counter +
                '</td><td><input type="number" min="0" step="any" name="pmax_applicable_model[]" id="pmax_applicable_model_' +
                counter +
                '" placeholder="Enter Pmax in (Wp)" class="form-control pmax_applicable_model_' +
                counter +
                '"></td><td><input type="text" name="no_of_cells[]" id="no_of_cells_' +
                counter +
                '" placeholder="Enter No of Cells & Cell Type " class="form-control"></td><td><input type="text" onkeypress="return event.charCode >= 48 && event.charCode <= 57" name="system_voltage[]" id="system_voltage_' +
                counter +
                '" placeholder="Enter System Voltage (VDC)" class="form-control"></td><td><a href="javascript:;" class="remove_fields">Delete <i class="fa fa-trash text-danger"></i></a></td></tr>';
            tableBody = $("#add-data");
            tableBody.append(markup);
        });
    });
    </script>
    <?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.masters.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\wamp64\www\ALMM\resources\views/backend/user/form/annexureOne/annexure1.blade.php ENDPATH**/ ?>