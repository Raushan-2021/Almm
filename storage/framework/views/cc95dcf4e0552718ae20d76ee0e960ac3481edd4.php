
<?php $__env->startSection('title', 'Annexure 2 ::Bill of Material Details'); ?>
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
                            <form action="<?php echo e(URL::to('/users/annexure-two')); ?>" method="POST"
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



                                            </div>
                                        </th>
                                    </tr>
                                    <tr>
                                        <td>
                                            <table class=" table table-bordered module_type" id="module_type3">
                                                <tr>
                                                    <th>S.No</th>
                                                    <th>Bill Material</th>
                                                    <th>Make</th>
                                                    <th>Model</th>
                                                    <th>Specification <small class="text-primary">(Max. 200
                                                            Characters)</small></th>
                                                    <th>Country of Origin</th>
                                                    <th></th>

                                                </tr>
                                                <tbody id="add-data-3">
                                                    <?php if($annexuredata!=null): ?>
                                                    <?php $i=0; ?>
                                                    <?php $__currentLoopData = $annexuredata->bill_material_id; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php $i++; ?>
                                                    <tr>
                                                        <td><?php echo e($i); ?></td>
                                                        <td><select name="bill_material_id[]" id=""
                                                                class="form-control">
                                                                <?php $__currentLoopData = $billMaterial; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $material): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <option value="<?php echo e($material->id); ?>" <?php if(isset($value) &&
                                                                    $value==$material->id): ?>selected
                                                                    <?php endif; ?>>
                                                                    <?php echo e($material->bill_title); ?></option>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                            </select></td>
                                                        <td><input type="text" name="make_details[]"
                                                                placeholder="Enter Make Details" id="make_details"
                                                                class="form-control" maxlength="70"
                                                                value="<?php echo e($annexuredata->make_details[$loop->iteration-1]); ?>">
                                                        </td>
                                                        <td> <input type="text" name="model_details[]"
                                                                id="model_details" placeholder="Enter Model Details"
                                                                value="<?php echo e($annexuredata->model_details[$loop->iteration-1]); ?>">
                                                        </td>
                                                        <td> <input type="text" name="specifications[]"
                                                                id="specifications"
                                                                placeholder="Enter specifiaction Details"
                                                                value="<?php echo e($annexuredata->specifications[$loop->iteration-1]); ?>">
                                                        </td>
                                                        <td>
                                                            <?php
                                                            $selectCountry =
                                                            $annexuredata->country_origin[$loop->iteration-1];
                                                            ?>
                                                            <select name="country_origin[]" id="country_origin"
                                                                class="form-control">
                                                                <option value="">Select Country</option>
                                                                <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <option value="<?php echo e($country->countrycd); ?>"
                                                                    <?php if($selectCountry==$country->countrycd): ?>selected
                                                                    <?php endif; ?>>
                                                                    <?php echo e($country->name); ?></option>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </select>
                                                        </td>
                                                        <td width="8%">
                                                            <?php if($loop->iteration==1): ?>
                                                            <a href="javascript:;" id="add-row-3">Add
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
                                                        <td><select name="bill_material_id[]" id=""
                                                                class="form-control">
                                                                <?php $__currentLoopData = $billMaterial; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $material): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <option value="<?php echo e($material->id); ?>">
                                                                    <?php echo e($material->bill_title); ?></option>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                            </select></td>
                                                        <td><input type="text" name="make_details[]"
                                                                placeholder="Enter Make Details" id="make_details"
                                                                class="form-control" maxlength="70" value="">
                                                        </td>
                                                        <td> <input type="text" name="model_details[]"
                                                                id="model_details" placeholder="Enter Model Details"
                                                                value="">
                                                        </td>
                                                        <td> <input type="text" name="specifications[]"
                                                                id="specifications"
                                                                placeholder="Enter specifiaction Details" value="">
                                                        </td>
                                                        <td>
                                                            <select name="country_origin[]" id="country_origin"
                                                                class="form-control">
                                                                <option value="">Select Country</option>
                                                                <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <option value="<?php echo e($country->countrycd); ?>">
                                                                    <?php echo e($country->name); ?></option>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </select>
                                                        </td>
                                                        <td width="8%">
                                                            <a href="javascript:;" id="add-row-3">Add
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
                                            <a href="<?php echo e(URL::to('users/annexure-two/'.$application_id)); ?>"
                                                class="btn btn-danger"> Cancel </a>

                                        </td>
                                    </tr>
                                </table>


                            </form>
                            <table class="table table-bordered text-center">
                                <thead>
                                    <tr class="bg-warning">
                                        <th>S.No</th>
                                        <th>Type of Modules</th>
                                        <th>Main Model</th>
                                        <th width="8%">Pmax (Wp) of Main Model</th>
                                        <th width="8%">Applicable models covered under ± 5% of Mean Wattage</th>
                                        <th>Bill of Material</th>
                                        <th>Make</th>
                                        <th>Model</th>
                                        <th>Specification</th>
                                        <th>Country of Origin</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $j=0; ?>
                                    <?php $__currentLoopData = $aryData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php $j++; ?>
                                    <tr>
                                        <td><?php echo e($j); ?></td>
                                        <td><?php echo e($data->module_type); ?></td>
                                        <td><?php echo e($data->model_code); ?></td>
                                        <td><?php echo e($data->pmax_model); ?></td>
                                        <td><?php echo e($data->applicable_mean_wattage); ?></td>
                                        <td>
                                            <table width="100%">
                                                <?php $__currentLoopData = json_decode($data->bill_material_id); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bill_material_id): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr style="border-bottom:1px solid #ccc">
                                                    <td><?php echo e($bill_material_id); ?></td>
                                                </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </table>
                                        </td>

                                        <td>
                                            <table width="100%">
                                                <?php $__currentLoopData = json_decode($data->make_details); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $make_details): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr style="border-bottom:1px solid #ccc">
                                                    <td><?php echo e($make_details); ?></td>
                                                </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </table>
                                        </td>
                                        <td>
                                            <table width="100%">
                                                <?php $__currentLoopData = json_decode($data->model_details); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $model_details): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr style="border-bottom:1px solid #ccc">
                                                    <td><?php echo e($model_details); ?></td>
                                                </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </table>
                                        </td>
                                        <td>
                                            <table width="100%">
                                                <?php $__currentLoopData = json_decode($data->specifications); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $specifications): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr style="border-bottom:1px solid #ccc">
                                                    <td><?php echo e($specifications); ?></td>
                                                </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </table>
                                        </td>
                                        <td>
                                            <table width="100%">
                                                <?php $__currentLoopData = json_decode($data->country_origin); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country_origin): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr style="border-bottom:1px solid #ccc">
                                                    <td><?php echo e($country_origin); ?></td>
                                                </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </table>
                                        </td>
                                        <td> <a
                                                href="<?php echo e(URL::to('users/annexure-two/'.$data->application_id.'/'.$data->id)); ?>">Edit
                                                <i class="fa fa-edit"></i></a>
                                            <a href="<?php echo e(URL::to('users/delete-annexure/2/'.$data->id)); ?>"
                                                onCLick="if (confirm('Are you sure to delete?')) { }else{ return false;}"
                                                class="text-danger">Delete <i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                                <tr>
                                    <th colspan="13">
                                        <?php if(isset($aryData) && $aryData!=null): ?>

                                        <a href="<?php echo e(URL::to('users/annexure-three/'.$application_id)); ?>"
                                            class="btn btn-warning" style="float:right;">Next <i
                                                class="fa fa-arrow-right"></i></a>
                                        <?php endif; ?>
                                        <a href="<?php echo e(URL::to('users/annexure-one-c/'.$application_id)); ?>"
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
    // var a = 50;
    // var b = "60";
    // alert(a + b);

    function getDataValue(data) {
        var dt = $(data).find(':selected').attr('data-id');
        $('#model_code').val(dt);
    }

    function showParameters(val) {
        $('.module_type').hide();
        $(".record" + val).remove();
        $('#module_type' + val).show();
    }
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
                '</td><td><select name="bill_material_id[]" id="bill_material_id' +
                counter +
                '" class="form-control"> <?php $__currentLoopData = $billMaterial; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $material): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <option value="<?php echo e($material->id); ?>"> <?php echo e($material->bill_title); ?></option> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> </select></td><td><input type="text" name="make_details[]" placeholder="Enter Make Details" id="make_details' +
                counter +
                '" class="form-control" maxlength="70" value=""></td><td><input type="text" name="model_details[]" id="model_details_' +
                counter +
                '" placeholder=" Enter Making Details"  class="form-control" ></td><td><input  type="text" name="specifications[]" id="specifications_' +
                counter +
                '" placeholder="Enter specifiaction Details" value="" class="form-control" ></td><td><select name="country_of_origin[]" id="country_of_origin' +
                counter +
                '" class="form-control"> <option value="">Select Country</option> <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <option value="<?php echo e($country->countrycd); ?>"> <?php echo e($country->name); ?></option> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> </select></td><td><a href="javascript:;" class="remove_fields">Delete <i class="fa fa-trash text-danger"></i></a></td></tr>';
            tableBody = $("#add-data-3");
            tableBody.append(markup);
        });

    });
    </script>
    <?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.masters.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\almm\resources\views/backend/user/form/annexureTwo/annexureTwo.blade.php ENDPATH**/ ?>