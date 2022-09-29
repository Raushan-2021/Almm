
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
                            <form action="<?php echo e(URL::to('/users/annexure-one-c')); ?>" method="POST"
                                enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('POST'); ?>
                                <table class="table table-bordered" id="show_data"
                                    style="display:<?php if($annexuredata!=null): ?>  <?php else: ?> none <?php endif; ?>">
                                    <tr>
                                        <th>
                                            <div class="row">
                                                <div class="col-md-6">
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
                                                <div class="col-md-6">
                                                    <label for="">Main Model</label>
                                                    <input type="text" name="model_code" placeholder="Main Model"
                                                        id="model_code" class="form-control" maxlength="70" readonly
                                                        value="<?php echo e($annexuredata->model_code ?? ''); ?>">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="">Pmax (Wp) of Main Model</label>
                                                    <input type="text" name="pmax_model"
                                                        placeholder="Pmax (Wp) of Main Model" id="pmax_model"
                                                        class="form-control" maxlength="70"
                                                        value="<?php echo e($annexuredata->pmax_model ?? ''); ?>">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="">Module Operation type</label>
                                                    <select name="electrical_data_type" id="electrical_data_type"
                                                        class="form-control" onChange="showParameters(this.value)">
                                                        <option value="">Select</option>
                                                        <option value="3" <?php if(isset($annexuredata->sub_annexure)
                                                            && $annexuredata->sub_annexure==3): ?>
                                                            selected <?php endif; ?> >Operational Ratings
                                                        </option>
                                                        <option value="4" <?php if(isset($annexuredata->sub_annexure)
                                                            && $annexuredata->sub_annexure==4): ?>
                                                            selected <?php endif; ?>>Module Temperature Characteristics</option>
                                                        <option value="5" <?php if(isset($annexuredata->sub_annexure)
                                                            && $annexuredata->sub_annexure==5): ?>
                                                            selected <?php endif; ?>>Module Dimensions</option>
                                                        <option value="6" <?php if(isset($annexuredata->sub_annexure)
                                                            && $annexuredata->sub_annexure==6): ?>
                                                            selected <?php endif; ?>>Solar Cell Specifications</option>
                                                    </select>
                                                </div>


                                            </div>
                                        </th>
                                    </tr>
                                    <tr>
                                        <td>
                                            <table class="table table-bordered module_type" id="module_type3"
                                                style="display:<?php if(isset($annexuredata->sub_annexure) && $annexuredata->sub_annexure==3): ?>block <?php else: ?> none <?php endif; ?>">
                                                <tr>
                                                    <th>S.No</th>
                                                    <th>Applicable models covered under ± 5% of Mean
                                                        Wattage</th>
                                                    <th>Pmax (Wp) of Applicable Models Model</th>
                                                    <th>Operational Temperature (ᴼC)</th>
                                                    <th>Maximum System Voltage (V)</th>
                                                    <th>Maximum Fuse Rating</th>
                                                    <th>By-pass Diode Rating</th>
                                                    <th>Fire Rating</th>
                                                    <th>Warranty Details</th>
                                                    <th></th>

                                                </tr>
                                                <tbody id="add-data-3">
                                                    <?php if($annexuredata!=null && $annexuredata->sub_annexure==3): ?>

                                                    <?php $__currentLoopData = $annexuredata->pmax_applicable_model; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr class="record">
                                                        <td><?php echo e($loop->iteration); ?></td>
                                                        <td><input type="text" name="applicable_mean_wattage[]"
                                                                placeholder="Applicable models covered under ± 5% of Mean Wattage"
                                                                id="applicable_mean_wattage" class="form-control"
                                                                maxlength="70"
                                                                value="<?php echo e($annexuredata->applicable_mean_wattage[$loop->iteration-1] ?? ''); ?>">
                                                        </td>
                                                        <td><input type="text" name="pmax_applicable_model[]"
                                                                placeholder="Pmax (Wp) of Applicable Models Model"
                                                                id="pmax_applicable_model" class="form-control"
                                                                maxlength="70"
                                                                value="<?php echo e($annexuredata->pmax_applicable_model[$loop->iteration-1] ?? ''); ?>">
                                                        </td>
                                                        <td><input type="text" name="operation_temp[]"
                                                                placeholder=" Operational Temperature (ᴼC)"
                                                                id="operation_temp_<?php echo e($loop->iteration-1); ?>"
                                                                class="form-control" maxlength="70"
                                                                value="<?php echo e($annexuredata->operation_temp[$loop->iteration-1] ?? ''); ?>">
                                                        </td>
                                                        <td><input type="text" name="max_voltage[]"
                                                                placeholder="Maximum System Voltage (V)"
                                                                id="max_voltage_<?php echo e($loop->iteration-1); ?>"
                                                                class="form-control" maxlength="70"
                                                                value="<?php echo e($annexuredata->max_voltage[$loop->iteration-1] ?? ''); ?>">
                                                        </td>
                                                        <td><input type="text" name="max_fuse_rating[]"
                                                                placeholder="Maximum Fuse Rating"
                                                                id="max_fuse_rating_<?php echo e($loop->iteration-1); ?>"
                                                                class="form-control" maxlength="70"
                                                                value="<?php echo e($annexuredata->max_fuse_rating[$loop->iteration-1] ?? ''); ?>">
                                                        </td>
                                                        <td><input type="text" name="diode_rating[]"
                                                                placeholder="By-pass Diode Rating"
                                                                id="diode_rating_<?php echo e($loop->iteration-1); ?>"
                                                                class="form-control" maxlength="70"
                                                                value="<?php echo e($annexuredata->diode_rating[$loop->iteration-1] ?? ''); ?>">
                                                        </td>
                                                        <td><input type="text" name="fire_rating[]"
                                                                placeholder="By-pass Diode Rating"
                                                                id="fire_rating_<?php echo e($loop->iteration-1); ?>"
                                                                class="form-control" maxlength="70"
                                                                value="<?php echo e($annexuredata->fire_rating[$loop->iteration-1] ?? ''); ?>">
                                                        </td>
                                                        <td><input type="text" name="warrenty_details[]"
                                                                placeholder="Enter Warranty Details"
                                                                id="warrenty_details_<?php echo e($loop->iteration-1); ?>"
                                                                class="form-control" maxlength="70"
                                                                value="<?php echo e($annexuredata->warrenty_details[$loop->iteration-1] ?? ''); ?>">
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
                                                        <td><input type="text" name="applicable_mean_wattage[]"
                                                                placeholder="Applicable models covered under ± 5% of Mean Wattage"
                                                                id="applicable_mean_wattage" class="form-control"
                                                                maxlength="70" value="">
                                                        </td>
                                                        <td><input type="text" name="pmax_applicable_model[]"
                                                                placeholder="Pmax (Wp) of Applicable Models Model"
                                                                id="pmax_applicable_model" class="form-control"
                                                                maxlength="70" value="">
                                                        </td>
                                                        <td> <input type="number" min="0" step="any"
                                                                name="operation_temp[]" id="operation_temp"
                                                                placeholder="Operational Temperature (ᴼC)" value="">
                                                        </td>
                                                        <td> <input type="number" name="max_voltage[]" id="max_voltage"
                                                                min="0" step="any"
                                                                placeholder="Maximum System Voltage (V)" value="">
                                                        </td>
                                                        <td><input type="number" name="max_fuse_rating[]"
                                                                id="max_fuse_rating" min="0" step="any"
                                                                placeholder="Maximum Fuse Rating" value=""></td>
                                                        <td><input type="number" name="diode_rating[]" id="diode_rating"
                                                                min="0" step="any" placeholder="By-pass Diode Rating"
                                                                value=""></td>
                                                        <td><input type="number" name="fire_rating[]" id="fire_rating"
                                                                min="0" step="any" placeholder="Fire Rating" value="">
                                                        </td>
                                                        <td><input type="text" name="warrenty_details[]"
                                                                id="warrenty_details" min="0" step="any"
                                                                placeholder="Enter Warranty Details" maxlength="250"
                                                                value="">
                                                        </td>
                                                        <td width="8%">
                                                            <a href="javascript:;" id="add-row-3">Add
                                                                <i class="fa fa-plus text-success"></i></a>


                                                        </td>

                                                    </tr>
                                                    <?php endif; ?>
                                                </tbody>
                                            </table>
                                            <table class="table table-bordered module_type" id="module_type4"
                                                style="display:<?php if(isset($annexuredata->sub_annexure) && $annexuredata->sub_annexure==4): ?>block <?php else: ?> none <?php endif; ?>">
                                                <tr>
                                                    <th>S.No</th>
                                                    <th>Applicable models covered under ± 5% of Mean Wattage</th>
                                                    <th>Pmax (Wp) of Applicable Models Model</th>
                                                    <th>Temperature Co-efficient of Pmax</th>
                                                    <th>Temperature Coefficient of Voc</th>
                                                    <th>Temperature Coefficient of Isc</th>
                                                    <th></th>

                                                </tr>
                                                <tbody id="add-data-4">
                                                    <?php if($annexuredata!=null && $annexuredata->sub_annexure==4): ?>
                                                    <?php $__currentLoopData = $annexuredata->applicable_mean_wattage; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr class="record">
                                                        <td><?php echo e($loop->iteration); ?></td>
                                                        <td><input type="text" name="applicable_mean_wattage_4[]"
                                                                placeholder="Applicable models covered under ± 5% of Mean Wattage"
                                                                id="applicable_mean_wattage_<?php echo e($loop->iteration); ?>"
                                                                class="form-control" maxlength="70"
                                                                value="<?php echo e($annexuredata->applicable_mean_wattage[$loop->iteration-1] ?? ''); ?>">
                                                        </td>
                                                        <td><input type="text" name="pmax_applicable_model_4[]"
                                                                placeholder="Pmax (Wp) of Applicable Models Model"
                                                                id="pmax_applicable_model__<?php echo e($loop->iteration); ?>"
                                                                class="form-control" maxlength="70"
                                                                value="<?php echo e($annexuredata->pmax_applicable_model[$loop->iteration-1] ?? ''); ?>">
                                                        </td>
                                                        <td><input type="text" name="pmax_watt[]"
                                                                placeholder="Enter Temperature Co-efficient of Pmax "
                                                                id="pmax_watt_<?php echo e($loop->iteration); ?>" class="form-control"
                                                                maxlength="70"
                                                                value="<?php echo e($annexuredata->pmax_watt[$loop->iteration-1] ?? ''); ?>">
                                                        </td>
                                                        <td><input type="text" name="voc[]" placeholder="Enter Voc (V)"
                                                                id="voc_<?php echo e($loop->iteration); ?>" class="form-control"
                                                                maxlength="70"
                                                                value="<?php echo e($annexuredata->voc[$loop->iteration-1] ?? ''); ?>">
                                                        </td>
                                                        <td><input type="text" name="isc[]" placeholder="Enter Isc (A)"
                                                                id="isc_<?php echo e($loop->iteration); ?>" class="form-control"
                                                                maxlength="70"
                                                                value="<?php echo e($annexuredata->isc[$loop->iteration-1] ?? ''); ?>">
                                                        </td>

                                                        <td width="8%">
                                                            <?php if($loop->iteration==1): ?>
                                                            <a href="javascript:;" id="add-row-4">Add
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
                                                        <td><input type="text" name="applicable_mean_wattage_4[]"
                                                                placeholder="Applicable models covered under ± 5% of Mean Wattage"
                                                                id="applicable_mean_wattage" class="form-control"
                                                                maxlength="70" value="">
                                                        </td>
                                                        <td><input type="text" name="pmax_applicable_model_4[]"
                                                                placeholder="Pmax (Wp) of Applicable Models Model"
                                                                id="pmax_applicable_model" class="form-control"
                                                                maxlength="70" value="">
                                                        </td>
                                                        <td> <input type="number" min="0" name="pmax_watt[]"
                                                                id="pmax_watt"
                                                                placeholder="Enter Temperature Co-efficient of Pmax ">
                                                        </td>
                                                        <td><input type="number" name="voc[]" id="voc" min="0"
                                                                step="any" placeholder="Enter Voc (V)"></td>
                                                        <td><input type="number" name="isc[]" id="isc" min="0"
                                                                step="any" placeholder="Enter Isc (A)"></td>

                                                        <td width="8%"><a href="javascript:;" id="add-row-4">Add
                                                                <i class="fa fa-plus text-success"></i></a>
                                                        </td>

                                                    </tr>
                                                    <?php endif; ?>
                                                </tbody>
                                            </table>
                                            <table class="table table-bordered module_type" id="module_type5"
                                                style="display:<?php if(isset($annexuredata->sub_annexure) && $annexuredata->sub_annexure==5): ?>block <?php else: ?> none <?php endif; ?>">
                                                <tr>
                                                    <th>S.No</th>
                                                    <th>Applicable models covered under ± 5% of Mean Wattage</th>
                                                    <th>Pmax (Wp) of Applicable Models Model</th>
                                                    <th>Length of Module (in mm)</th>
                                                    <th>Breadth of Module (in mm)</th>
                                                    <th>Area of Module (LxB) (in m2)</th>
                                                    <th>Weight (in kg)</th>
                                                    <th></th>

                                                </tr>
                                                <tbody id="add-data-5">
                                                    <?php if($annexuredata!=null && $annexuredata->sub_annexure==5): ?>

                                                    <?php $__currentLoopData = $annexuredata->applicable_mean_wattage; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr class="record">
                                                        <td><?php echo e($loop->iteration); ?></td>
                                                        <td><input type="text" name="applicable_mean_wattage_5[]"
                                                                placeholder="Applicable models covered under ± 5% of Mean Wattage"
                                                                id="applicable_mean_wattage_<?php echo e($loop->iteration); ?>"
                                                                class="form-control" maxlength="70"
                                                                value="<?php echo e($annexuredata->applicable_mean_wattage[$loop->iteration-1] ?? ''); ?>">
                                                        </td>
                                                        <td><input type="text" name="pmax_applicable_model_5[]"
                                                                placeholder="Pmax (Wp) of Applicable Models Model"
                                                                id="pmax_applicable_model__<?php echo e($loop->iteration); ?>"
                                                                class="form-control" maxlength="70"
                                                                value="<?php echo e($annexuredata->pmax_applicable_model[$loop->iteration-1] ?? ''); ?>">
                                                        </td>
                                                        <td> <input type="number" min="0" step="any"
                                                                name="module_length[]" id="module_length"
                                                                placeholder="Enter Length of Module (in mm)"
                                                                value="<?php echo e($annexuredata->module_length[$loop->iteration-1] ?? ''); ?>">
                                                        </td>
                                                        <td><input type="number" name="module_breadth[]"
                                                                id="module_breadth" min="0" step="any"
                                                                placeholder="Enter Breadth of Module (in mm)"
                                                                value="<?php echo e($annexuredata->module_breadth[$loop->iteration-1] ?? ''); ?>">
                                                        </td>
                                                        <td><input type="number" name="module_area[]" id="module_area"
                                                                min="0" step="any"
                                                                placeholder="Enter Area of Module (LxB) (in m2)"
                                                                value="<?php echo e($annexuredata->module_area[$loop->iteration-1] ?? ''); ?>">
                                                        </td>
                                                        <td><input type="number" name="module_weight[]"
                                                                id="module_weight" min="0" step="any"
                                                                placeholder="Enter Weight (in kg)"
                                                                value="<?php echo e($annexuredata->module_weight[$loop->iteration-1] ?? ''); ?>">
                                                        </td>
                                                        <td width="8%">
                                                            <?php if($loop->iteration==1): ?>
                                                            <a href="javascript:;" id="add-row-5">Add
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
                                                        <td><input type="text" name="applicable_mean_wattage_5[]"
                                                                placeholder="Applicable models covered under ± 5% of Mean Wattage"
                                                                id="applicable_mean_wattage" class="form-control"
                                                                maxlength="70" value="" step="any">
                                                        </td>
                                                        <td><input type="text" name="pmax_applicable_model_5[]"
                                                                placeholder="Pmax (Wp) of Applicable Models Model"
                                                                id="pmax_applicable_model" class="form-control"
                                                                maxlength="70" value="" step="any">
                                                        </td>
                                                        <td> <input type="number" min="0" step="any"
                                                                name="module_length[]" id="module_length"
                                                                placeholder="Enter Length of Module (in mm)">
                                                        </td>
                                                        <td><input type="number" name="module_breadth[]"
                                                                id="module_breadth" min="0" step="any"
                                                                placeholder="Enter Breadth of Module (in mm)"></td>
                                                        <td><input type="number" name="module_area[]" id="module_area"
                                                                min="0" step="any"
                                                                placeholder="Enter Area of Module (LxB) (in m2)"></td>
                                                        <td><input type="number" name="module_weight[]"
                                                                id="module_weight" min="0" step="any"
                                                                placeholder="Enter Weight (in kg)"></td>

                                                        <td width="8%"><a href="javascript:;" id="add-row-5">Add
                                                                <i class="fa fa-plus text-success"></i></a>
                                                        </td>

                                                    </tr>
                                                    <?php endif; ?>
                                                </tbody>
                                            </table>
                                            <table class="table table-bordered module_type" id="module_type6"
                                                style="display:<?php if(isset($annexuredata->sub_annexure) && $annexuredata->sub_annexure==6): ?>block <?php else: ?> none <?php endif; ?>">
                                                <tr>
                                                    <th>S.No</th>
                                                    <th>Applicable models covered under ± 5% of Mean Wattage</th>
                                                    <th>Pmax (Wp) of Applicable Models Model</th>
                                                    <th>Technology type of solar cells</th>
                                                    <th>Efficiency of solar cells</th>
                                                    <th>Wattage of full solar cells (Wp)</th>
                                                    <th>Full Cell Size (Dimension in mm)</th>
                                                    <th>Cell Type used in module</th>
                                                    <th>No of Cells in a Module</th>
                                                    <th>Number of bus bars per cell</th>
                                                    <th></th>

                                                </tr>
                                                <tbody id="add-data-6">
                                                    <?php if($annexuredata!=null && $annexuredata->sub_annexure==6): ?>

                                                    <?php $__currentLoopData = $annexuredata->applicable_mean_wattage; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr class="record">
                                                        <td><?php echo e($loop->iteration); ?></td>
                                                        <td><input type="text" name="applicable_mean_wattage_6[]"
                                                                placeholder="Applicable models covered under ± 5% of Mean Wattage"
                                                                id="applicable_mean_wattage_<?php echo e($loop->iteration); ?>"
                                                                class="form-control" maxlength="70"
                                                                value="<?php echo e($annexuredata->applicable_mean_wattage[$loop->iteration-1] ?? ''); ?>">
                                                        </td>
                                                        <td><input type="text" name="pmax_applicable_model_6[]"
                                                                placeholder="Pmax (Wp) of Applicable Models Model"
                                                                id="pmax_applicable_model" class="form-control"
                                                                maxlength="70" value="" step="any"
                                                                value="<?php echo e($annexuredata->pmax_applicable_model[$loop->iteration-1] ?? ''); ?>">
                                                        </td>
                                                        <td> <input type="text" name="cell_technology[]"
                                                                id="cell_technology"
                                                                placeholder="Enter Technology type of solar cells"
                                                                value="<?php echo e($annexuredata->cell_technology[$loop->iteration-1] ?? ''); ?>">
                                                        </td>
                                                        <td><input type="text" name="cell_efficiency[]"
                                                                id="cell_efficiency"
                                                                placeholder="Enter Efficiency of solar cells"
                                                                value="<?php echo e($annexuredata->cell_efficiency[$loop->iteration-1] ?? ''); ?>">
                                                        </td>
                                                        <td><input type="number" name="cell_wattage[]" id="cell_wattage"
                                                                min="0" step="any"
                                                                placeholder="Enter Wattage of full solar cells (Wp)"
                                                                value="<?php echo e($annexuredata->cell_wattage[$loop->iteration-1] ?? ''); ?>">
                                                        </td>
                                                        <td><input type="number" name="cell_dimension[]"
                                                                id="cell_dimension" min="0" step="any"
                                                                placeholder="Enter Full Cell Size (Dimension in mm)"
                                                                value="<?php echo e($annexuredata->cell_dimension[$loop->iteration-1] ?? ''); ?>">
                                                        </td>
                                                        <td><select name="cell_type[]" id="cell_type[]">
                                                                <option value="Full" <?php if($annexuredata->
                                                                    cell_type[$loop->iteration-1] == 'Full'): ?>
                                                                    selected <?php endif; ?>>Full</option>
                                                                <option value="Half" <?php if($annexuredata->
                                                                    cell_type[$loop->iteration-1] == 'Half'): ?>
                                                                    selected <?php endif; ?>>Half</option>
                                                                <option value="Third" <?php if($annexuredata->
                                                                    cell_type[$loop->iteration-1] == 'Third'): ?>
                                                                    selected <?php endif; ?>>Third</option>
                                                            </select>
                                                        </td>
                                                        <td><input type="number" name="cell_total_no[]"
                                                                id="cell_total_no" min="0" step="any"
                                                                placeholder="Enter No of Cells in a Module"
                                                                value="<?php echo e($annexuredata->cell_total_no[$loop->iteration-1] ?? ''); ?>">
                                                        </td>
                                                        <td><input type="number" name="cell_total_bus[]"
                                                                id="cell_total_bus" min="0" step="any"
                                                                placeholder="Enter Number of bus bars per cell"
                                                                value="<?php echo e($annexuredata->cell_total_bus[$loop->iteration-1] ?? ''); ?>">
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
                                                        <td><input type="text" name="applicable_mean_wattage_6[]"
                                                                placeholder="Applicable models covered under ± 5% of Mean Wattage"
                                                                id="applicable_mean_wattage" class="form-control"
                                                                maxlength="70" value="" step="any">
                                                        </td>
                                                        <td><input type="text" name="pmax_applicable_model_6[]"
                                                                placeholder="Pmax (Wp) of Applicable Models Model"
                                                                id="pmax_applicable_model" class="form-control"
                                                                maxlength="70" value="" step="any">
                                                        </td>
                                                        <td> <input type="text" name="cell_technology[]"
                                                                id="cell_technology"
                                                                placeholder="Enter Technology type of solar cells">
                                                        </td>
                                                        <td><input type="text" name="cell_efficiency[]"
                                                                id="cell_efficiency"
                                                                placeholder="Enter Efficiency of solar cells"></td>
                                                        <td><input type="number" name="cell_wattage[]" id="cell_wattage"
                                                                min="0" step="any"
                                                                placeholder="Enter Wattage of full solar cells (Wp)">
                                                        </td>
                                                        <td><input type="number" name="cell_dimension[]"
                                                                id="cell_dimension" min="0" step="any"
                                                                placeholder="Enter Full Cell Size (Dimension in mm)">
                                                        </td>
                                                        <td><select name="cell_type[]" id="cell_type[]">
                                                                <option value="Full">Full</option>
                                                                <option value="Half">Half</option>
                                                                <option value="Third">Third</option>
                                                            </select>
                                                        </td>
                                                        <td><input type="number" name="cell_total_no[]"
                                                                id="cell_total_no" min="0" step="any"
                                                                placeholder="Enter No of Cells in a Module">
                                                        </td>
                                                        <td><input type="number" name="cell_total_bus[]"
                                                                id="cell_total_bus" min="0" step="any"
                                                                placeholder="Enter Number of bus bars per cell">
                                                        </td>

                                                        <td width="8%"><a href="javascript:;" id="add-row-6">Add
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
                                            <a href="<?php echo e(URL::to('users/annexure-one-c/'.$application_id)); ?>"
                                                class="btn btn-danger"> Cancel </a>

                                        </td>
                                    </tr>
                                </table>


                            </form>
                            <table class="table table-bordered text-center">
                                <thead>
                                    <tr class="bg-warning">
                                        <th>3.3</th>
                                        <th scope="col" colspan="14" class="text-left">Module Operational Ratings</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th rowspan="2">S.No</th>
                                        <th rowspan="2">Type Of Modules</th>
                                        <th rowspan="2">Main Model</th>
                                        <th rowspan="2">Pmax (Wp) of Main Model</th>
                                        <th rowspan="2" width="10%">Applicable models covered under +- 5% of
                                            Mean Wattege</th>
                                        <th rowspan="2" width="10%">Pmax (Wp) of Applicable Models Model</th>
                                        <th colspan="6" class="text-center">Operational Ratings</th>
                                        <th></th>
                                    </tr>
                                    <tr>

                                        <th>Operational Temperature (ᴼC)</th>
                                        <th>Maximum System Voltage (V)</th>
                                        <th>Maximum Fuse Rating</th>
                                        <th>By-pass Diode Rating</th>
                                        <th>Fire Rating</th>
                                        <th>Warranty Details</th>
                                    </tr>
                                    <?php $a=0; ?>
                                    <?php $__currentLoopData = $appData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data_3): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                    <?php if($data_3->sub_annexure ==3): ?>
                                    <?php $a++; ?>
                                    <tr class="text-center">
                                        <td><?php echo e($a); ?></td>
                                        <td><?php echo e($data_3->module_type); ?></td>
                                        <td><?php echo e($data_3->model_code); ?></td>
                                        <td><?php echo e($data_3->pmax_model); ?></td>
                                        <td>
                                            <table width="100%">
                                                <?php $__currentLoopData = json_decode($data_3->pmax_applicable_model); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pmax_applicable_model): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td style="border-bottom:1px solid #ccc;">
                                                        <?php echo e($pmax_applicable_model); ?></td>
                                                </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </table>
                                        </td>
                                        <td>
                                            <table width="100%">
                                                <?php $__currentLoopData = json_decode($data_3->applicable_mean_wattage); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $applicable_mean_wattage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td style="border-bottom:1px solid #ccc;">
                                                        <?php echo e($applicable_mean_wattage); ?></td>
                                                </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </table>
                                        </td>
                                        <td>
                                            <table width="100%">
                                                <?php $__currentLoopData = json_decode($data_3->operation_temp); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $operation_temp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td style="border-bottom:1px solid #ccc;">
                                                        <?php echo e($operation_temp); ?></td>
                                                </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </table>
                                        </td>
                                        <td>
                                            <table width="100%">
                                                <?php $__currentLoopData = json_decode($data_3->max_voltage); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $max_voltage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td style="border-bottom:1px solid #ccc;">
                                                        <?php echo e($max_voltage); ?></td>
                                                </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </table>
                                        </td>

                                        <td>
                                            <table width="100%">
                                                <?php $__currentLoopData = json_decode($data_3->max_fuse_rating); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $max_fuse_rating): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td style="border-bottom:1px solid #ccc;">
                                                        <?php echo e($max_fuse_rating); ?></td>
                                                </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </table>
                                        </td>
                                        <td>
                                            <table width="100%">
                                                <?php $__currentLoopData = json_decode($data_3->diode_rating); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $diode_rating): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td style="border-bottom:1px solid #ccc;">
                                                        <?php echo e($diode_rating); ?></td>
                                                </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </table>
                                        </td>
                                        <td>
                                            <table width="100%">
                                                <?php $__currentLoopData = json_decode($data_3->fire_rating); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fire_rating): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td style="border-bottom:1px solid #ccc;">
                                                        <?php echo e($fire_rating); ?></td>
                                                </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </table>
                                        </td>
                                        <td>
                                            <table width="100%">
                                                <?php $__currentLoopData = json_decode($data_3->fire_rating); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fire_rating): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td style="border-bottom:1px solid #ccc;">
                                                        <?php echo e($fire_rating); ?></td>
                                                </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </table>
                                        </td>
                                        <td>
                                            <a
                                                href="<?php echo e(URL::to('users/annexure-one-c/'.$data_3->application_id.'/'.$data_3->id)); ?>">Edit
                                                <i class="fa fa-edit"></i></a>
                                            <a href="<?php echo e(URL::to('users/delete-annexure/1/'.$data_3->id)); ?>"
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
                                    <tr class="bg-warning">
                                        <th>3.4</th>
                                        <th scope="col" colspan="13" class="text-left">Module Temperature
                                            Characteristics</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th rowspan="2">S.No</th>
                                        <th rowspan="2">Type Of Modules</th>
                                        <th rowspan="2">Main Model</th>
                                        <th rowspan="2">Pmax (Wp) of Main Model</th>
                                        <th rowspan="2" width="15%">Applicable models covered under +- 5% of
                                            Mean Wattege</th>
                                        <th rowspan="2" width="15%">Pmax (Wp) of Applicable Models Model</th>
                                        <th colspan="3" class="text-center">Module Temperature Characteristics</th>
                                        <th width="8%"></th>
                                    </tr>
                                    <tr>

                                        <th>Temperature Co-efficient of Pmax</th>
                                        <th>Temperature Coefficient of Voc</th>
                                        <th>Temperature Coefficient of Isc)</th>
                                    </tr>
                                    <?php $b=0; ?>
                                    <?php $__currentLoopData = $appData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data_4): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($data_4->sub_annexure ==4): ?>
                                    <?php $b++; ?>
                                    <tr>
                                        <td><?php echo e($b); ?></td>
                                        <td><?php echo e($data_4->module_type); ?></td>
                                        <td><?php echo e($data_4->model_code); ?></td>
                                        <td><?php echo e($data_4->pmax_model); ?></td>
                                        <td>
                                            <table width="100%">
                                                <?php $__currentLoopData = json_decode($data_4->applicable_mean_wattage); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $applicable_mean_wattage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td style="border-bottom:1px solid #ccc;">
                                                        <?php echo e($applicable_mean_wattage); ?></td>
                                                </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </table>
                                        </td>
                                        <td>
                                            <table width="100%">
                                                <?php $__currentLoopData = json_decode($data_4->pmax_applicable_model); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pmax_applicable_model): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td style="border-bottom:1px solid #ccc;">
                                                        <?php echo e($pmax_applicable_model); ?></td>
                                                </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </table>
                                        </td>


                                        <td>
                                            <table width="100%">
                                                <?php $__currentLoopData = json_decode($data_4->pmax_watt); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pmax_watt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td style="border-bottom:1px solid #ccc;">
                                                        <?php echo e($pmax_watt); ?></td>
                                                </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </table>
                                        </td>
                                        <td>
                                            <table width="100%">
                                                <?php $__currentLoopData = json_decode($data_4->voc); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $voc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td style="border-bottom:1px solid #ccc;">
                                                        <?php echo e($voc); ?></td>
                                                </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </table>
                                        </td>
                                        <td>
                                            <table width="100%">
                                                <?php $__currentLoopData = json_decode($data_4->isc); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $isc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td style="border-bottom:1px solid #ccc;">
                                                        <?php echo e($isc); ?></td>
                                                </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </table>
                                        </td>
                                        <td>
                                            <a
                                                href="<?php echo e(URL::to('users/annexure-one-c/'.$data_4->application_id.'/'.$data_4->id)); ?>">Edit
                                                <i class="fa fa-edit"></i></a>
                                            <a href="<?php echo e(URL::to('users/delete-annexure/1/'.$data_4->id)); ?>"
                                                onCLick="if (confirm('Are you sure to delete?')) { }else{ return false;}"
                                                class="text-danger">Delete <i class="fa fa-trash"></i></a>
                                        </td>

                                    </tr>
                                    <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                </tbody>
                            </table><br>
                            <table class="table table-bordered text-center">
                                <thead>
                                    <tr class="bg-warning">
                                        <th>3.5</th>
                                        <th scope="col" colspan="13" class="text-left">Module Dimensions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th rowspan="2">S.No</th>
                                        <th rowspan="2">Type Of Modules</th>
                                        <th rowspan="2">Main Model</th>
                                        <th rowspan="2">Pmax (Wp) of Main Model</th>
                                        <th rowspan="2" width="15%">Applicable models covered under +- 5% of
                                            Mean Wattege</th>
                                        <th rowspan="2" width="15%">Pmax (Wp) of Applicable Models Model</th>
                                        <th colspan="4" class="text-center">Module Dimensions</th>
                                        <th width="8%"></th>
                                    </tr>
                                    <tr>

                                        <th>Length of Module (in mm)</th>
                                        <th>Breadth of Module (in mm)</th>
                                        <th>Area of Module (LxB) (in m2)</th>
                                        <th>Weight (in kg)</th>
                                    </tr>
                                    <?php $c=0; ?>
                                    <?php $__currentLoopData = $appData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data_5): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($data_5->sub_annexure ==5): ?>
                                    <?php $c++; ?>
                                    <tr>
                                        <td><?php echo e($c); ?></td>
                                        <td><?php echo e($data_5->module_type); ?></td>
                                        <td><?php echo e($data_5->model_code); ?></td>
                                        <td><?php echo e($data_5->pmax_model); ?></td>
                                        <td>
                                            <table width="100%">
                                                <?php $__currentLoopData = json_decode($data_5->applicable_mean_wattage); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $applicable_mean_wattage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td style="border-bottom:1px solid #ccc;">
                                                        <?php echo e($applicable_mean_wattage); ?></td>
                                                </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </table>
                                        </td>
                                        <td>
                                            <table width="100%">
                                                <?php $__currentLoopData = json_decode($data_5->pmax_applicable_model); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pmax_applicable_model): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td style="border-bottom:1px solid #ccc;">
                                                        <?php echo e($pmax_applicable_model); ?></td>
                                                </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </table>
                                        </td>


                                        <td>
                                            <table width="100%">
                                                <?php $__currentLoopData = json_decode($data_5->module_length); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $module_length): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td style="border-bottom:1px solid #ccc;">
                                                        <?php echo e($module_length); ?></td>
                                                </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </table>
                                        </td>
                                        <td>
                                            <table width="100%">
                                                <?php $__currentLoopData = json_decode($data_5->module_breadth); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $module_breadth): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td style="border-bottom:1px solid #ccc;">
                                                        <?php echo e($module_breadth); ?></td>
                                                </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </table>
                                        </td>
                                        <td>
                                            <table width="100%">
                                                <?php $__currentLoopData = json_decode($data_5->module_area); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $module_area): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td style="border-bottom:1px solid #ccc;">
                                                        <?php echo e($module_area); ?></td>
                                                </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </table>
                                        </td>
                                        <td>
                                            <table width="100%">
                                                <?php $__currentLoopData = json_decode($data_5->module_weight); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $module_weight): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td style="border-bottom:1px solid #ccc;">
                                                        <?php echo e($module_weight); ?></td>
                                                </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </table>
                                        </td>
                                        <td>
                                            <a
                                                href="<?php echo e(URL::to('users/annexure-one-c/'.$data_5->application_id.'/'.$data_5->id)); ?>">Edit
                                                <i class="fa fa-edit"></i></a>
                                            <a href="<?php echo e(URL::to('users/delete-annexure/1/'.$data_5->id)); ?>"
                                                onCLick="if (confirm('Are you sure to delete?')) { }else{ return false;}"
                                                class="text-danger">Delete <i class="fa fa-trash"></i></a>
                                        </td>

                                    </tr>
                                    <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                </tbody>
                            </table><br>
                            <table class="table table-bordered text-center">
                                <thead>
                                    <tr class="bg-warning">
                                        <th>3.6</th>
                                        <th scope="col" colspan="13" class="text-left">Solar Cell Specifications</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th rowspan="2">S.No</th>
                                        <th rowspan="2">Type Of Modules</th>
                                        <th rowspan="2">Main Model</th>
                                        <th rowspan="2">Pmax (Wp) of Main Model</th>
                                        <th rowspan="2" width="15%">Applicable models covered under +- 5% of
                                            Mean Wattege</th>
                                        <th rowspan="2" width="15%">Pmax (Wp) of Applicable Models Model</th>
                                        <th colspan="4" class="text-center">Module Dimensions</th>
                                        <th width="10%"></th>
                                    </tr>
                                    <tr>

                                        <th>Technology type of solar cells</th>
                                        <th>Efficiency of solar cells</th>
                                        <th>Wattage of full solar cells</th>
                                        <th>Full Cell Size (Dimension in mm)</th>
                                        <th>Cell Type used in module (Full/Half/Third)</th>
                                        <th>No of Cells in a Module</th>
                                        <th>Number of bus bars per cell</th>
                                    </tr>
                                    <?php $d=0; ?>
                                    <?php $__currentLoopData = $appData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data_6): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($data_6->sub_annexure ==6): ?>
                                    <?php $d++; ?>
                                    <tr>
                                        <td><?php echo e($d); ?></td>
                                        <td><?php echo e($data_6->module_type); ?></td>
                                        <td><?php echo e($data_6->model_code); ?></td>
                                        <td><?php echo e($data_6->pmax_model); ?></td>
                                        <td>
                                            <table width="100%">
                                                <?php $__currentLoopData = json_decode($data_6->applicable_mean_wattage); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $applicable_mean_wattage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td style="border-bottom:1px solid #ccc;">
                                                        <?php echo e($applicable_mean_wattage); ?></td>
                                                </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </table>
                                        </td>
                                        <td>
                                            <table width="100%">
                                                <?php $__currentLoopData = json_decode($data_6->pmax_applicable_model); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pmax_applicable_model): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td style="border-bottom:1px solid #ccc;">
                                                        <?php echo e($pmax_applicable_model); ?></td>
                                                </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </table>
                                        </td>


                                        <td>
                                            <table width="100%">
                                                <?php $__currentLoopData = json_decode($data_6->cell_technology); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cell_technology): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td style="border-bottom:1px solid #ccc;">
                                                        <?php echo e($cell_technology); ?></td>
                                                </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </table>
                                        </td>
                                        <td>
                                            <table width="100%">
                                                <?php $__currentLoopData = json_decode($data_6->cell_efficiency); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cell_efficiency): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td style="border-bottom:1px solid #ccc;">
                                                        <?php echo e($cell_efficiency); ?></td>
                                                </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </table>
                                        </td>
                                        <td>
                                            <table width="100%">
                                                <?php $__currentLoopData = json_decode($data_6->cell_wattage); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cell_wattage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td style="border-bottom:1px solid #ccc;">
                                                        <?php echo e($cell_wattage); ?></td>
                                                </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </table>
                                        </td>
                                        <td>
                                            <table width="100%">
                                                <?php $__currentLoopData = json_decode($data_6->cell_dimension); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cell_dimension): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td style="border-bottom:1px solid #ccc;">
                                                        <?php echo e($cell_dimension); ?></td>
                                                </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </table>
                                        </td>
                                        <td>
                                            <table width="100%">
                                                <?php $__currentLoopData = json_decode($data_6->cell_type); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cell_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td style="border-bottom:1px solid #ccc;">
                                                        <?php echo e($cell_type); ?></td>
                                                </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </table>
                                        </td>
                                        <td>
                                            <table width="100%">
                                                <?php $__currentLoopData = json_decode($data_6->cell_total_no); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cell_total_no): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td style="border-bottom:1px solid #ccc;">
                                                        <?php echo e($cell_total_no); ?></td>
                                                </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </table>
                                        </td>
                                        <td>
                                            <table width="100%">
                                                <?php $__currentLoopData = json_decode($data_6->cell_total_bus); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cell_total_bus): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td style="border-bottom:1px solid #ccc;">
                                                        <?php echo e($cell_total_bus); ?></td>
                                                </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </table>
                                        </td>
                                        <td>
                                            <a
                                                href="<?php echo e(URL::to('users/annexure-one-c/'.$data_6->application_id.'/'.$data_6->id)); ?>">Edit
                                                <i class="fa fa-edit"></i></a>
                                            <a href="<?php echo e(URL::to('users/delete-annexure/1/'.$data_6->id)); ?>"
                                                onCLick="if (confirm('Are you sure to delete?')) { }else{ return false;}"
                                                class="text-danger">Delete <i class="fa fa-trash"></i></a>
                                        </td>

                                    </tr>
                                    <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                </tbody>
                                <tr>
                                    <th colspan="14">
                                        <?php if(!$appData->isEmpty()): ?>
                                        <a href="<?php echo e(URL::to('users/annexure-two/'.$application_id)); ?>"
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
    function getDataValue(data) {
        var dt = $(data).find(':selected').attr('data-id');
        $('#model_code').val(dt);
    }

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
                '</td><td><input type="number" step="any" min="0" value="0" name="applicable_mean_wattage[]" placeholder="Applicable models covered under ± 5% of Mean Wattage" id="applicable_mean_wattage' +
                counter +
                '" class="form-control" maxlength="70" value="0"></td><td><input type="text" name="pmax_applicable_model[]" placeholder="Pmax (Wp) of Applicable Models Model" id="pmax_applicable_model' +
                counter +
                '" class="form-control" maxlength="70" value="0"></td><td><input type="number" min="0" value="0" step="any" name="operation_temp[]" id="operation_temp_' +
                counter +
                '" placeholder=" Operational Temperature (ᴼC)"  class="form-control" ></td><td><input  type="number" min="0" step="any" name="max_voltage[]" id="max_voltage_' +
                counter +
                '" placeholder="Maximum System Voltage (V)" value="0" class="form-control" ></td><td><input  type="number" min="0" step="any" name="max_fuse_rating[]" id="max_fuse_rating_' +
                counter +
                '" placeholder="Maximum Fuse Rating" value="0" class="form-control" ></td><td><input type="number" value="0" min="0" step="any" name="diode_rating[]" id="diode_rating_' +
                counter +
                '" placeholder="By-pass Diode Rating" class="form-control" ></td><td><input  type="number" min="0" value="0" step="any" name="fire_rating[]" id="fire_rating_' +
                counter +
                '" placeholder="Enter Fire Rating" step="any" min="0" value="0" class="form-control" ></td><td><input type="text"  name="warrenty_details[]" id="warrenty_details_' +
                counter +
                '" placeholder="Enter Warranty Details" maxlength="250" class="form-control" ></td><td><a href="javascript:;" class="remove_fields">Delete <i class="fa fa-trash text-danger"></i></a></td></tr>';
            tableBody = $("#add-data-3");
            tableBody.append(markup);
        });
        //Module Temperature Characteristics
        $("#add-row-4").click(function() {
            counter = counter + 1;
            markup =
                '<tr class="record record4"><td>' +
                counter +
                '</td><td><input type="text" name="applicable_mean_wattage_4[]" placeholder="Applicable models covered under ± 5% of Mean Wattage" id="applicable_mean_wattage_' +
                counter +
                '" class="form-control"  maxlength="70" value=""></td><td><input type="text" name="pmax_applicable_model_4[]"  placeholder="Pmax (Wp) of Applicable Models Model" id="pmax_applicable_model' +
                counter +
                '" class="form-control" maxlength="70" value=""></td><td><input  type="number" min="0" step="any" name="pmax_watt[]" id="pmax_watt_' +
                counter +
                '" placeholder="Enter Temperature Co-efficient of Pmax " class="form-control" ></td><td><input  type="number" min="0" step="any" name="voc[]" id="voc_' +
                counter +
                '" placeholder="Enter Voc (V)" class="form-control" ></td><td><input type="number" min="0" step="any" name="isc[]" id="isc_' +
                counter +
                '" placeholder="Enter Isc (A)" class="form-control" ></td><td><a href="javascript:;" class="remove_fields">Delete <i class="fa fa-trash text-danger"></i></a></td></tr>';
            tableBody = $("#add-data-4");
            tableBody.append(markup);
        });
        //Module Dimensions
        $("#add-row-5").click(function() {
            counter = counter + 1;
            markup =
                '<tr class="record record5"><td>' +
                counter +
                '</td><td><input type="text" name="applicable_mean_wattage_5[]" placeholder="Applicable models covered under ± 5% of Mean Wattage" id="applicable_mean_wattage_' +
                counter +
                '" class="form-control"  maxlength="70" value=""></td><td><input type="text" name="pmax_applicable_model_5[]"  placeholder="Pmax (Wp) of Applicable Models Model" id="pmax_applicable_model' +
                counter +
                '" class="form-control" maxlength="70" value=""></td><td><input  type="number" min="0" step="any" name="module_length[]" id="module_length_' +
                counter +
                '" placeholder="Enter Length of Module (in mm)" class="form-control" ></td><td><input  type="number" min="0" step="any" name="module_breadth[]" id="module_breadth_' +
                counter +
                '" placeholder="Enter Breadth of Module (in mm)" class="form-control" ></td><td><input type="number" min="0" step="any" name="module_area[]" id="module_area_' +
                counter +
                '" placeholder="Enter Area of Module (LxB) (in m2)" class="form-control" ></td><td><input type="number" min="0" step="any" name="module_weight[]" id="module_weight_' +
                counter +
                '" placeholder="Enter Weight (in kg)" class="form-control" ></td><td><a href="javascript:;" class="remove_fields">Delete <i class="fa fa-trash text-danger"></i></a></td></tr>';
            tableBody = $("#add-data-5");
            tableBody.append(markup);
        });
        //Solar Cell Specifications
        $("#add-row-6").click(function() {
            counter = counter + 1;
            markup =
                '<tr class="record record6"><td>' +
                counter +
                '</td><td><input type="text" name="applicable_mean_wattage_6[]" placeholder="Applicable models covered under ± 5% of Mean Wattage" id="applicable_mean_wattage_' +
                counter +
                '" class="form-control"  maxlength="70" value=""></td><td><input type="text" name="pmax_applicable_model_6[]"  placeholder="Pmax (Wp) of Applicable Models Model" id="pmax_applicable_model' +
                counter +
                '" class="form-control" maxlength="70" value=""></td><td><input  type="text" name="cell_technology[]" id="cell_technology_' +
                counter +
                '" placeholder="Enter Technology type of solar cells" class="form-control" ></td><td><input  type="number" min="0" step="any" name="cell_efficiency[]" id="cell_efficiencyh_' +
                counter +
                '" placeholder="Enter Efficiency of solar cells" class="form-control" ></td><td><input type="number" min="0" step="any" name="cell_wattage[]" id="cell_wattage_' +
                counter +
                '" placeholder="Enter Wattage of full solar cells (Wp)" class="form-control" ></td><td><input type="number" min="0" step="any" name="cell_dimension[]" id="cell_dimension_' +
                counter +
                '" placeholder="Enter Full Cell Size (Dimension in mm)" class="form-control" ></td><td><select name="cell_type[]" id="cell_type' +
                counter +
                '"> <option value="Full">Full</option> <option value="Half">Half</option> <option value="Third">Third</option></select></td><td><input type="number" name="cell_total_no[]" id="cell_total_no_' +
                counter +
                '" min="0" step="any" placeholder="Enter No of Cells in a Module"></td><td><input type="number" name="cell_total_bus[]" id="cell_total_bus_' +
                counter +
                '" min="0" step="any" placeholder="Enter Number of bus bars per cell"></td><td><a href="javascript:;" class="remove_fields">Delete <i class="fa fa-trash text-danger"></i></a></td></tr>';
            tableBody = $("#add-data-6");
            tableBody.append(markup);
        });
    });
    </script>
    <?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.masters.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xamp\htdocs\ALMM\resources\views/backend/user/form/annexureOne/annexure1_3.blade.php ENDPATH**/ ?>