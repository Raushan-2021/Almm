
<?php $__env->startSection('title', 'Annexure 3 :: BIS Certification and Module Test Reports Details'); ?>
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
                            <form action="<?php echo e(URL::to('/users/annexure-three')); ?>" method="POST"
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

                                                </div>
                                                <div class="col-md-4">
                                                    <label for="">Main Model</label>
                                                    <input type="text" name="model_code" placeholder="Main Model"
                                                        id="model_code" class="form-control" maxlength="70" readonly
                                                        value="<?php echo e($annexuredata->model_code ?? ''); ?>">
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="">Pmax (Wp) of Main Model</label>
                                                    <input type="text" name="pmax_model"
                                                        placeholder="Pmax (Wp) of Main Model" id="pmax_model"
                                                        class="form-control" maxlength="70"
                                                        value="<?php echo e($annexuredata->pmax_model ?? ''); ?>">
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="">Applicable models covered under ± 5% of Mean
                                                        Wattage</label>
                                                    <input type="text" name="applicable_mean_wattage"
                                                        placeholder="Applicable models covered under ± 5% of Mean Wattage"
                                                        id="applicable_mean_wattage" class="form-control" maxlength="70"
                                                        value="<?php echo e($annexuredata->applicable_mean_wattage ?? ''); ?>">
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="">Pmax (Wp) of Applicable Models Model</label>
                                                    <input type="number" name="pmax_watt"
                                                        placeholder="Pmax (Wp) of Applicable Models Model"
                                                        id="pmax_watt" class="form-control" step="any" min="0"
                                                        value="<?php echo e($annexuredata->pmax_watt ?? ''); ?>">
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="">Details Type</label>
                                                    <select name="sub_annexure" id="sub_annexure" class="form-control"
                                                        onChange="showDetailType(this.value)">
                                                        <option value="">Select</option>
                                                        <option value="1" <?php if(isset($annexuredata->
                                                            sub_annexure) &&
                                                            $annexuredata->sub_annexure==1): ?>selected <?php endif; ?>>BIS
                                                            Certification Details</option>
                                                        <option value="2" <?php if(isset($annexuredata->
                                                            sub_annexure) &&
                                                            $annexuredata->sub_annexure==2): ?>selected <?php endif; ?>>Module Test
                                                            Reports Details</option>
                                                    </select>
                                                </div>
                                                <span id="detail_type_1"
                                                    style="display:<?php if($annexuredata!=null && $annexuredata->sub_annexure==1): ?>  <?php else: ?> none <?php endif; ?>">
                                                    <div class="col-md-4">
                                                        <label for="">BIS Certificate No.</label>
                                                        <input type="text" name="bis_certificate_no"
                                                            placeholder="BIS Certificate No." id="bis_certificate_no"
                                                            class="form-control" maxlength="70"
                                                            value="<?php echo e($annexuredata->bis_certificate_no ?? ''); ?>">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="">BIS Certificate issue date</label>
                                                        <input type="date" name="bis_certificate_issue"
                                                            placeholder="BIS Certificate issue date"
                                                            id="bis_certificate_issue" class="form-control"
                                                            maxlength="70"
                                                            value="<?php echo e($annexuredata->bis_certificate_issue ?? ''); ?>">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="">BIS Certificate Valid Upto</label>
                                                        <input type="date" name="bis_certificate_valid"
                                                            placeholder="BIS Certificate issue date"
                                                            id="bis_certificate_valid" class="form-control"
                                                            maxlength="70"
                                                            value="<?php echo e($annexuredata->bis_certificate_valid ?? ''); ?>">
                                                    </div>
                                                </span>
                                                <span id="detail_type_2"
                                                    style="display:<?php if($annexuredata!=null && $annexuredata->sub_annexure==2): ?>  <?php else: ?> none <?php endif; ?>">
                                                    <div class="col-md-4">
                                                        <label for="">Testing Standards</label>
                                                        <input type="text" name="test_standard_module"
                                                            placeholder="Testing Standards" id="test_standard_module"
                                                            class="form-control" maxlength="100"
                                                            value="<?php echo e($annexuredata->test_standard_module ?? ''); ?>">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="">Test Report No.</label>
                                                        <input type="text" name="test_report_no"
                                                            placeholder="Test Report No." id="test_report_no"
                                                            class="form-control" maxlength="70"
                                                            value="<?php echo e($annexuredata->test_report_no ?? ''); ?>">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="">Testing Laboratory</label>
                                                        <input type="text" name="testing_laboratory"
                                                            placeholder="Testing Laboratory" id="testing_laboratory"
                                                            class="form-control" maxlength="70"
                                                            value="<?php echo e($annexuredata->testing_laboratory ?? ''); ?>">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="">Testing Laboratory Address</label>
                                                        <input type="text" name="testing_laboratory_address"
                                                            placeholder="Testing Laboratory Address"
                                                            id="testing_laboratory_address" class="form-control"
                                                            value="<?php echo e($annexuredata->testing_laboratory_address ?? ''); ?>">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="">Valid NABL Certificate No. of Test Laboratory at
                                                            the time of testing</label>
                                                        <input type="text" name="valid_nabl_certificate_no"
                                                            placeholder="Valid NABL Certificate No. of Test Laboratory at the time of testing"
                                                            id="valid_nabl_certificate_no" class="form-control"
                                                            value="<?php echo e($annexuredata->valid_nabl_certificate_no ?? ''); ?>">
                                                    </div>
                                                </span>



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
                                            <a href="<?php echo e(URL::to('users/annexure-two/'.$application_id)); ?>"
                                                class="btn btn-danger"> Cancel </a>

                                        </td>
                                    </tr>
                                </table>


                            </form>
                            <table class="table table-bordered text-center">
                                <thead>
                                    <tr>
                                        <th colspan="9" class=" text-left">4.1 BIS Certification Details</th>
                                    </tr>
                                    <tr class="bg-primary">
                                        <th>S.No</th>
                                        <th>Type of Modules</th>
                                        <th>Main Model</th>
                                        <th width="8%">Pmax (Wp) of Main Model</th>
                                        <th width="8%">Applicable models covered under ± 5% of Mean Wattage</th>
                                        <th>BIS Certificate No.</th>
                                        <th>BIS Certificate Issue</th>
                                        <th>BIS Certificate Valid</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $j = 1 ?>
                                    <?php $__currentLoopData = $appData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub_annex_1): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($sub_annex_1->sub_annexure ==1): ?>
                                    <tr>
                                        <td><?php echo e($j++); ?></td>
                                        <td><?php echo e($sub_annex_1->module_type); ?></td>
                                        <td><?php echo e($sub_annex_1->model_code); ?></td>
                                        <td><?php echo e($sub_annex_1->pmax_model); ?></td>
                                        <td><?php echo e($sub_annex_1->applicable_mean_wattage); ?></td>
                                        <td><?php echo e($sub_annex_1->bis_certificate_no); ?></td>
                                        <td><?php echo e($sub_annex_1->bis_certificate_issue); ?></td>
                                        <td><?php echo e($sub_annex_1->bis_certificate_valid); ?></td>
                                        <td> <a
                                                href="<?php echo e(URL::to('users/annexure-three/'.$sub_annex_1->application_id.'/'.$sub_annex_1->id)); ?>">Edit
                                                <i class="fa fa-edit"></i></a>
                                            <a href="<?php echo e(URL::to('users/delete-annexure/3/'.$sub_annex_1->id)); ?>"
                                                onCLick="if (confirm('Are you sure to delete?')) { }else{ return false;}"
                                                class="text-danger">Delete <i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>

                            </table>
                            <br>
                            <table class="table table-bordered text-center">
                                <thead>
                                    <tr>
                                        <th colspan="9" class=" text-left">4.2 Module Test Reports Details</th>
                                    </tr>
                                    <tr class="bg-primary">
                                        <th>S.No</th>
                                        <th>Type of Modules</th>
                                        <th>Main Model</th>
                                        <th width="8%">Pmax (Wp) of Main Model</th>
                                        <th width="8%">Applicable models covered under ± 5% of Mean Wattage</th>
                                        <th>Testing Standards</th>
                                        <th>Test Report No.</th>
                                        <th>Testing Laboratory</th>
                                        <th>Testing Laboratory Address</th>
                                        <th>Valid NABL Certificate No. of Test Laboratory at the time of testing</th>
                                        <th width="10%"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1 ?>
                                    <?php $__currentLoopData = $appData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub_annex_2): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                    <?php if($sub_annex_2->sub_annexure ==2): ?>
                                    <tr>
                                        <td><?php echo e($i++); ?></td>
                                        <td><?php echo e($sub_annex_2->module_type); ?></td>
                                        <td><?php echo e($sub_annex_2->model_code); ?></td>
                                        <td><?php echo e($sub_annex_2->pmax_model); ?></td>
                                        <td><?php echo e($sub_annex_2->applicable_mean_wattage); ?></td>
                                        <td><?php echo e($sub_annex_2->test_standard_module); ?></td>
                                        <td><?php echo e($sub_annex_2->test_report_no); ?></td>
                                        <td><?php echo e($sub_annex_2->testing_laboratory); ?></td>
                                        <td><?php echo e($sub_annex_2->testing_laboratory_address); ?></td>
                                        <td><?php echo e($sub_annex_2->valid_nabl_certificate_no); ?></td>
                                        <td> <a
                                                href="<?php echo e(URL::to('users/annexure-three/'.$sub_annex_2->application_id.'/'.$sub_annex_2->id)); ?>">Edit
                                                <i class="fa fa-edit"></i></a>
                                            <a href="<?php echo e(URL::to('users/delete-annexure/3/'.$sub_annex_2->id)); ?>"
                                                onCLick="if (confirm('Are you sure to delete?')) { }else{ return false;}"
                                                class="text-danger">Delete <i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>

                            </table>
                            <table class="table text-center">
                                <tr>
                                    <th colspan="13">
                                        <?php if(!$appData->isEmpty()): ?>
                                        <a href="<?php echo e(URL::to('users/annexure-four/'.$application_id)); ?>"
                                            class="btn btn-warning" style="float:right;">Next <i
                                                class="fa fa-arrow-right"></i></a>
                                        <?php endif; ?>
                                        <a href="<?php echo e(URL::to('users/annexure-two/'.$application_id)); ?>"
                                            class="btn btn-danger" style="float:right;"><i class="fa fa-arrow-left"></i>
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
    function getDataValue(data) {
        var dt = $(data).find(':selected').attr('data-id');
        $('#model_code').val(dt);
    }

    function showDetailType(type) {
        $('#detail_type_2').hide();
        $('#detail_type_1').hide();
        if (type == 1) {
            $('#detail_type_1').show();
        } else {
            $('#detail_type_2').show();
        }

    }

    function showParameters(val) {
        $('.module_type').hide();
        $(".record" + val).remove();
        $('#module_type' + val).show();
    }
    </script>
    <?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.masters.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\wamp64\www\ALMM\resources\views/backend/user/form/annexureThree/annexureThree.blade.php ENDPATH**/ ?>