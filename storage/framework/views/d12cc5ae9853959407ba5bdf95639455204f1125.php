
<?php $__env->startSection('title', 'Annexure 4 '); ?>
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
                            <form action="<?php echo e(URL::to('/users/annexure-four-two')); ?>" method="POST"
                                enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('POST'); ?>
                                <table class="table table-bordered" id="show_data"
                                    style="display:<?php if($annexuredata!=null): ?>  <?php else: ?> none <?php endif; ?>">
                                    <tr>
                                        <th>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label for="">Line</label>
                                                    <select name="line" id="line" class="form-control">
                                                        <option value="">Select Line</option>
                                                        <option value="1" <?php if($annexuredata!=null && $annexuredata->
                                                            line==1): ?> selected <?php endif; ?>>Line 1</option>
                                                        <option value="2" <?php if($annexuredata!=null && $annexuredata->
                                                            line==2): ?> selected <?php endif; ?>>Line 2</option>
                                                    </select>

                                                </div>
                                                <div class="col-md-6">
                                                    <label for="">Compatible Technology <i class="text-primary">(Cell
                                                            Type/Max Cell Size/No. of
                                                            Bus Bar)</i></label>
                                                    <input type="text" name="compatible_technology"
                                                        placeholder="Enter Compatible Technology"
                                                        id="compatible_technology" class="compatible_technology-control"
                                                        maxlength="70"
                                                        value="<?php echo e($annexuredata->compatible_technology ?? ''); ?>">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="">Commissioning Date</label>
                                                    <input type="date" name="commissioning_date"
                                                        placeholder="Commissioning Date" id="commissioning_date"
                                                        class="form-control" maxlength="70"
                                                        value="<?php echo e($annexuredata->commissioning_date ?? ''); ?>">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="">Rated Manufacturing Capacity <i
                                                            class="text-primary">(24*7 *365 days working)</i></label>
                                                    <input type="number" min="0" step="any" name="rated_mfg_capacity"
                                                        placeholder="Rated Manufacturing Capacity"
                                                        id="rated_mfg_capacity" class="form-control" maxlength="70"
                                                        value="<?php echo e($annexuredata->rated_mfg_capacity ?? ''); ?>">
                                                </div>



                                            </div>
                                        </th>
                                    </tr>
                                    <tr>
                                        <td>
                                            <table class="table table-bordered module_type" id="module_type3">
                                                <tr>
                                                    <th>S.No</th>
                                                    <th>List of Major Machines/Equipments</th>
                                                    <th>Machine Type</th>
                                                    <th>No. of Units</th>
                                                    <th>Make</th>
                                                    <th>Model</th>
                                                    <th>Specification/Rating</th>
                                                    <th>Country of Origin </th>
                                                    <th></th>

                                                </tr>
                                                <tbody id="add-data-3">
                                                    <?php if($annexuredata!=null): ?>

                                                    <?php $__currentLoopData = $annexuredata->major_equipments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr class="record">
                                                        <td><?php echo e($loop->iteration); ?></td>
                                                        <td>
                                                            <?php
                                                            $selectEquipment =
                                                            $annexuredata->major_equipments[$loop->iteration-1];
                                                            ?>
                                                            <select name="major_equipments[]" id="major_equipments"
                                                                class="form-control">
                                                                <option value="">Select Machine</option>
                                                                <?php $__currentLoopData = $machineList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $machine): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <option value="<?php echo e($machine->id); ?>"
                                                                    <?php if($selectEquipment==$machine->id): ?>selected
                                                                    <?php endif; ?>><?php echo e($machine->title); ?>

                                                                </option>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <select name="equipments_type[]" id="equipments_type"
                                                                class="form-control">
                                                                <option value="0">Not Available</option>
                                                                <option value="1" <?php if($annexuredata->
                                                                    equipments_type[$loop->iteration-1]==1): ?>selected
                                                                    <?php endif; ?>>Manual</option>
                                                                <option value="2" <?php if($annexuredata->
                                                                    equipments_type[$loop->iteration-1]==2): ?>selected
                                                                    <?php endif; ?>>Semi-Automatic</option>
                                                                <option value="3" <?php if($annexuredata->
                                                                    equipments_type[$loop->iteration-1]==3): ?>selected
                                                                    <?php endif; ?>>Automatic</option>
                                                            </select>
                                                        </td>
                                                        <td> <input type="number" min="0" step="any"
                                                                name="no_of_units[]" id="no_of_units"
                                                                placeholder="No of units"
                                                                value="<?php echo e($annexuredata->no_of_units[$loop->iteration-1]); ?>">
                                                        </td>
                                                        <td> <input type="text" name="make[]" id="make"
                                                                placeholder="Enter Making of Equipment"
                                                                value="<?php echo e($annexuredata->make[$loop->iteration-1]); ?>">
                                                        </td>
                                                        <td><input type="text" name="model[]" id="model"
                                                                placeholder="Enter Model"
                                                                value="<?php echo e($annexuredata->model[$loop->iteration-1]); ?>">
                                                        </td>
                                                        <td><input type="text" name="rating[]" id="rating"
                                                                placeholder="Enter Specification/Rating"
                                                                value="<?php echo e($annexuredata->rating[$loop->iteration-1]); ?>">
                                                        </td>
                                                        <td>
                                                            <?php
                                                            $selectCountry =
                                                            $annexuredata->country_of_origin[$loop->iteration-1];
                                                            ?>
                                                            <select name="country_of_origin[]" id="country_of_origin"
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
                                                        <td><select name="major_equipments[]" id="major_equipments"
                                                                class="form-control">
                                                                <option value="">Select Machine</option>
                                                                <?php $__currentLoopData = $machineList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $machine): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <option value="<?php echo e($machine->id); ?>"><?php echo e($machine->title); ?>

                                                                </option>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <select name="equipments_type[]" id="equipments_type"
                                                                class="form-control">
                                                                <option value="0">Not Available</option>
                                                                <option value="1">Manual</option>
                                                                <option value="2">Semi-Automatic</option>
                                                                <option value="3">Automatic</option>
                                                            </select>
                                                        </td>
                                                        <td> <input type="number" min="0" step="any"
                                                                name="no_of_units[]" id="no_of_units"
                                                                placeholder="No of units" value="">
                                                        </td>
                                                        <td> <input type="text" name="make[]" id="make"
                                                                placeholder="Enter Making of Equipment" value="">
                                                        </td>
                                                        <td><input type="text" name="model[]" id="model"
                                                                placeholder="Enter Model" value=""></td>
                                                        <td><input type="text" name="rating[]" id="rating"
                                                                placeholder="Enter Specification/Rating" value=""></td>
                                                        <td>
                                                            <select name="country_of_origin[]" id="country_of_origin"
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
                                            <a href="<?php echo e(URL::to('users/annexure-one-c/'.$application_id)); ?>"
                                                class="btn btn-danger"> Cancel </a>

                                        </td>
                                    </tr>
                                </table>


                            </form>
                            <table class="table table-bordered text-center">
                                <thead>
                                    <tr class="bg-warning">
                                        <th>5.2</th>
                                        <th scope="col" colspan="13" class="text-left">List of Major Machines/Equipments
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th width="6%"></th>
                                        <th width="5%">Line</th>
                                        <th width="10%">Compatible Technology (Cell Type/Max Cell Size/No. of Bus Bar)
                                        </th>
                                        <th>Commissioning Date</th>
                                        <th width="10%">Rated Manufacturing Capacity (24*7 *365 days working)</th>
                                        <th width="10%">List of Major Machines/Equipments</th>
                                        <th width="10%">Type</th>
                                        <th class="text-center">No. of Units</th>
                                        <th>Make</th>
                                        <th>Model</th>
                                        <th>Specification/Rating</th>
                                        <th>Country of Origin </th>

                                    </tr>
                                    <?php $__currentLoopData = $appData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td width="10%" rowspan="<?php echo e(count(json_decode($data->major_equipments))+1); ?>">
                                            <a
                                                href="<?php echo e(URL::to('users/annexure-four-two/'.$data->application_id.'/'.$data->id)); ?>">Edit
                                                <i class="fa fa-edit"></i></a>
                                            <a href="<?php echo e(URL::to('users/delete-annexure/4/'.$data->id)); ?>"
                                                onCLick="if (confirm('Are you sure to delete?')) { }else{ return false;}"
                                                class="text-danger">Delete <i class="fa fa-trash"></i></a>
                                        </td>
                                        <td rowspan="<?php echo e(count(json_decode($data->major_equipments))+1); ?>">
                                            <?php if($data->line==1): ?>
                                            Line 1
                                            <?php else: ?>
                                            Line 2
                                            <?php endif; ?></td>
                                        <td rowspan="<?php echo e(count(json_decode($data->major_equipments))+1); ?>">
                                            <?php echo e($data->compatible_technology); ?></td>
                                        <td rowspan="<?php echo e(count(json_decode($data->major_equipments))+1); ?>">
                                            <?php echo e($data->commissioning_date); ?></td>
                                        <td rowspan="<?php echo e(count(json_decode($data->major_equipments))+1); ?>">
                                            <?php echo e($data->rated_mfg_capacity); ?></td>




                                    </tr>
                                    <?php $__currentLoopData = json_decode($data->major_equipments); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $major_equipments): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="bg-gray">
                                        <td><?php echo e(json_decode($data->major_equipments)[$loop->iteration-1]); ?></td>
                                        <td><?php echo e(json_decode($data->equipments_type)[$loop->iteration-1]); ?></td>
                                        <td><?php echo e(json_decode($data->no_of_units)[$loop->iteration-1]); ?></td>
                                        <td><?php echo e(json_decode($data->make)[$loop->iteration-1]); ?></td>
                                        <td><?php echo e(json_decode($data->model)[$loop->iteration-1]); ?></td>
                                        <td><?php echo e(json_decode($data->rating)[$loop->iteration-1]); ?></td>
                                        <td><?php echo e(json_decode($data->country_of_origin)[$loop->iteration-1]); ?></td>


                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                </tbody>
                                <tr>
                                    <th colspan="13">
                                        <?php if(!$appData->isEmpty()): ?>

                                        <a href="<?php echo e(URL::to('users/annexure-four-three/'.$application_id)); ?>"
                                            class="btn btn-warning" style="float:right">Next <i
                                                class="fa fa-arrow-right"></i></a>
                                        <?php endif; ?>
                                        <a href="<?php echo e(URL::to('users/annexure-three/'.$application_id)); ?>"
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
                '</td><td><select name="major_equipments[]" id="major_equipments' +
                counter +
                '" class="form-control"> <option value="">Select Machine</option> <?php $__currentLoopData = $machineList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $machine): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <option value="<?php echo e($machine->id); ?>"><?php echo e($machine->title); ?> </option> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> </select></td><td><select name="equipments_type[]" id="equipments_type' +
                counter +
                '" class="form-control"> <option value="0">Not Available</option> <option value="1">Manual</option> <option value="2">Semi-Automatic</option> <option value="3">Automatic</option> </select></td><td><input type="number" min="0" value="" step="any" name="no_of_units[]" id="no_of_units_' +
                counter +
                '" placeholder="No of units"  class="form-control" ></td><td><input  type="text" step="any" name="make[]" id="make_' +
                counter +
                '" placeholder="Enter Making of Equipment" value="" class="form-control" ></td><td><input  type="text" name="model[]" id="model_' +
                counter +
                '" placeholder="Enter model" value="" class="form-control" ></td><td><input  type="text"  name="rating[]" id="rating_' +
                counter +
                '" placeholder="Enter Specification/Rating" value="" class="form-control" ></td><td><select name="country_of_origin[]" id="country_of_origin' +
                counter +
                '" class="form-control"> <option value="">Select Country</option> <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <option value="<?php echo e($country->countrycd); ?>"> <?php echo e($country->name); ?></option> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> </select></td><td><a href="javascript:;" class="remove_fields">Delete <i class="fa fa-trash text-danger"></i></a></td></tr>';
            tableBody = $("#add-data-3");
            tableBody.append(markup);
        });
    });
    </script>
    <?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.masters.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\almm\resources\views/backend/user/form/annexureFour/annexureFour2.blade.php ENDPATH**/ ?>