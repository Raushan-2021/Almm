
<?php $__env->startSection('content'); ?>
<?php $__env->startSection('title', 'Applications Detail'); ?>
<?php $docBaseUrl ='nise/preview-docs/Annexure/';
$attchmentBaseUrl ='nise/preview-docs/Attachment/';
?>
<div class="box box-primary">
    <div class="box-body">
        <div class="row">
            <div class="col-md-12">
                <a href="<?php echo e(url('/nise/applications-list')); ?>" class="btn btn-warning" style="float:right">Back</a>
                <table class="table table-bordered">
                    <tr>
                        <th colspan="2">
                            <h3>Details of Solar Photovoltaic (PV) Module Manufacturer</h3>
                        </th>
                    </tr>
                    <tr>
                        <th colspan="2">
                            <br>
                        </th>
                    </tr>
                    <tr>
                        <th>Application No</th>
                        <th><?php echo e($applicationDetail['application_no']); ?></th>
                    </tr>
                    <tr>
                        <th width="30%">Type of Application</th>
                        <th>
                            <?php if($applicationDetail['application_type']==1): ?>
                            <i>New Application</i>
                            <?php elseif($applicationDetail['application_type']==2): ?>
                            PV Model Addition at
                            the existing manufacturing facility>
                            <?php elseif($applicationDetail['application_type']==3): ?>
                            Application for new
                            manufacturing facility
                            <?php elseif($applicationDetail['application_type']==4): ?>
                            Renewal
                            <?php elseif($applicationDetail['application_type']==5): ?>
                            Co-ALMM
                            <?php endif; ?>
                        </th>
                    </tr>
                    <tr>
                        <td width="30%"> <strong>Name of Manufacturer</strong> <br>
                            <small> <i>(Attach a copy of certificate of Incorporation issued by Registrar of
                                    Companies and Mark it as attachment 1)</i> </small>
                        </td>
                        <th>
                            <div class="row">
                                <div class="col-md-6">
                                    <?php echo e($applicationDetail['manufacturer_name']); ?>

                                </div>
                                <!-- <div class="col-md-6">
                                                <div class="col-md-3">
                                                    <label for="">Upload Logo</label>

                                                </div>
                                                <div class="col-md-9">
                                                    <input class="form-control" type="file" id="formFile">
                                                    <input type="file" name="" id="" class="form-control">
                                                </div>
                                            </div> -->


                            </div>
                        </th>
                    </tr>
                    <tr>
                        <td width="30%"> <strong>Manufacturer Brand Name & Logo</strong> <br>
                            <small> <i>(In case of Co-ALMM, don’t fill this)</i> </small>
                        </td>
                        <th>
                            <div class="row">
                                <div class="col-md-4">
                                    <?php echo e($applicationDetail['manufacturer_brand_name']); ?>


                                </div>
                                <!-- <div class="col-md-6">
                                                <div class="col-md-3">
                                                    <label for="">Upload Logo</label>

                                                </div>
                                                   </div> -->
                                <div class="col-md-8">
                                    <img src="<?php echo e(url('storage/systems/Logo/'.$applicationDetail['manufacturer_brand_logo'])); ?>"
                                        width="100">
                                </div>

                            </div>
                        </th>
                    </tr>
                    <tr>
                        <td width="30%"> <strong>Registered Office Address of the
                                Manufacturer
                            </strong> <br>

                        </td>
                        <th>
                            <label for="">Address:</label>
                            <?php echo e($applicationDetail['register_office_address']); ?>

                            <div class="row">
                                <div class="col-md-6">
                                    <label for="phone">Phone:</label>
                                    <?php echo e($applicationDetail['register_office_phone']); ?>

                                </div>

                                <div class="col-md-6">
                                    <label for="email">Email:</label>
                                    <?php echo e($applicationDetail['register_office_email']); ?>

                                </div>
                            </div>

                        </th>
                    </tr>

                    <tr>
                        <td width="30%"> <strong>Communication Address of the
                                Manufacturer</strong> <br>

                        </td>
                        <th>
                            <label for="">Address:</label>
                            <?php echo e($applicationDetail['com_address']); ?>

                            <div class="row">
                                <div class="col-md-6">
                                    <label for="phone">Phone:</label>
                                    <?php echo e($applicationDetail['com_phone']); ?>

                                </div>
                                <div class="col-md-6">
                                    <label for="email">Email:</label>
                                    <?php echo e($applicationDetail['com_email']); ?>

                                </div>
                            </div>



                        </th>
                    </tr>
                    <tr>
                        <td width="30%"> <strong>Location/Address of Manufacturing Plant including
                                Latitude/Longitude for the current application</strong> <br>
                        </td>
                        <th>
                            <?php echo e($applicationDetail['plant_address']); ?>

                            <div class="row">
                                <div class="col-md-6">
                                    <label for="phone">Phone:</label>
                                    <?php echo e($applicationDetail['plant_phone']); ?>

                                </div>
                                <div class="col-md-6"><label for="email">Email:</label>
                                    <?php echo e($applicationDetail['plant_email']); ?>

                                </div>
                                <div class="col-md-6">
                                    <label for="">Latitude:</label>
                                    <?php echo e($applicationDetail['plant_latitude']); ?>

                                </div>
                                <div class="col-md-6">
                                    <label for="Longitude">Longitude:</label>
                                    <?php echo e($applicationDetail['plant_longitude']); ?>

                                </div>
                            </div>

                        </th>
                    </tr>

                    <tr>
                        <td width="30%"> <strong>Details of all Manufacturing Plant
                                under same Brand/Company name
                            </strong> <br>
                            <small> <i>(In case of Co-ALMM, don’t fill this)</i> </small>
                        </td>
                        <td>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="">No. of Manufacturing plant in India:</label>
                                    <?php echo e($applicationDetail['existing_plant_india']); ?>

                                </div>
                                <div class="col-md-6">
                                    <label for="">No. of Manufacturing plant out of India:</label>
                                    <?php echo e($applicationDetail['existing_plant_outindia']); ?>

                                </div>
                            </div>
                            <label for="">Provide details as per annexure 6 </label>
                        </td>

                    </tr>
                    <tr>
                        <td width="30%"> <strong>Contact Person
                            </strong> <br>
                        </td>
                        <td>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="">Name:</label>
                                    <?php echo e($applicationDetail['contact_person_name']); ?>

                                </div>
                                <div class="col-md-6">
                                    <label for="">Designation:</label>
                                    <?php echo e($applicationDetail['person_designation']); ?>

                                </div>

                                <div class="col-md-6">
                                    <label for="">Phone No:</label>
                                    <?php echo e($applicationDetail['person_contact_no']); ?>

                                </div>

                                <div class="col-md-6">
                                    <label for="">E-mail:</label>
                                    <?php echo e($applicationDetail['person_email']); ?>

                                </div>

                            </div>
                        </td>

                    </tr>
                    <tr>
                        <td width="30%"> <strong>Authorized signatory details</strong> <br></td>
                        <td>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="">Name:</label>
                                    <?php echo e($applicationDetail['authorize_name']); ?>

                                </div>

                                <div class="col-md-6">
                                    <label for="">Designation:</label>
                                    <?php echo e($applicationDetail['authorize_designation']); ?>

                                </div>

                            </div>
                        </td>

                    </tr>
                    <tr>
                        <td width="30%"> <strong>No. of Main PV Model Applied</strong> <br>

                            <small> <i>
                                    <label for="phone">Note:</label>
                                    (Attach a copy of certificate of Incorporation issued by Registrar of
                                    Companies and Mark it as attachment 1)</i> </small>
                        </td>
                        <td>
                            <div class="row">
                                <div class="col-md-12">
                                    <label for=""><strong>Total No. of Main PV Models
                                            Applied: </strong></label>
                                </div>
                                <div class="col-md-12">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th>S.No</th>
                                            <th>Technology</th>
                                            <th>No. of Main PV Models Applied</th>
                                            <th>Highest Pmax (in Wp)</th>

                                        </tr>
                                        <?php $__currentLoopData = $applied_pvmodels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $pvmodels): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($key+1); ?></td>
                                            <td><?php echo e($pvmodels->technology); ?></td>
                                            <td><?php echo e($pvmodels->no_pv_models); ?></td>
                                            <td><?php echo e($pvmodels->pmax); ?></td>

                                        </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    </table>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td width="30%"> <strong>Total PV Manufacturing Capacity (in MW/year)</strong>
                            <br><br>
                            <i>Formula for calculating PV model Manufacturing Capacity:</i><br>
                            <br>
                            <small> <i>
                                    <u><span
                                            style="margin-top: 0px; position: absolute; margin-left: -9px;font-size: 18px;">(</span>No.
                                        of Cells Processed in an Hour</u><br>
                                    <span style="margin-left: 15px;">No.of cells in highest Wp PV
                                        model</span> <br>
                                    x Wattage of Highest Wp PV Model x
                                    24 x 350 x 0.9)

                                </i> </small>
                        </td>
                        <th>

                            <div class="row">
                                <div class="col-md-12">
                                    <?php echo e($applicationDetail['manufacturing_capacity']); ?>

                                </div>
                            </div>
                        </th>
                    </tr>
                    <tr>
                        <td width="30%"> <strong>Whether Already Enlisted in ALMM</strong> <br></td>
                        <td>
                            <div class="row">
                                <div class="col-md-6">
                                    <?php if($applicationDetail['enlisted_almm']=='1'): ?>
                                    <label for="">Yes</label>
                                    <?php else: ?>
                                    <label for="">No</label>
                                    <?php endif; ?>
                                </div>
                                <?php if($applicationDetail['enlisted_almm']=='1'): ?>
                                <div class="col-md-6">
                                    <label for="">No. of Main PV Model Enlisted:</label>
                                    <?php echo e($applicationDetail['no_enlisted_pvmodel']); ?>

                                </div>
                                <?php endif; ?>

                                <div class="col-md-6">
                                    <label for="">Total PV Module Manufacturing Capacity (MW/year):</label>
                                    <?php echo e($applicationDetail['total_pv_capacity']); ?>

                                </div>
                                <div class="col-md-12">
                                    <label for="">ALMM Enlistment Validity: </label>
                                </div>
                                <div class="col-md-6">
                                    <label for="">From:</label>
                                    <?php echo e($applicationDetail['validity_from']); ?>

                                </div>

                                <div class="col-md-6">
                                    <label for="">to:</label>
                                    <?php echo e($applicationDetail['validity_to']); ?>

                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td width="30%"> <strong>Details of Payment of Fee</strong>
                            <br><br><br><br><br>
                        </td>
                        <td>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="">Application Fees:</label>
                                    <?php echo e($applicationDetail['application_fees']); ?>

                                </div>
                                <div class="col-md-6">
                                    <label for="">Inspection Fees:</label>
                                    <?php echo e($applicationDetail['inspection_fees']); ?>

                                </div>

                                <div class="col-md-6">
                                    <label for="">Total Amount Paid:</label>
                                    <?php echo e($applicationDetail['total_amount']); ?>

                                </div>


                                <div class="col-md-6">
                                    <label for="">Payment Date:</label>
                                    <?php echo e($applicationDetail['payment_date']); ?>

                                </div>
                                <div style="clear:both"></div>
                                <div class="col-md-6">
                                    <label for="">UTR/reference No:</label>
                                    <?php echo e($applicationDetail['utn_no']); ?>

                                </div>
                                <div class="col-md-6">

                                    <label for="">Mode of Payment:</label>
                                    <?php echo e($applicationDetail['payment_mode']); ?>


                                </div>
                            </div>
                        </td>

                    </tr>

                    <tr>
                        <td> <strong>Proposed Inspection Date</strong></td>
                        <td class="text-primary">
                            <?php if($applicationDetail['inspection_date']!=NULL): ?>
                            <?php echo e(date('d-M-Y', strtotime($applicationDetail['inspection_date']))); ?>

                            <?php else: ?>
                            Not Mentioned
                            <?php endif; ?>
                        </td>
                    </tr>

                </table>

                <!-- Annexure 1 Start-->
                <div class="accordion" id="accordionExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                <h4>Annexure 1</h4>
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body" style="background-color: #d4d4d4;">
                                <!--3.1--->
                                <table class="table table-bordered">

                                    <tbody class="annexure1_div">
                                        <tr class="bg-warning">
                                            <th width="6%">3.1</th>
                                            <th colspan="7">Solar PV Model Details

                                            </th>
                                        </tr>
                                        <tr>
                                            <th scope="row">Sr.No</th>
                                            <th>Type Of Modules</th>
                                            <th>Main Model</th>
                                            <th>Pmax (Wp) of Main Model</th>
                                            <th width="15%">Applicable models covered under +- 5% of
                                                Mean Wattege</th>
                                            <th width="15%">Pmax (Wp) of Applicable Models Model</th>
                                            <th width="15%">No of Cells &amp; Cell Type (Full/Half/Third)</th>
                                            <th>System Voltage (VDC)</th>

                                        </tr>

                                        <?php $__currentLoopData = $annexure1; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
                                                            <?php echo e($pmax_applicable_model); ?></td>
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

                                        </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                                    </tbody>
                                </table>

                                <!--3.2--->

                                <table class="table table-bordered">
                                    <thead>
                                        <tr class="bg-warning">
                                            <th>3.2</th>
                                            <th scope="col" colspan="12">Electrical Data (STC) of Solar PV Modules</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th rowspan="2">Sr.No</th>
                                            <th rowspan="2">Type Of Modules</th>
                                            <th rowspan="2">Main Model</th>

                                            <th rowspan="2" width="10%">Pmax (Wp) of Main Model</th>
                                            <th colspan="10" class="text-center">Electrical Data at STC</th>

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
                                        <?php $__currentLoopData = $annexure1_sub2; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $annexure1_sub2_data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($annexure1_sub2_data->electrical_data_type ==1): ?>
                                        <tr class="text-center">
                                            <td><?php echo e($loop->iteration); ?></td>
                                            <td><?php echo e($annexure1_sub2_data->module_type); ?></td>
                                            <td><?php echo e($annexure1_sub2_data->model_code); ?></td>
                                            <td><?php echo e($annexure1_sub2_data->pmax_model); ?></td>
                                            <td>
                                                <table width="100%">
                                                    <?php $__currentLoopData = json_decode($annexure1_sub2_data->applicable_mean_wattage); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $applicable_mean_wattage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            <?php echo e($applicable_mean_wattage); ?></td>
                                                    </tr>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </table>
                                            </td>
                                            <td>
                                                <table width="100%">
                                                    <?php $__currentLoopData = json_decode($annexure1_sub2_data->pmax_applicable_model); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pmax_applicable_model): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            <?php echo e($pmax_applicable_model); ?></td>
                                                    </tr>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </table>
                                            </td>
                                            <td>
                                                <table width="100%">
                                                    <?php $__currentLoopData = json_decode($annexure1_sub2_data->pmax_watt); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pmax_watt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            <?php echo e($pmax_watt); ?></td>
                                                    </tr>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </table>
                                            </td>
                                            <td>
                                                <table width="100%">
                                                    <?php $__currentLoopData = json_decode($annexure1_sub2_data->vmp); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vmp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            <?php echo e($vmp); ?></td>
                                                    </tr>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </table>
                                            </td>

                                            <td>
                                                <table width="100%">
                                                    <?php $__currentLoopData = json_decode($annexure1_sub2_data->imp); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $imp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            <?php echo e($imp); ?></td>
                                                    </tr>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </table>
                                            </td>
                                            <td>
                                                <table width="100%">
                                                    <?php $__currentLoopData = json_decode($annexure1_sub2_data->voc); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $voc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            <?php echo e($voc); ?></td>
                                                    </tr>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </table>
                                            </td>
                                            <td>
                                                <table width="100%">
                                                    <?php $__currentLoopData = json_decode($annexure1_sub2_data->isc); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $isc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            <?php echo e($isc); ?></td>
                                                    </tr>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </table>
                                            </td>
                                            <td>
                                                <table width="100%">
                                                    <?php $__currentLoopData = json_decode($annexure1_sub2_data->model_efficiency); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $model_efficiency): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            <?php echo e($model_efficiency); ?></td>
                                                    </tr>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </table>
                                            </td>
                                            <td>
                                                <table width="100%">
                                                    <?php $__currentLoopData = json_decode($annexure1_sub2_data->fill_factor); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fill_factor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            <?php echo e($fill_factor); ?></td>
                                                    </tr>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </table>
                                            </td>


                                        </tr>
                                        <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    </tbody>
                                </table>
                                <!--3.2.1--->
                                <table class="table table-bordered">
                                    <thead>
                                        <tr class="bg-warning">
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
                                        <?php $__currentLoopData = $annexure1_sub2; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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

                                        </tr>
                                        <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    </tbody>
                                    
                                </table>
                                <!--3.3--->
                                <table class="table table-bordered">
                                    <thead>
                                        <tr class="bg-warning">
                                            <th>3.3</th>
                                            <th scope="col" colspan="16">Module Operational Ratings</th>
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
                                            <th colspan="7" class="text-center">Operational Ratings</th>

                                        </tr>
                                        <tr>

                                            <th>Operational Temperature (ᴼC)</th>
                                            <th>Maximum System Voltage (V)</th>
                                            <th>Maximum Fuse Rating</th>
                                            <th>By-pass Diode Rating</th>
                                            <th>Fire Rating</th>
                                            <th>Warranty Details</th>
                                        </tr>
                                        <?php $__currentLoopData = $annexure1_sub3; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $annexure1_sub3_data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                        <tr class="text-center">
                                            <td><?php echo e($loop->iteration); ?></td>
                                            <td><?php echo e($annexure1_sub3_data->module_type); ?></td>
                                            <td><?php echo e($annexure1_sub3_data->model_code); ?></td>
                                            <td><?php echo e($annexure1_sub3_data->pmax_model); ?></td>
                                            <td>
                                                <table width="100%">
                                                    <?php $__currentLoopData = json_decode($annexure1_sub3_data->pmax_applicable_model); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pmax_applicable_model): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            <?php echo e($pmax_applicable_model); ?></td>
                                                    </tr>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </table>
                                            </td>
                                            <td>
                                                <table width="100%">
                                                    <?php $__currentLoopData = json_decode($annexure1_sub3_data->applicable_mean_wattage); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $applicable_mean_wattage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            <?php echo e($applicable_mean_wattage); ?></td>
                                                    </tr>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </table>
                                            </td>
                                            <td>
                                                <table width="100%">
                                                    <?php $__currentLoopData = json_decode($annexure1_sub3_data->operation_temp); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $operation_temp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            <?php echo e($operation_temp); ?></td>
                                                    </tr>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </table>
                                            </td>
                                            <td>
                                                <table width="100%">
                                                    <?php $__currentLoopData = json_decode($annexure1_sub3_data->max_voltage); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $max_voltage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            <?php echo e($max_voltage); ?></td>
                                                    </tr>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </table>
                                            </td>

                                            <td>
                                                <table width="100%">
                                                    <?php $__currentLoopData = json_decode($annexure1_sub3_data->max_fuse_rating); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $max_fuse_rating): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            <?php echo e($max_fuse_rating); ?></td>
                                                    </tr>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </table>
                                            </td>
                                            <td>
                                                <table width="100%">
                                                    <?php $__currentLoopData = json_decode($annexure1_sub3_data->diode_rating); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $diode_rating): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            <?php echo e($diode_rating); ?></td>
                                                    </tr>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </table>
                                            </td>
                                            <td>
                                                <table width="100%">
                                                    <?php $__currentLoopData = json_decode($annexure1_sub3_data->fire_rating); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fire_rating): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            <?php echo e($fire_rating); ?></td>
                                                    </tr>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </table>
                                            </td>
                                            <td>
                                                <table width="100%">
                                                    <?php $__currentLoopData = json_decode($annexure1_sub3_data->fire_rating); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fire_rating): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr>
                                                        <td style="border-bottom:1px solid #ccc;">
                                                            <?php echo e($fire_rating); ?></td>
                                                    </tr>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </table>
                                            </td>


                                        </tr>

                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    </tbody>
                                </table>

                                <!--3.4-->
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
                                        
                                    </tr>
                                    <tr>

                                        <th>Temperature Co-efficient of Pmax</th>
                                        <th>Temperature Coefficient of Voc</th>
                                        <th>Temperature Coefficient of Isc)</th>
                                    </tr>
                                    <?php $b=0; ?>
                                    <?php $__currentLoopData = $annexure1_sub4; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data_4): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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

                                    </tr>
                                    <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                </tbody>
                            </table>
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
                                        
                                    </tr>
                                    <tr>

                                        <th>Length of Module (in mm)</th>
                                        <th>Breadth of Module (in mm)</th>
                                        <th>Area of Module (LxB) (in m2)</th>
                                        <th>Weight (in kg)</th>
                                    </tr>
                                    <?php $c=0; ?>
                                    <?php $__currentLoopData = $annexure1_sub5; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data_5): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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

                                    </tr>
                                    <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                </tbody>
                            </table>
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
                                    <?php $__currentLoopData = $annexure1_sub6; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data_6): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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

                                    </tr>
                                    <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                </tbody>
                            </table>

                               

                                <!-- Annexure 1 End-->
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                <h4>Annexure 2</h4>
                            </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body" style="background-color: #d4d4d4;">
                                <!-- Annexure 2 Start-->
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

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $annexure2_aryData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($loop->iteration); ?></td>
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

                                        </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>

                                </table>

                                <!-- Annexure 2 End-->
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingThree">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                <h4>Annexure 3</h4>
                            </button>
                        </h2>
                        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body" style="background-color: #d4d4d4;">
                                <!-- Annexure 3 Start-->
                                <table class="table table-bordered text-center">

                                    <thead>
                                        <tr>
                                            <th colspan="9" class=" text-left">4.1 BIS Certification Details</th>
                                        </tr>
                                        <tr class="bg-warning">
                                            <th>S.No</th>
                                            <th>Type of Modules</th>
                                            <th>Main Model</th>
                                            <th width="8%">Pmax (Wp) of Main Model</th>
                                            <th width="8%">Applicable models covered under ± 5% of Mean Wattage</th>
                                            <th>BIS Certificate No.</th>
                                            <th>BIS Certificate Issue</th>
                                            <th>BIS Certificate Valid</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $j = 1 ?>
                                        <?php $__currentLoopData = $annexure3; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub_annex_1): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
                                        <tr class="bg-warning">
                                            <th>S.No</th>
                                            <th>Type of Modules</th>
                                            <th>Main Model</th>
                                            <th width="8%">Pmax (Wp) of Main Model</th>
                                            <th width="8%">Applicable models covered under ± 5% of Mean Wattage</th>
                                            <th>Testing Standards</th>
                                            <th>Test Report No.</th>
                                            <th>Testing Laboratory</th>
                                            <th>Testing Laboratory Address</th>
                                            <th>Valid NABL Certificate No. of Test Laboratory at the time of testing
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1 ?>
                                        <?php $__currentLoopData = $annexure3; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub_annex_2): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

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

                                        </tr>
                                        <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>

                                </table>
                                <!-- Annexure 3 End-->
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingFour">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                <h4>Annexure 4</h4>
                            </button>
                        </h2>
                        <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body" style="background-color: #d4d4d4;">
                                <!-- Annexure 4 Start-->

                                <table class="table table-bordered text-center">

                                    <thead>
                                        <tr class="bg-warning">
                                            <th>5.2</th>
                                            <th scope="col" colspan="13" class="text-left">List of Major
                                                Machines/Equipments
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th width="5%">Line</th>
                                            <th width="10%">Compatible Technology (Cell Type/Max Cell Size/No. of Bus
                                                Bar)
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
                                        <?php $__currentLoopData = $annexure4; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
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

                                </table>

                                <hr>

                                <table class="table table-bordered">
                                    <thead>
                                        <tr class="bg-warning">
                                            <th>5.3</th>
                                            <th scope="col" colspan="13" class="text-left">List of Major
                                                Machines/Equipments
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th width="6%">Equipment/Module</th>
                                            <th width="5%">S.No</th>
                                            <th width="10%">Make and Model</th>
                                            <th width="10%">Machine Serial No.</th>
                                            <th>Calibration Done by (Lab/Agency/Company Name with Address)</th>
                                            <th width="10%">Last Calibration Date</th>
                                            <th width="10%">Calibration Valid Upto</th>


                                        </tr>
                                        <?php $__currentLoopData = $annexure4_sub3; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td>Sun Simulator</td>
                                            <td><?php echo e($loop->iteration); ?></td>
                                            <td><?php echo e($data->make_and_model); ?></td>
                                            <td><?php echo e($data->machine_serial_no); ?></td>
                                            <td><?php echo e($data->calibration_done_by); ?></td>
                                            <td><?php echo e($data->last_calibration_date); ?></td>
                                            <td><?php echo e($data->calibration_valid_upto); ?></td>


                                        </tr>

                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    </tbody>

                                </table>

                                <hr>

                                <table class="table table-bordered">
                                    <thead>
                                        <tr class="bg-warning">
                                            <th>5.4</th>
                                            <th scope="col" colspan="13" class="text-left">Calibration Details of
                                                Reference
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


                                        </tr>
                                        <?php $i=$j=0; ?>
                                        <?php $__currentLoopData = $annexure4_sub4; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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


                                        </tr>
                                        <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    </tbody>

                                </table>

                                <hr>

                                <table class="table table-bordered">
                                    <thead>
                                        <tr class="bg-warning">
                                            <th>5.5</th>
                                            <th scope="col" colspan="13" class="text-left">ISO Certification Details for
                                                the
                                                Manufacturing Plant
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th width="5%">S.No</th>
                                            <th width="20%">ISO Certificate</th>
                                            <th width="30%">Issuing Agency with Address</th>
                                            <th width="10%">Issuing Date</th>
                                            <th width="10%">Certificate Valid Upto</th>



                                        </tr>
                                        <?php $__currentLoopData = $annexure4_sub5; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($loop->iteration); ?></td>
                                            <td><?php echo e($data->iso_certificate); ?></td>
                                            <td><?php echo e($data->issuing_agency); ?></td>
                                            <td><?php echo e($data->issuing_date); ?></td>
                                            <td><?php echo e($data->certificate_validate); ?></td>


                                        </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    </tbody>

                                </table>

                                <!-- Annexure 4 End-->
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingFive">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                <h4>Annexure 5</h4>
                            </button>
                        </h2>
                        <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body" style="background-color: #d4d4d4;">
                                <table class="table table-bordered">
                                    <tr>
                                        <th colspan="4">PV Module Production Data in MW for last 3 financial year

                                        </th>
                                    </tr>
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
                                        'August', 6 =>
                                        'September', 7 => 'October', 8 => 'November', 9 => 'December', 10 => 'January',
                                        11 =>
                                        'February', 12 => 'March');
                                        ?>
                                        <?php $__currentLoopData = $months; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $num => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($loop->iteration); ?></td>
                                            <td><?php echo e($name); ?></td>
                                            <td><?php echo e(\App\Models\Annexure5::getFinancialDataadmin($applicationDetail['id'],$applicationDetail['user_id'],$name,$current_financial_year)); ?>

                                            </td>
                                            <td><?php echo e(\App\Models\Annexure5::getFinancialDataadmin($applicationDetail['id'],$applicationDetail['user_id'],$name,$last_financial_year)); ?>

                                            </td>
                                            <td><?php echo e(\App\Models\Annexure5::getFinancialDataadmin($applicationDetail['id'],$applicationDetail['user_id'],$name,$lasttolast_financial_year)); ?>

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
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $annexure5_appData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($loop->iteration); ?></td>
                                            <td><?php echo e($data->month); ?></td>
                                            <td><?php echo e($data->module_sale); ?></td>
                                            <td><?php echo e($data->module_sale_amount); ?></td>
                                            <td><?php echo e($data->epc_other_amount); ?></td>
                                            <td><?php echo e($data->total_sales); ?></td>
                                        </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $annexure5_lfyappData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($loop->iteration); ?></td>
                                            <td><?php echo e($data->month); ?></td>
                                            <td><?php echo e($data->module_sale); ?></td>
                                            <td><?php echo e($data->module_sale_amount); ?></td>
                                            <td><?php echo e($data->epc_other_amount); ?></td>
                                            <td><?php echo e($data->total_sales); ?></td>
                                        </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $annexure5_ltlfyappData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($loop->iteration); ?></td>
                                            <td><?php echo e($data->month); ?></td>
                                            <td><?php echo e($data->module_sale); ?></td>
                                            <td><?php echo e($data->module_sale_amount); ?></td>
                                            <td><?php echo e($data->epc_other_amount); ?></td>
                                            <td><?php echo e($data->total_sales); ?></td>
                                        </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $annexure5_appData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($loop->iteration); ?></td>
                                            <td><?php echo e($data->month); ?></td>
                                            <td><?php echo e($data->raw_purchase_module); ?></td>
                                            <td><?php echo e($data->other_raw_purchase); ?></td>
                                            <td><?php echo e($data->total_purchase); ?></td>
                                        </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $annexure5_lfyappData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($loop->iteration); ?></td>
                                            <td><?php echo e($data->month); ?></td>
                                            <td><?php echo e($data->raw_purchase_module); ?></td>
                                            <td><?php echo e($data->other_raw_purchase); ?></td>
                                            <td><?php echo e($data->total_purchase); ?></td>
                                        </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $annexure5_ltlfyappData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($loop->iteration); ?></td>
                                            <td><?php echo e($data->month); ?></td>
                                            <td><?php echo e($data->raw_purchase_module); ?></td>
                                            <td><?php echo e($data->other_raw_purchase); ?></td>
                                            <td><?php echo e($data->total_purchase); ?></td>
                                        </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingSix">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                                <h4>Annexure 6</h4>
                            </button>
                        </h2>
                        <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body" style="background-color: #d4d4d4;">
                                <table class="table table-bordered">

                                    <tr>
                                        <th colspan="7">Details of all Manufacturing Plant under same Brand/Company
                                            name
                                        </th>
                                    </tr>
                                    <tr class="bg-warning">
                                        <th>S.No</th>
                                        <th>Name of Company</th>
                                        <th>Country</th>
                                        <th>Address</th>
                                        <th>Whether Enlisted in ALMM </th>
                                        <th>No. of PV Models Enlisted in ALMM</th>
                                        <th>Enlisted/Rated PV Modules Manufacturing Capacity</th>
                                    </tr>

                                    <tbody>


                                        <?php $__currentLoopData = $annexure6; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $annexure6_data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                        <tr>
                                            <td><?php echo e($loop->iteration); ?></td>
                                            <td><?php echo e($annexure6_data->name_of_company); ?></td>
                                            <td><?php echo e($annexure6_data->country); ?></td>
                                            <td><?php echo e($annexure6_data->address); ?></td>
                                            <td><?php echo e($annexure6_data->whether_enlisted); ?></td>
                                            <td><?php echo e($annexure6_data->noofpv_models); ?></td>
                                            <td><?php echo e($annexure6_data->manufacturing_capacity); ?></td>
                                        </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingSeven">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                                <h4>Annexure 7</h4>
                            </button>
                        </h2>
                        <div id="collapseSeven" class="accordion-collapse collapse" aria-labelledby="headingSeven"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body" style="background-color: #d4d4d4;">
                                <table class="table table-bordered">
                                    <tr>
                                        <th>
                                            <?php if(isset($applicationDetail) && $applicationDetail['annexure7']!=null): ?>
                                            <a href="<?php echo e(URL::to($docBaseUrl.$applicationDetail['annexure7'])); ?>"
                                                style="margin-top: -8px;display: block;" target="_blank">View
                                                uploaded Annexure
                                            </a>
                                            <?php endif; ?>
                                        </th>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingEight">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                                <h4>Annexure 8</h4>
                            </button>
                        </h2>
                        <div id="collapseEight" class="accordion-collapse collapse" aria-labelledby="headingEight"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body" style="background-color: #d4d4d4;">
                                <table class="table table-bordered">
                                    <tr>
                                        <th>
                                            <?php if(isset($applicationDetail) && $applicationDetail['annexure8']!=null): ?>
                                            <a href="<?php echo e(URL::to($docBaseUrl.$applicationDetail['annexure8'])); ?>"
                                                style="margin-top: -8px;display: block;" target="_blank">View
                                                uploaded Annexure
                                            </a>
                                            <?php endif; ?>
                                        </th>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingEight">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseNine" aria-expanded="false" aria-controls="collapseNine">
                                <h4>Attachment's</h4>
                            </button>
                        </h2>
                        <div id="collapseNine" class="accordion-collapse collapse" aria-labelledby="headingNine"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body" style="background-color: #d4d4d4;">
                                <table class="table table-bordered">
                                    <tr>
                                        <th width="5%">S.No</th>
                                        <th>Attachment Title</th>
                                        <th width="20%">Attachment</th>
                                    </tr>
                                    <tr>
                                        <th> 1</th>
                                        <td>Copy of Certificate of Incorporation of the applying entity issued by
                                            Registrar
                                            of Companies, Ministry of Corporate Affairs, Government of India.</td>

                                        <td>
                                            <?php if(($applicationDetail['attc_incorporation_cerificate'] ?? '')!=null): ?>
                                            <a target="_blank"
                                                href="<?php echo e(URL::to($attchmentBaseUrl.$applicationDetail['attc_incorporation_cerificate'])); ?>"
                                                class="document">Attachment No. 1</a><?php else: ?> No <?php endif; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th> 2</th>
                                        <td>Details of Payment of Application and Inspection Fee</td>
                                        <td>
                                            <?php if(($applicationDetail['attc_application_inspection_payment'] ?? '')!=null): ?>
                                            <a target="_blank"
                                                href="<?php echo e(URL::to($attchmentBaseUrl.$applicationDetail['attc_application_inspection_payment'])); ?>"
                                                class="document">Attachment No. 1</a><?php else: ?> No <?php endif; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th> 3</th>
                                        <td>Datasheets of the modules applied for enlistment in ALMM</td>
                                        <td>
                                            <?php if(($applicationDetail['attc_enlisted_module_datalist'] ?? '')!=null): ?>
                                            <a target="_blank"
                                                href="<?php echo e(URL::to($attchmentBaseUrl.$applicationDetail['attc_enlisted_module_datalist'])); ?>"
                                                class="document">Attachment No. 1</a><?php else: ?> No <?php endif; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th> 4</th>
                                        <td>Datasheets of the solar cells used in the modules</td>
                                        <td>
                                            <?php if(($applicationDetail['attc_solar_cell_datalist'] ?? '')!=null): ?>
                                            <a target="_blank"
                                                href="<?php echo e(URL::to($attchmentBaseUrl.$applicationDetail['attc_solar_cell_datalist'])); ?>"
                                                class="document">Attachment No. 1</a><?php else: ?> No <?php endif; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th> 5</th>
                                        <td>Details of Balance of Materials as sought in Application Form</td>
                                        <td>
                                            <?php if(($applicationDetail['attc_bom_details'] ?? '')!=null): ?>
                                            <a target="_blank"
                                                href="<?php echo e(URL::to($attchmentBaseUrl.$applicationDetail['attc_bom_details'])); ?>"
                                                class="document">Attachment No. 1</a><?php else: ?> No <?php endif; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th> 6</th>
                                        <td>Copy of Certificate for BIS Registration/ Certification</td>
                                        <td>
                                            <?php if(($applicationDetail['attc_bis_certificate'] ?? '')!=null): ?>
                                            <a target="_blank"
                                                href="<?php echo e(URL::to($attchmentBaseUrl.$applicationDetail['attc_bis_certificate'])); ?>"
                                                class="document">Attachment No. 1</a><?php else: ?> No <?php endif; ?>
                                        </td>

                                    </tr>
                                    <tr>
                                        <th> 7</th>
                                        <td>Copy of the Accreditation Certificate of the Lab which has given test
                                            certificates required for BIS Registration/ Certification</td>
                                        <td>
                                            <?php if(($applicationDetail['attc_accreditation_certificate'] ?? '')!=null): ?>
                                            <a target="_blank"
                                                href="<?php echo e(URL::to($attchmentBaseUrl.$applicationDetail['attc_accreditation_certificate'])); ?>"
                                                class="document">Attachment No. 1</a><?php else: ?> No <?php endif; ?>
                                        </td>

                                    </tr>
                                    <tr>
                                        <th> 8</th>
                                        <td>Calibration Report of Sun Simulator</td>
                                        <td>
                                            <?php if(($applicationDetail['attc_calibration_report_sun_simulator'] ??
                                            '')!=null): ?>
                                            <a target="_blank"
                                                href="<?php echo e(URL::to($attchmentBaseUrl.$applicationDetail['attc_calibration_report_sun_simulator'])); ?>"
                                                class="document">Attachment No. 1</a><?php else: ?> No <?php endif; ?>
                                        </td>

                                    </tr>
                                    <tr>
                                        <th>9</th>
                                        <td>Calibration Report of Reference Modules</td>
                                        <td>
                                            <?php if(($applicationDetail['attc_calibration_report_module'] ?? '')!=null): ?>
                                            <a target="_blank"
                                                href="<?php echo e(URL::to($attchmentBaseUrl.$applicationDetail['attc_calibration_report_module'])); ?>"
                                                class="document">Attachment No. 1</a><?php else: ?> No <?php endif; ?>
                                        </td>

                                    </tr>
                                    <tr>
                                        <th> 10</th>
                                        <td>Copy of valid ISO Certificate for quality management system. Copy of
                                            Accreditation certificate of ISO certifying body</td>
                                        <td>
                                            <?php if(($applicationDetail['attc_iso_certificate'] ?? '')!=null): ?>
                                            <a target="_blank"
                                                href="<?php echo e(URL::to($attchmentBaseUrl.$applicationDetail['attc_iso_certificate'])); ?>"
                                                class="document">Attachment No. 1</a><?php else: ?> No <?php endif; ?>
                                        </td>

                                    </tr>
                                    <tr>
                                        <th> 11</th>
                                        <td>Balance Sheet for last three years or the period of existence of such units,
                                            whichever is less</td>
                                        <td>
                                            <?php if(($applicationDetail['attc_balance_sheet_last_years'] ?? '')!=null): ?>
                                            <a target="_blank"
                                                href="<?php echo e(URL::to($attchmentBaseUrl.$applicationDetail['attc_balance_sheet_last_years'])); ?>"
                                                class="document">Attachment No. 1</a><?php else: ?> No <?php endif; ?>
                                        </td>

                                    </tr>
                                </table>


                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <blockquote>
                    <?php if($applicationDetail['forward_status']=='nise'): ?>
                    <tr>
                        <td colspan="7">
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#exampleModal">Forward to MNRE</button>
                            <button type="button" class="btn btn-warning" data-toggle="modal"
                                data-target="#exampleModal">Request for
                                Document</button>
                            <button type="button" class="btn btn-success" data-toggle="modal"
                                data-target="#scheduleInspection">Schedule
                                Inspection Date</button>
                            <a href="<?php echo e(URL::to('/'.Auth::getDefaultDriver().'/applications-list')); ?>"
                                class="btn btn-danger">Back</a>
                        </td>
                    </tr>
                    <?php endif; ?>
                </blockquote>
            </div>

        </div>
    </div>
</div>

<!-- <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Review</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?php echo e(url('nise/forwardto')); ?>" method="POST" autocomplete="off">
                <?php echo e(csrf_field()); ?>

                <div class="modal-body">
                    <input type="hidden" name="id" value="<?php echo e($applicationDetail['id']); ?>">
                    <div class="form-group">
                        <label for="forward_status" class="col-form-label">Forward Status:</label>
                        <select name="forward_status" id="forward_status">
                            <option value="mnre">Notification for MNRE</option>
                            <option value="user">Notification for USER</option>
                            <option value="reject">REJECT</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Message:</label>
                        <textarea name="description" class="form-control" id="message-text" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div> -->
<div class="modal" id="scheduleInspection">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Schedule Inspection Date</h4>
                <button type="button" class="btn-close" data-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <form action="<?php echo e(url('nise/scheduleInspection')); ?>" method="POST" autocomplete="off" id="formId">
                <?php echo csrf_field(); ?>
                <div class="modal-body">
                    <input type="hidden" name="application_id" value="<?php echo e($applicationDetail['id']); ?>">
                    <input type="hidden" name="user_id" value="<?php echo e($applicationDetail['user_id']); ?>">
                    <input type="hidden" name="proposedDate" id="proposedDate"
                        value="<?php echo e($applicationDetail['inspection_date']); ?>">

                    <div class="form-group">
                        <label for="forward_status" class="col-form-label">Manufature Proposed Inspection Date:</label>
                        <?php if($applicationDetail['inspection_date']!=NULL): ?>
                        <strong
                            class="text-success"><?php echo e(date('d-M-Y', strtotime($applicationDetail['inspection_date']))); ?></strong>
                        <?php else: ?>
                        Not Mentioned
                        <?php endif; ?>

                    </div>
                    <div class="form-group">
                        <label for="forward_status" class="col-form-label">Schedule Inspection Date:</label>
                        <input type="date" name="inspection_date" class="form-control" id="inspection_date">
                        <span id="errorMsgScheduleDate" class="text-danger"></span>
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Message:</label>
                        <textarea name="description" class="form-control" id="message-text"></textarea>
                        <span id="errorMsgRemark" class="text-danger"></span>
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">

                    <button type="button" onclick="checkPoint()" class="btn btn-primary">Schedule</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>

                </div>
            </form>

        </div>
    </div>
</div>
<script>
function checkPoint() {
    $('#errorMsgScheduleDate').html('');
    $('#errorMsgRemark').html('');
    var proposedDate = Date.parse($("#proposedDate").val())
    var scheduleDate = Date.parse($("#inspection_date").val())
    if ($("#inspection_date").val() == '') {
        $('#errorMsgScheduleDate').html('Please select schedule date');
        return false;
    }
    if ($("#message-text").val() == '') {
        $('#errorMsgRemark').html('Please enter remark');
        return false;
    }
    if (proposedDate > scheduleDate) {
        alert('Schedule date should be greater than Proposed date');
        return false;
    }
    $("#formId").submit();
}
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.masters.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xamp\htdocs\ALMM\resources\views/backend/nise/view-applications.blade.php ENDPATH**/ ?>