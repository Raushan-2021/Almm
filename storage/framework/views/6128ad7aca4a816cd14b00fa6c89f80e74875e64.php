
<?php $__env->startSection('title', 'Annexure 5 ::Module Production, Sale and Purchase Data'); ?>
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
                            <form action="<?php echo e(URL::to('/users/annexure-five')); ?>" method="POST"
                                enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('POST'); ?>
                                <table class="table table-bordered" id="show_data"
                                    style="display: <?php if($annexuredata!=null): ?>  <?php else: ?> none <?php endif; ?>">
                                    <?php if($annexuredata!=null): ?>
                                    <input type="hidden" name="id" value="<?php echo e($annexuredata->id); ?>">
                                    <?php endif; ?>
                                    <tr>
                                        <th>
                                            <div class="row">
                                                <div class="col-md-12">

                                                    <p>PV Module Production Data in MW </p>
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="">Month</label>
                                                    <select name="month" id="month" class="form-control" required>
                                                        <option value=''>--Select Month--</option>
                                                        <option value='Janaury' <?php if(isset($annexuredata->month) &&
                                                            $annexuredata->month=='Janaury'): ?> selected <?php endif; ?> >Janaury
                                                        </option>
                                                        <option value='February' <?php if(isset($annexuredata->month) &&
                                                            $annexuredata->month=='February'): ?> selected <?php endif; ?>>February
                                                        </option>
                                                        <option value='March' <?php if(isset($annexuredata->month) &&
                                                            $annexuredata->month=='March'): ?> selected <?php endif; ?>> March
                                                        </option>
                                                        <option value='April' <?php if(isset($annexuredata->month) &&
                                                            $annexuredata->month=='April'): ?> selected <?php endif; ?> >April
                                                        </option>
                                                        <option value='May' <?php if(isset($annexuredata->month) &&
                                                            $annexuredata->month=='May'): ?> selected <?php endif; ?> >May</option>
                                                        <option value='June' <?php if(isset($annexuredata->month) &&
                                                            $annexuredata->month=='June'): ?> selected <?php endif; ?> >June</option>
                                                        <option value='July' <?php if(isset($annexuredata->month) &&
                                                            $annexuredata->month=='July'): ?> selected <?php endif; ?> >July</option>
                                                        <option value='August' <?php if(isset($annexuredata->month) &&
                                                            $annexuredata->month=='August'): ?> selected <?php endif; ?> >August
                                                        </option>
                                                        <option value='September' <?php if(isset($annexuredata->month) &&
                                                            $annexuredata->month=='September'): ?> selected <?php endif; ?>
                                                            >September</option>
                                                        <option value='October' <?php if(isset($annexuredata->month) &&
                                                            $annexuredata->month=='October'): ?> selected <?php endif; ?> >October
                                                        </option>
                                                        <option value='November' <?php if(isset($annexuredata->month) &&
                                                            $annexuredata->month=='November'): ?> selected <?php endif; ?> >November
                                                        </option>
                                                        <option value='December' <?php if(isset($annexuredata->month) &&
                                                            $annexuredata->month=='December'): ?> selected <?php endif; ?> >December
                                                        </option>

                                                    </select>
                                                </div>

                                                <div class="col-md-4">
                                                    <label for="">Financial Year</label>
                                                    <select name="financial_year" id="financial_year"
                                                        class="form-control" required>
                                                        <option value="">--Select Financial Year--</option>
                                                        <?php
                                                        $startYear = date("Y")+2;
                                                        $prevYear = date("Y")+1;
                                                        for ($i = 0; $i < 3; $i++) { $startYear=$startYear - 1;
                                                            $prevYear=$prevYear - 1;
                                                            $financial_year=$prevYear."-".$startYear; ?> <option
                                                            value="<?php echo e($prevYear); ?>-<?php echo e($startYear); ?>"
                                                            <?php if(isset($annexuredata->financial_year) &&
                                                            $annexuredata->financial_year==$financial_year): ?> selected
                                                            <?php endif; ?>><?php echo e($financial_year); ?></option>
                                                            <?php
                                                            }
                                                            ?>
                                                    </select>
                                                </div>

                                                <div class="col-md-4">
                                                    <label for="">Actual PV Module Production Data</label>
                                                    <input type="text" name="module_production_data"
                                                        placeholder="Actual PV Module Production Data"
                                                        id="module_production_data" class="form-control" maxlength="70"
                                                        value="<?php echo e($annexuredata->module_production_data ?? ''); ?>">

                                                </div>

                                                <div class="col-md-12">
                                                    <p>PV Module Sales Data for last 3 financial year</p>
                                                    <br>
                                                </div>


                                                <div class="col-md-4">
                                                    <label for="">Total Module Sales (in MW)</label>
                                                    <input type="text" name="module_sale"
                                                        placeholder="Total Module Sales (in MW)" id="module_sale"
                                                        class="form-control" maxlength="70"
                                                        value="<?php echo e($annexuredata->module_sale ?? ''); ?>">
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="">Module Sales Amount (in Rs)</label>
                                                    <input type="text" name="module_sale_amount"
                                                        placeholder="Module Sales Amount (in Rs)"
                                                        id="module_sale_amount" class="form-control"
                                                        value="<?php echo e($annexuredata->module_sale_amount ?? ''); ?>">
                                                </div>



                                                <div class="col-md-4">
                                                    <label for="">EPC and Other Sales Amount (in Rs)</label>
                                                    <input type="text" name="epc_other_amount"
                                                        placeholder="EPC and Other Sales Amount (in Rs)"
                                                        id="epc_other_amount" class="form-control"
                                                        value="<?php echo e($annexuredata->epc_other_amount ?? ''); ?>">
                                                </div>

                                                <div class="col-md-4">
                                                    <label for="">Total Sales Amount (Rs)</label>
                                                    <input type="text" name="total_sales"
                                                        placeholder="Total Sales Amount (Rs)" id="total_sales"
                                                        class="form-control" maxlength="70"
                                                        value="<?php echo e($annexuredata->total_sales ?? ''); ?>">
                                                </div>



                                                <div class="col-md-12">
                                                    <p>Raw Material Purchase Data </p>
                                                    <br>
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="">Raw Material Purchase for Module Amount (Rs)</label>
                                                    <input type="text" name="raw_purchase_module"
                                                        placeholder="Raw Material Purchase for Module Amount (Rs)"
                                                        id="raw_purchase_module" class="form-control" maxlength="70"
                                                        value="<?php echo e($annexuredata->raw_purchase_module ?? ''); ?>">
                                                </div>

                                                <div class="col-md-4">
                                                    <label for="">Other Raw Material Purchase Amount (Rs)</label>
                                                    <input type="text" name="other_raw_purchase"
                                                        placeholder="Other Raw Material Purchase Amount (Rs)"
                                                        id="other_raw_purchase" class="form-control" maxlength="70"
                                                        value="<?php echo e($annexuredata->other_raw_purchase ?? ''); ?>">
                                                </div>

                                                <div class="col-md-4">
                                                    <label for="">Total Purchase Amount (Rs)</label>
                                                    <input type="text" name="total_purchase"
                                                        placeholder="Total Purchase Amount (Rs)" id="total_purchase"
                                                        class="form-control" maxlength="70"
                                                        value="<?php echo e($annexuredata->total_purchase ?? ''); ?>">
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
                                            <!-- <a href="<?php echo e(URL::to('users/annexure-two/'.$application_id)); ?>"
                                                class="btn btn-danger"> Cancel </a> -->

                                        </td>
                                    </tr>
                                </table>


                            </form>
                            <h4>PV Module Production Data in MW for last 3 financial year</h4>
                            <table class="table table-bordered">

                                <?php
                                $startYear = date("Y")+1;
                                $prevYear = date("Y");
                                $current_financial_year = $prevYear."-".$startYear;

                                $startYear1 = date("Y");
                                $prevYear1 = date("Y")-1;
                                $last_financial_year = $prevYear1."-".$startYear1;

                                $startYear2 = date("Y")-1;
                                $prevYear2 = date("Y")-2;
                                $lasttolast_financial_year = $prevYear2."-".$startYear2;
                                ?>
                                Current Financial Year (<?php echo e($prevYear); ?> - <?php echo e($startYear); ?>)
                                <thead>
                                    <tr class="bg-warning">
                                        <th>S.No</th>
                                        <th>Month</th>
                                        <th>Current Financial Year <?php echo e($current_financial_year); ?></th>
                                        <th>Last Financial Year <?php echo e($last_financial_year); ?></th>
                                        <th>Last to Last Financial Year <?php echo e($lasttolast_financial_year); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $months = array(1 => 'April', 2 => 'May', 3 => 'June', 4 => 'July', 5 =>
                                    'August', 6 => 'September', 7 => 'October', 8 => 'November', 9 => 'December', 10 =>
                                    'January', 11 => 'February', 12 => 'March');
                                    ?>
                                    <?php $__currentLoopData = $months; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $num => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($loop->iteration); ?></td>
                                        <td><?php echo e($name); ?></td>
                                        <td><?php echo e(\App\Models\Annexure5::getFinancialData($application_id,$name,$current_financial_year)); ?>

                                        </td>
                                        <td><?php echo e(\App\Models\Annexure5::getFinancialData($application_id,$name,$last_financial_year)); ?>

                                        </td>
                                        <td><?php echo e(\App\Models\Annexure5::getFinancialData($application_id,$name,$lasttolast_financial_year)); ?>

                                        </td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>

                            <br><br>
                            <h4>PV Module Sales Data for last 3 financial year</h4>
                            <table class="table table-bordered">

                                <?php
                                $startYear = date("Y")+1;
                                $prevYear = date("Y");
                                $current_financial_year = $prevYear."-".$startYear;
                                ?>
                                Current Financial Year (<?php echo e($prevYear); ?> - <?php echo e($startYear); ?>)
                                <thead>
                                    <tr class="bg-warning">
                                        <th>S.No</th>
                                        <th>Month</th>
                                        <th>Total Module Sales (in MW)</th>
                                        <th>Module Sales Amount (in Rs)</th>
                                        <th>EPC and Other Sales Amount (in Rs)</th>
                                        <th>Total Sales Amount (Rs)</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $total_module_sale_mv_1=0;
                                        $total_module_sale_amt_1=0;
                                        $total_other_sale_amt_1=0;
                                        $total_sale_amt_1=0;
                                    ?>
                                    <?php $__currentLoopData = $appData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php 
                                        $total_module_sale_mv_1+=$data->module_sale;
                                        $total_module_sale_amt_1+=$data->module_sale_amount;
                                        $total_other_sale_amt_1+=$data->epc_other_amount;
                                        $total_sale_amt_1+=$data->total_sales;
                                    ?>
                                    <tr>
                                        <td><?php echo e($loop->iteration); ?></td>
                                        <td><?php echo e($data->month); ?></td>
                                        <td><?php echo e($data->module_sale); ?></td>
                                        <td><?php echo e($data->module_sale_amount); ?></td>
                                        <td><?php echo e($data->epc_other_amount); ?></td>
                                        <td><?php echo e($data->total_sales); ?></td>
                                        <td>
                                            <a
                                                href="<?php echo e(URL::to('users/annexure-five/'.$data->application_id.'/'.$data->id)); ?>">Edit
                                                <i class="fa fa-edit"></i></a>
                                            <a href="<?php echo e(URL::to('users/annexure-five-delete/1/'.$data->id)); ?>"
                                                onCLick="if (confirm('Are you sure to delete?')) { }else{ return false;}"
                                                class="text-danger">Delete <i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="bg-gray">
                                        <th>Total :</th>
                                        <th>--</th>
                                        <th><?php echo e($total_module_sale_mv_1); ?> MV</th>
                                        <th ><?php echo e($total_module_sale_amt_1); ?> INR</th>
                                        <th><?php echo e($total_other_sale_amt_1); ?> INR</th>
                                        <th ><?php echo e($total_sale_amt_1); ?> INR</th>
                                        <th>--</th>
                                    </tr>
                                </tbody>
                            </table>

                            <br><br>
                            <table class="table table-bordered">
                                <?php
                                $startYear = date("Y");
                                $prevYear = date("Y")-1;
                                $last_financial_year = $prevYear."-".$startYear;
                                ?>
                                Last Financial Year (<?php echo e($prevYear); ?> - <?php echo e($startYear); ?>)
                                <thead>
                                    <tr class="bg-warning">
                                        <th>S.No</th>
                                        <th>Month</th>
                                        <th>Total Module Sales (in MW)</th>
                                        <th>Module Sales Amount (in Rs)</th>
                                        <th>EPC and Other Sales Amount (in Rs)</th>
                                        <th>Total Sales Amount (Rs)</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $total_module_sale_mv_2=0;
                                        $total_module_sale_amt_2=0;
                                        $total_other_sale_amt_2=0;
                                        $total_sale_amt_2=0;
                                    ?>
                                    <?php $__currentLoopData = $lfyappData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php 
                                        $total_module_sale_mv_2+=$data->module_sale;
                                        $total_module_sale_amt_2+=$data->module_sale_amount;
                                        $total_other_sale_amt_2+=$data->epc_other_amount;
                                        $total_sale_amt_2+=$data->total_sales;
                                    ?>
                                    <tr>
                                        <td><?php echo e($loop->iteration); ?></td>
                                        <td><?php echo e($data->month); ?></td>
                                        <td><?php echo e($data->module_sale); ?></td>
                                        <td><?php echo e($data->module_sale_amount); ?></td>
                                        <td><?php echo e($data->epc_other_amount); ?></td>
                                        <td><?php echo e($data->total_sales); ?></td>
                                        <td>
                                            <a
                                                href="<?php echo e(URL::to('users/annexure-five/'.$data->application_id.'/'.$data->id)); ?>">Edit
                                                <i class="fa fa-edit"></i></a>
                                            <a href="<?php echo e(URL::to('users/annexure-five-delete/1/'.$data->id)); ?>"
                                                onCLick="if (confirm('Are you sure to delete?')) { }else{ return false;}"
                                                class="text-danger">Delete <i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="bg-gray">
                                        <th>Total :</th>
                                        <th>--</th>
                                        <th><?php echo e($total_module_sale_mv_2); ?> MV</th>
                                        <th ><?php echo e($total_module_sale_amt_2); ?> INR</th>
                                        <th><?php echo e($total_other_sale_amt_2); ?> INR</th>
                                        <th ><?php echo e($total_sale_amt_2); ?> INR</th>
                                        <th>--</th>
                                    </tr>
                                </tbody>
                            </table>

                            <br><br>
                            <table class="table table-bordered">
                                <?php
                                $startYear = date("Y")-1;
                                $prevYear = date("Y")-2;
                                $lasttolast_financial_year = $prevYear."-".$startYear;
                                ?>
                                Last To Last Financial Year (<?php echo e($prevYear); ?> - <?php echo e($startYear); ?>)
                                <thead>
                                    <tr class="bg-warning">
                                        <th>S.No</th>
                                        <th>Month</th>
                                        <th>Total Module Sales (in MW)</th>
                                        <th>Module Sales Amount (in Rs)</th>
                                        <th>EPC and Other Sales Amount (in Rs)</th>
                                        <th>Total Sales Amount (Rs)</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $total_module_sale_mv_3=0;
                                        $total_module_sale_amt_3=0;
                                        $total_other_sale_amt_3=0;
                                        $total_sale_amt_3=0;
                                    ?>
                                    <?php $__currentLoopData = $ltlfyappData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php 
                                        $total_module_sale_mv_3+=$data->module_sale;
                                        $total_module_sale_amt_3+=$data->module_sale_amount;
                                        $total_other_sale_amt_3+=$data->epc_other_amount;
                                        $total_sale_amt_3+=$data->total_sales;
                                    ?>
                                    <tr>
                                        <td><?php echo e($loop->iteration); ?></td>
                                        <td><?php echo e($data->month); ?></td>
                                        <td><?php echo e($data->module_sale); ?></td>
                                        <td><?php echo e($data->module_sale_amount); ?></td>
                                        <td><?php echo e($data->epc_other_amount); ?></td>
                                        <td><?php echo e($data->total_sales); ?></td>
                                        <td>
                                            <a
                                                href="<?php echo e(URL::to('users/annexure-five/'.$data->application_id.'/'.$data->id)); ?>">Edit
                                                <i class="fa fa-edit"></i></a>
                                            <a href="<?php echo e(URL::to('users/annexure-five-delete/1/'.$data->id)); ?>"
                                                onCLick="if (confirm('Are you sure to delete?')) { }else{ return false;}"
                                                class="text-danger">Delete <i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="bg-gray">
                                        <th>Total :</th>
                                        <th>--</th>
                                        <th><?php echo e($total_module_sale_mv_3); ?> MV</th>
                                        <th ><?php echo e($total_module_sale_amt_3); ?> INR</th>
                                        <th><?php echo e($total_other_sale_amt_3); ?> INR</th>
                                        <th ><?php echo e($total_sale_amt_3); ?> INR</th>
                                        <th>--</th>
                                    </tr>
                                </tbody>
                            </table>
                            <hr>
                            <br>
                            <h4>Raw Material Purchase Data for last 3 financial year</h4>

                            <table class="table table-bordered">

                                <?php
                                $startYear = date("Y")+1;
                                $prevYear = date("Y");
                                $current_financial_year = $prevYear."-".$startYear;
                                ?>
                                Current Financial Year (<?php echo e($prevYear); ?> - <?php echo e($startYear); ?>)
                                <thead>
                                    <tr class="bg-warning">
                                        <th>S.No</th>
                                        <th>Month</th>
                                        <th>Raw Material Purchase for Module Amount (Rs)</th>
                                        <th>Other Raw Material Purchase Amount (Rs)</th>
                                        <th>Total Purchase Amount (Rs)</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $total_raw_module_purchase_mv_1=0;
                                        $total_other_purchase_amt_1=0;
                                        $total_purchase_amt_1=0;
                                    ?>
                                    <?php $__currentLoopData = $appData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php 
                                        $total_raw_module_purchase_mv_1+=$data->raw_purchase_module;
                                        $total_other_purchase_amt_1+=$data->other_raw_purchase;
                                        $total_purchase_amt_1+=$data->total_purchase;
                                    ?>
                                    <tr>
                                        <td><?php echo e($loop->iteration); ?></td>
                                        <td><?php echo e($data->month); ?></td>
                                        <td><?php echo e($data->raw_purchase_module); ?></td>
                                        <td><?php echo e($data->other_raw_purchase); ?></td>
                                        <td><?php echo e($data->total_purchase); ?></td>
                                        <td>
                                            <a
                                                href="<?php echo e(URL::to('users/annexure-five/'.$data->application_id.'/'.$data->id)); ?>">Edit
                                                <i class="fa fa-edit"></i></a>
                                            <a href="<?php echo e(URL::to('users/annexure-five-delete/1/'.$data->id)); ?>"
                                                onCLick="if (confirm('Are you sure to delete?')) { }else{ return false;}"
                                                class="text-danger">Delete <i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="bg-gray">
                                        <th>Total :</th>
                                        <th>--</th>
                                        <th><?php echo e($total_raw_module_purchase_mv_1); ?> MV</th>
                                        <th ><?php echo e($total_other_purchase_amt_1); ?> INR</th>
                                        <th><?php echo e($total_purchase_amt_1); ?> INR</th>
                                        <th>--</th>
                                    </tr>
                                </tbody>
                            </table>
                            <br><br>
                            <table class="table table-bordered">

                                <?php
                                $startYear = date("Y");
                                $prevYear = date("Y")-1;
                                $last_financial_year = $prevYear."-".$startYear;
                                ?>
                                Last Financial Year (<?php echo e($prevYear); ?> - <?php echo e($startYear); ?>)
                                <thead>
                                    <tr class="bg-warning">
                                        <th>S.No</th>
                                        <th>Month</th>
                                        <th>Raw Material Purchase for Module Amount (Rs)</th>
                                        <th>Other Raw Material Purchase Amount (Rs)</th>
                                        <th>Total Purchase Amount (Rs)</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $total_raw_module_purchase_mv_2=0;
                                        $total_other_purchase_amt_2=0;
                                        $total_purchase_amt_2=0;
                                    ?>
                                    <?php $__currentLoopData = $lfyappData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php 
                                        $total_raw_module_purchase_mv_2+=$data->raw_purchase_module;
                                        $total_other_purchase_amt_2+=$data->other_raw_purchase;
                                        $total_purchase_amt_2+=$data->total_purchase;
                                    ?>
                                    <tr>
                                        <td><?php echo e($loop->iteration); ?></td>
                                        <td><?php echo e($data->month); ?></td>
                                        <td><?php echo e($data->raw_purchase_module); ?></td>
                                        <td><?php echo e($data->other_raw_purchase); ?></td>
                                        <td><?php echo e($data->total_purchase); ?></td>
                                        <td>
                                            <a
                                                href="<?php echo e(URL::to('users/annexure-five/'.$data->application_id.'/'.$data->id)); ?>">Edit
                                                <i class="fa fa-edit"></i></a>
                                            <a href="<?php echo e(URL::to('users/annexure-five-delete/1/'.$data->id)); ?>"
                                                onCLick="if (confirm('Are you sure to delete?')) { }else{ return false;}"
                                                class="text-danger">Delete <i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="bg-gray">
                                        <th>Total :</th>
                                        <th>--</th>
                                        <th><?php echo e($total_raw_module_purchase_mv_2); ?> MV</th>
                                        <th ><?php echo e($total_other_purchase_amt_2); ?> INR</th>
                                        <th><?php echo e($total_purchase_amt_2); ?> INR</th>
                                        <th>--</th>
                                    </tr>
                                </tbody>
                            </table>


                            <br><br>
                            <table class="table table-bordered">

                                <?php
                                $startYear = date("Y")-1;
                                $prevYear = date("Y")-2;
                                $lasttolast_financial_year = $prevYear."-".$startYear;
                                ?>
                                Last To Last Financial Year (<?php echo e($prevYear); ?> - <?php echo e($startYear); ?>)
                                <thead>
                                    <tr class="bg-warning">
                                        <th>S.No</th>
                                        <th>Month</th>
                                        <th>Raw Material Purchase for Module Amount (Rs)</th>
                                        <th>Other Raw Material Purchase Amount (Rs)</th>
                                        <th>Total Purchase Amount (Rs)</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $total_raw_module_purchase_mv_3=0;
                                        $total_other_purchase_amt_3=0;
                                        $total_purchase_amt_3=0;
                                    ?>
                                    <?php $__currentLoopData = $ltlfyappData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php 
                                        $total_raw_module_purchase_mv_3+=$data->raw_purchase_module;
                                        $total_other_purchase_amt_3+=$data->other_raw_purchase;
                                        $total_purchase_amt_3+=$data->total_purchase;
                                    ?>
                                    <tr>
                                        <td><?php echo e($loop->iteration); ?></td>
                                        <td><?php echo e($data->month); ?></td>
                                        <td><?php echo e($data->raw_purchase_module); ?></td>
                                        <td><?php echo e($data->other_raw_purchase); ?></td>
                                        <td><?php echo e($data->total_purchase); ?></td>
                                        <td>
                                            <a
                                                href="<?php echo e(URL::to('users/annexure-five/'.$data->application_id.'/'.$data->id)); ?>">Edit
                                                <i class="fa fa-edit"></i></a>
                                            <a href="<?php echo e(URL::to('users/annexure-five-delete/1/'.$data->id)); ?>"
                                                onCLick="if (confirm('Are you sure to delete?')) { }else{ return false;}"
                                                class="text-danger">Delete <i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="bg-gray">
                                        <th>Total :</th>
                                        <th>--</th>
                                        <th><?php echo e($total_raw_module_purchase_mv_3); ?> MV</th>
                                        <th ><?php echo e($total_other_purchase_amt_3); ?> INR</th>
                                        <th><?php echo e($total_purchase_amt_3); ?> INR</th>
                                        <th>--</th>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="table table-bordered">
                                <tr>
                                    <th colspan="13">
                                        <?php if(isset($ltlfyappData) && $ltlfyappData!=null): ?>

                                        <a href="<?php echo e(URL::to('users/annexure-six/'.$application_id)); ?>"
                                            class="btn btn-warning" style="float:right">Next <i
                                                class="fa fa-arrow-right"></i></a>
                                        <?php endif; ?>
                                        <a href="<?php echo e(URL::to('users/annexure-four-five/'.$application_id)); ?>"
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
                '</td><td><select name="option_type[]" id="option_type' +
                counter +
                '" class="form-control"> <option value="0">Main</option> <option value="1">Alternate 1</option> <option value="2">Alternate 2</option>  </select></td><td><input type="text" name="make_details[]" placeholder="Enter Make Details" id="make_details' +
                counter +
                '" class="form-control" maxlength="70" value=""></td><td><input type="text" name="model_details[]" id="model_details_' +
                counter +
                '" placeholder=" Enter Making Details"  class="form-control" ></td><td><input  type="text" name="specifications[]" id="specifications_' +
                counter +
                '" placeholder="Enter specifiaction Details" value="" class="form-control" ></td><td><input  type="text" name="country_origin[]" id="country_origin_' +
                counter +
                '" placeholder="Enter Country of Origin" value="" class="form-control" ></td><td><a href="javascript:;" class="remove_fields">Delete <i class="fa fa-trash text-danger"></i></a></td></tr>';
            tableBody = $("#add-data-3");
            tableBody.append(markup);
        });

    });
    </script>
    <?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.masters.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\almm\resources\views/backend/user/form/annexureFive/annexureFive.blade.php ENDPATH**/ ?>