
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
                            <form action="<?php echo e(URL::to('/users/annexure-one-b')); ?>" method="POST"
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
                                                    <label for="">Electrical Data</label>
                                                    <select name="electrical_data_type" id="electrical_data_type"
                                                        class="form-control">
                                                        <option value="">Select</option>
                                                        <option value="1" <?php if(isset($annexuredata->electrical_data_type)
                                                            && $annexuredata->electrical_data_type==1): ?>
                                                            selected <?php endif; ?>>STC</option>
                                                        <option value="2" <?php if(isset($annexuredata->electrical_data_type)
                                                            && $annexuredata->electrical_data_type==2): ?>
                                                            selected <?php endif; ?>>NOCT</option>
                                                    </select>
                                                </div>


                                            </div>
                                        </th>
                                    </tr>
                                    <tr>
                                        <td>
                                            <table class="table table-bordered1">
                                                <tr>
                                                    <th>S.No</th>
                                                    <th>Applicable models covered under ± 5% of Mean
                                                        Wattage</th>
                                                    <th>Pmax (Wp) of Applicable Models Model</th>
                                                    <th>Pmax(Wp)</th>
                                                    <th>Vmp (V)</th>
                                                    <th>Imp (A)</th>
                                                    <th>Voc (V)</th>
                                                    <th>Isc (A)</th>
                                                    <th>Module Efficiency (%)</th>
                                                    <th>Fill Factor</th>
                                                    <th></th>

                                                </tr>
                                                <tbody id="add-data">
                                                    <?php if($annexuredata!=null): ?>

                                                    <?php $__currentLoopData = $annexuredata->vmp; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr class="record">
                                                        <td><?php echo e($loop->iteration); ?></td>
                                                        <td> <input type="number" min="0"
                                                                name="applicable_mean_wattage[]"
                                                                id="applicable_mean_wattage_<?php echo e($loop->iteration); ?>"
                                                                placeholder="Enter Applicable Mean Wattage"
                                                                value="<?php echo e($annexuredata->applicable_mean_wattage[$loop->iteration-1]); ?>">
                                                        </td>
                                                        <td> <input type="number" min="0" name="pmax_applicable_model[]"
                                                                id="pmax_applicable_model_<?php echo e($loop->iteration); ?>"
                                                                placeholder="Enter Mean
                                                        Wattage"
                                                                value="<?php echo e($annexuredata->pmax_applicable_model[$loop->iteration-1]); ?>">
                                                        </td>
                                                        <td> <input type="number" min="0" name="pmax_watt[]"
                                                                id="pmax_watt_<?php echo e($loop->iteration); ?>"
                                                                placeholder="Enter Pmax (Wp) "
                                                                value="<?php echo e($annexuredata->pmax_watt[$loop->iteration-1]); ?>">
                                                        </td>



                                                        <td> <input type="number" min="0" name="vmp[]"
                                                                id="vmp_<?php echo e($loop->iteration); ?>"
                                                                placeholder="Enter VMP (V) " value="<?php echo e($value); ?>">
                                                        </td>
                                                        <td> <input type="number" name="imp[]"
                                                                id="imp<?php echo e($loop->iteration-1); ?>" min="0" step="any"
                                                                placeholder="Enter Imp (A)"
                                                                value="<?php echo e($annexuredata->imp[$loop->iteration-1]); ?>">
                                                        </td>
                                                        <td><input type="number" name="voc[]" id="voc" min="0"
                                                                step="any" placeholder="Enter Voc (V)"
                                                                value="<?php echo e($annexuredata->voc[$loop->iteration-1]); ?>"></td>
                                                        <td><input type="number" name="isc[]" id="isc" min="0"
                                                                step="any" placeholder="Enter Isc (A)"
                                                                value="<?php echo e($annexuredata->isc[$loop->iteration-1]); ?>"></td>
                                                        <td><input type="number" name="model_efficiency[]"
                                                                id="model_efficiency" min="0" step="any"
                                                                placeholder="Enter Module Efficiency (%)"
                                                                value="<?php echo e($annexuredata->model_efficiency[$loop->iteration-1]); ?>">
                                                        </td>
                                                        <td><input type="text" name="fill_factor[]" id="fill_factor"
                                                                min="0" step="any" placeholder="Enter Fill Factor"
                                                                value="<?php echo e($annexuredata->fill_factor[$loop->iteration-1]); ?>">
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
                                                        <td> <input type="number" min="0"
                                                                name="applicable_mean_wattage[]"
                                                                id="applicable_mean_wattage"
                                                                placeholder="Enter Applicable Mean Wattage" value="0">
                                                        </td>
                                                        <td> <input type="number" min="0" name="pmax_applicable_model[]"
                                                                id="pmax_applicable_model" placeholder="Enter Mean
                                                        Wattage" value="0">
                                                        </td>
                                                        <td> <input type="number" min="0" name="pmax_watt[]"
                                                                id="pmax_watt" placeholder="Enter Pmax (Wp) " value="0">
                                                        </td>



                                                        <td> <input type="number" min="0" name="vmp[]" id="vmp"
                                                                placeholder="Enter VMP (V) " value="0">
                                                        </td>
                                                        <td> <input type="number" name="imp[]" id="imp" min="0"
                                                                step="any" placeholder="Enter Imp (A)" value="0">
                                                        </td>
                                                        <td><input type="number" name="voc[]" id="voc" min="0"
                                                                step="any" placeholder="Enter Voc (V)" value="0"></td>
                                                        <td><input type="number" name="isc[]" id="isc" min="0"
                                                                step="any" placeholder="Enter Isc (A)" value="0"></td>
                                                        <td><input type="number" name="model_efficiency[]"
                                                                id="model_efficiency" min="0" step="any"
                                                                placeholder="Enter Module Efficiency (%)" value="0">
                                                        </td>
                                                        <td><input type="text" name="fill_factor[]" id="fill_factor"
                                                                min="0" step="any" placeholder="Enter Fill Factor"
                                                                value="0">
                                                        </td>
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
                                            <a href="<?php echo e(URL::to('users/annexure-one-b/'.$application_id)); ?>"
                                                class="btn btn-danger"> Cancel <i class="fa fa-times"></i></a>

                                        </td>
                                    </tr>
                                </table>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>3.2</th>
                                            <th scope="col" colspan="13">Electrical Data (STC) of Solar PV Modules</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th rowspan="2">Sr.No</th>
                                            <th rowspan="2">Type Of Modules</th>
                                            <th rowspan="2">Main Model</th>

                                            <th rowspan="2" width="10%">Pmax (Wp) of Main Model</th>
                                            <th colspan="10" class="text-center">Electrical Data at STC</th>
                                            <th rowspan="2"></th>
                                        </tr>
                                        <tr>
                                            <th width="10%">Applicable models covered under +- 5% of
                                                Mean Wattege</th>
                                            <th>Pmax (Wp) of Applicable Models Model</th>
                                            <th>Pmax (Wp)</th>
                                            <th>Vmp (V)</th>
                                            <th>Imp (A)</th>
                                            <th>Voc (V)</th>
                                            <th>Isc (A)</th>
                                            <th>Module Efficiency (%)</th>
                                            <th>Fill Factor</th>
                                        </tr>
                                        <?php $i=0; ?>
                                        <?php $__currentLoopData = $appData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                        <?php if($data->electrical_data_type ==1): ?>
                                        <?php $i++; ?>
                                        <tr class="text-center">
                                            <td><?php echo e($i); ?></td>
                                            <td><?php echo e($data->module_type); ?></td>
                                            <td><?php echo e($data->model_code); ?></td>
                                            <td><?php echo e($data->pmax_model); ?></td>
                                            <td>
                                                <table width="100%">
                                                    <?php $__currentLoopData = json_decode($data->applicable_mean_wattage); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $applicable_mean_wattage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            <?php echo e($applicable_mean_wattage); ?></td>
                                                    </tr>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </table>
                                            </td>
                                            <td>
                                                <table width="100%">
                                                    <?php $__currentLoopData = json_decode($data->pmax_applicable_model); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pmax_applicable_model): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            <?php echo e($pmax_applicable_model); ?></td>
                                                    </tr>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </table>
                                            </td>
                                            <td>
                                                <table width="100%">
                                                    <?php $__currentLoopData = json_decode($data->pmax_watt); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pmax_watt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            <?php echo e($pmax_watt); ?></td>
                                                    </tr>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </table>
                                            </td>
                                            <td>
                                                <table width="100%">
                                                    <?php $__currentLoopData = json_decode($data->vmp); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vmp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            <?php echo e($vmp); ?></td>
                                                    </tr>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </table>
                                            </td>

                                            <td>
                                                <table width="100%">
                                                    <?php $__currentLoopData = json_decode($data->imp); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $imp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            <?php echo e($imp); ?></td>
                                                    </tr>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </table>
                                            </td>
                                            <td>
                                                <table width="100%">
                                                    <?php $__currentLoopData = json_decode($data->voc); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $voc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            <?php echo e($voc); ?></td>
                                                    </tr>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </table>
                                            </td>
                                            <td>
                                                <table width="100%">
                                                    <?php $__currentLoopData = json_decode($data->isc); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $isc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            <?php echo e($isc); ?></td>
                                                    </tr>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </table>
                                            </td>
                                            <td>
                                                <table width="100%">
                                                    <?php $__currentLoopData = json_decode($data->model_efficiency); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $model_efficiency): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            <?php echo e($model_efficiency); ?></td>
                                                    </tr>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </table>
                                            </td>
                                            <td>
                                                <table width="100%">
                                                    <?php $__currentLoopData = json_decode($data->fill_factor); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fill_factor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            <?php echo e($fill_factor); ?></td>
                                                    </tr>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </table>
                                            </td>
                                            <td>
                                                <a
                                                    href="<?php echo e(URL::to('users/annexure-one-b/'.$data->application_id.'/'.$data->id)); ?>">Edit
                                                    <i class="fa fa-edit"></i></a>
                                                <a href="<?php echo e(URL::to('users/delete-annexure/1/'.$data->id)); ?>"
                                                    onCLick="if (confirm('Are you sure to delete?')) { }else{ return false;}"
                                                    class="text-danger">Delete <i class="fa fa-trash"></i></a>
                                            </td>

                                        </tr>
                                        <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    </tbody>
                                </table>

                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>3.2.1</th>
                                            <th scope="col" colspan="13">Electrical Data (NOCT) of Solar PV Modules</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th rowspan="2">Sr.No</th>
                                            <th rowspan="2">Type Of Modules</th>
                                            <th rowspan="2">Main Model</th>

                                            <th rowspan="2" width="10%">Pmax (Wp) of Main Model</th>
                                            <th colspan="10" class="text-center">Electrical Data at NOCT</th>
                                            <th rowspan="2"></th>
                                        </tr>
                                        <tr>
                                            <th width="10%">Applicable models covered under +- 5% of
                                                Mean Wattege</th>
                                            <th>Pmax (Wp) of Applicable Models Model</th>
                                            <th>Pmax (Wp)</th>
                                            <th>Vmp (V)</th>
                                            <th>Imp (A)</th>
                                            <th>Voc (V)</th>
                                            <th>Isc (A)</th>
                                            <th>Module Efficiency (%)</th>
                                            <th>Fill Factor</th>
                                        </tr>
                                        <?php $j=0; ?>
                                        <?php $__currentLoopData = $appData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($data->electrical_data_type ==2): ?>
                                        <?php $j++; ?>
                                        <tr class="text-center">
                                            <td><?php echo e($j); ?></td>
                                            <td><?php echo e($data->module_type); ?></td>
                                            <td><?php echo e($data->model_code); ?></td>
                                            <td><?php echo e($data->pmax_model); ?></td>
                                            <td>
                                                <table width="100%">
                                                    <?php $__currentLoopData = json_decode($data->applicable_mean_wattage); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $applicable_mean_wattage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            <?php echo e($applicable_mean_wattage); ?></td>
                                                    </tr>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </table>
                                            </td>
                                            <td>
                                                <table width="100%">
                                                    <?php $__currentLoopData = json_decode($data->pmax_applicable_model); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pmax_applicable_model): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            <?php echo e($pmax_applicable_model); ?></td>
                                                    </tr>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </table>
                                            </td>
                                            <td>
                                                <table width="100%">
                                                    <?php $__currentLoopData = json_decode($data->pmax_watt); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pmax_watt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            <?php echo e($pmax_watt); ?></td>
                                                    </tr>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </table>
                                            </td>
                                            <td>
                                                <table width="100%">
                                                    <?php $__currentLoopData = json_decode($data->vmp); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vmp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            <?php echo e($vmp); ?></td>
                                                    </tr>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </table>
                                            </td>

                                            <td>
                                                <table width="100%">
                                                    <?php $__currentLoopData = json_decode($data->imp); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $imp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            <?php echo e($imp); ?></td>
                                                    </tr>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </table>
                                            </td>
                                            <td>
                                                <table width="100%">
                                                    <?php $__currentLoopData = json_decode($data->voc); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $voc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            <?php echo e($voc); ?></td>
                                                    </tr>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </table>
                                            </td>
                                            <td>
                                                <table width="100%">
                                                    <?php $__currentLoopData = json_decode($data->isc); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $isc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            <?php echo e($isc); ?></td>
                                                    </tr>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </table>
                                            </td>
                                            <td>
                                                <table width="100%">
                                                    <?php $__currentLoopData = json_decode($data->model_efficiency); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $model_efficiency): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            <?php echo e($model_efficiency); ?></td>
                                                    </tr>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </table>
                                            </td>
                                            <td>
                                                <table width="100%">
                                                    <?php $__currentLoopData = json_decode($data->fill_factor); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fill_factor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            <?php echo e($fill_factor); ?></td>
                                                    </tr>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </table>
                                            </td>
                                            <td>
                                                <a
                                                    href="<?php echo e(URL::to('users/annexure-one-b/'.$data->application_id.'/'.$data->id)); ?>">Edit
                                                    <i class="fa fa-edit"></i></a>
                                                <a href="<?php echo e(URL::to('users/delete-annexure/1/'.$data->id)); ?>"
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

                                            <a href="<?php echo e(URL::to('users/annexure-one-c/'.$application_id)); ?>"
                                                class="btn btn-warning" style="float:right;">Next <i
                                                    class="fa fa-arrow-right"></i></a>
                                            <?php endif; ?>
                                            <a href="<?php echo e(URL::to('users/annexure-one/'.$application_id)); ?>"
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
                '</td><td> <input type="number" min="0" name="applicable_mean_wattage[]" id="applicable_mean_wattage_' +
                counter +
                '" placeholder="Enter Applicable Mean Wattage" value="0" step="any" required> </td> <td> <input type="number" min="0" name="pmax_applicable_model[]"  id="pmax_applicable_model_' +
                counter +
                '" placeholder="Enter MeanWattage" step="any" value="0" required></td><td> <input type="number" min="0" name="pmax_watt[]" id="pmax_watt_' +
                counter +
                '" placeholder="Enter Pmax (Wp) " value="0" required></td><td><input type="number" min="0" step="any" name="vmp[]" id="vmp_' +
                counter +
                '" placeholder="Enter VMP (V) " value="0" step="any" required class="form-control vmp_' +
                counter +
                '"></td><td><input  type="number" min="0" step="any" name="imp[]" value="0" id="imp_' +
                counter +
                '" placeholder="Enter Imp (A)" value="0" class="form-control" required></td><td><input  type="number" min="0" step="any" name="voc[]" id="voc_' +
                counter +
                '" placeholder="Enter Voc (V)"  value="0"class="form-control" required></td><td><input type="number" min="0" step="any" name="isc[]" id="isc_' +
                counter +
                '" placeholder="Enter Isc (A)" value="0" class="form-control" required></td><td><input  type="number" min="0" step="any" name="model_efficiency[]"  value="0"  id="model_efficiency_' +
                counter +
                '" placeholder="Enter Module Efficiency (%)"  value="0" class="form-control" required></td><td><input type="text" value="0"  name="fill_factor[]" id="fill_factor_' +
                counter +
                '" placeholder="Enter Fill Factor" class="form-control" required></td><td><a href="javascript:;" class="remove_fields">Delete <i class="fa fa-trash text-danger"></i></a></td></tr>';
            tableBody = $("#add-data");
            tableBody.append(markup);
        });
    });
    </script>
    <?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.masters.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\almm\resources\views/backend/user/form/annexureOne/annexure1_2.blade.php ENDPATH**/ ?>