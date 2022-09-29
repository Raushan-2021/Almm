<html>
    <title></title>

    <head>
        <link href="<?php echo e(public_path('public/css/bootstrap.min.css')); ?>" rel="stylesheet" type="text/css" />

    </head>
    <style>
    table {
        width: 100%;
    }

    tr,
    th,
    td {
        border: 1px solid #ccc;
        padding: 5px;
        text-align: left;
        margin: 0px;
    }

    </style>

    <body>
        <?php $logoBaseUrl ='users/preview-docs/Logo/';
        $docBaseUrl ='users/preview-docs/Attachment/';
        ?>
        <table cellspacing="0" class="table table-bordered table-striped">
            <tr>
                <th colspan="3" class="bg-primary">Details of Solar Photovoltaic (PV) Module Manufacturer</th>
            </tr>
            <tr>
                <th width="30%">Type of Application</th>
                <th colspan="2">
                    <?php if($application_data->application_type ==1): ?>New Application <?php endif; ?>
                </th>
            </tr>
            <tr>
                <th>Name of Manufacturer</th>
                <th colspan="2">
                    <?php echo e($application_data->manufacturer_name); ?>

                </th>
            </tr>
            <tr>
                <th>Manufacturer Brand Name & Logo</th>
                <th>
                    <?php echo e($application_data->manufacturer_brand_name); ?>


                </th>
                <th><img src="<?php echo e(url('storage/documents/systems/Logo/'.$application_data->manufacturer_brand_logo)); ?>"
                        alt="<?php echo e($application_data->manufacturer_name); ?>" style="width:50px;t" /></th>
            </tr>
            <tr>
                <th>Registered Office Address of the Manufacturer</th>
                <td colspan="2">
                    <b>Address:</b> <?php echo e($application_data->register_office_address); ?><br>
                    <b>Phone:</b> <?php echo e($application_data->register_office_phone); ?><br>
                    <b>Email:</b> <?php echo e($application_data->register_office_email); ?>


                </td>
            </tr>
            <tr>
                <th>Communication Address of the Manufacturer</th>
                <td colspan="2">
                    <b>Address:</b> <?php echo e($application_data->com_address); ?><br>
                    <b>Phone:</b> <?php echo e($application_data->com_phone); ?><br>
                    <b>Email:</b> <?php echo e($application_data->com_email); ?>


                </td>
            </tr>
            <tr>
                <th>Location/Address of Manufacturing Plant including Latitude/Longitude for the current application
                </th>
                <td colspan="2">
                    <b>Address:</b> <?php echo e($application_data['plant_address']); ?><br>
                    <b>Phone:</b> <?php echo e($application_data->plant_phone); ?><br>
                    <b>Email:</b> <?php echo e($application_data->plant_email); ?><br>
                    <b>Latitude:</b><?php echo e($application_data->plant_latitude); ?><br>
                    <b>Longitude:</b><?php echo e($application_data->plant_longitude); ?>


                </td>
            </tr>
            <tr>
                <th>Details of all Manufacturing Plant under same Brand/Company name</th>
                <td colspan="2">
                    <strong>No. of Manufacturing plant in India: <?php echo e($application_data->existing_plant_india); ?></strong>
                    <br>
                    <strong>No. of Manufacturing plant out of India:
                        <?php echo e($application_data->existing_plant_outindia); ?></strong>

                </td>
            </tr>
            <tr>
                <th>Contact Person</th>
                <td colspan="2">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="">Name:</label>
                            <?php echo e($application_data->contact_person_name); ?>

                        </div>
                        <div class="col-md-6">
                            <label for="">Designation:</label>
                            <?php echo e($application_data->person_designation); ?>

                        </div>

                        <div class="col-md-6">
                            <label for="">Phone No:</label>
                            <?php echo e($application_data->person_contact_no); ?>

                        </div>

                        <div class="col-md-6">
                            <label for="">E-mail:</label>
                            <?php echo e($application_data->person_email); ?>

                        </div>

                    </div>
                </td>

            </tr>
            <tr>
                <th>Authorized signatory details</th>
                <td colspan="2">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="">Name:</label>
                            <?php echo e($application_data->authorize_name); ?>

                        </div>

                        <div class="col-md-6">
                            <label for="">Designation:</label>
                            <?php echo e($application_data->authorize_designation); ?>

                        </div>

                    </div>
                </td>

            </tr>
            <tr>
                <th>No. of Main PV Model Applied</th>
                <td colspan="2">
                    <div class="row">
                        <div class="col-md-12">
                            <table cellspacing="0">
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
                <th>Total PV Manufacturing Capacity (in MW/year)</th>
                <td colspan="2"><?php echo e($application_data->manufacturing_capacity); ?></td>
            </tr>
            <tr>
                <th>Whether Already Enlisted in ALMM</th>
                <td colspan="2">
                    <div class="row">
                        <div class="col-md-2">
                            <?php if($application_data->enlisted_almm=='1'): ?>
                            Yes
                            <?php else: ?>
                            No
                            <?php endif; ?>
                        </div>
                        <div class="col-md-6">
                            <?php if($application_data->enlisted_almm=='1'): ?>
                            <div class="col-md-12">
                                <label for="">No. of Main PV Model Enlisted:</label>
                                <?php echo e($application_data->no_enlisted_pvmodel); ?>

                            </div>
                            <?php endif; ?>

                            <div class="col-md-12">
                                <label for="">Total PV Module Manufacturing Capacity (MW/year):</label>
                                <?php echo e($application_data->total_pv_capacity); ?>

                            </div>
                            <div class="col-md-12">
                                <label for="">ALMM Enlistment Validity: <?php echo e($application_data->validity_from); ?> to
                                    <?php echo e($application_data->validity_to); ?></label>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <th>Details of Payment of Fee</th>
                <td colspan="2">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="">Application Fees:</label>
                            <?php echo e($application_data->application_fees); ?>/-
                        </div>
                        <div class="col-md-6">
                            <label for="">Inspection Fees:</label>
                            <?php echo e($application_data->inspection_fees); ?>/-
                        </div>

                        <div class="col-md-6">
                            <label for="">Total Amount Paid:</label>
                            <?php echo e($application_data->total_amount); ?>/-
                        </div>


                        <div class="col-md-6">
                            <label for="">Payment Date:</label>
                            <?php echo e($application_data->payment_date); ?>

                        </div>
                        <div style="clear:both"></div>
                        <div class="col-md-6">
                            <label for="">UTR/reference No:</label>
                            <?php echo e($application_data->utn_no); ?>

                        </div>
                        <div class="col-md-6">

                            <label for="">Mode of Payment:</label>
                            <?php if($application_data->payment_mode ==1): ?> Online <?php else: ?> Offline <?php endif; ?>

                        </div>
                    </div>
                </td>

            </tr>
            <tr>
                <th>Check List of Documents/requirements submitted with application</th>
                <td colspan="2">
                    <table cellspacing="0" class="table table-bordered table-striped">
                        <tbody>
                            <tr>
                                <th width="5%">S.No</th>
                                <th>Attachment Title</th>
                                <th width="20%">Available</th>
                                <th width="10%"></th>
                            </tr>
                            <tr>
                                <th> 1</th>
                                <td>Copy of Certificate of Incorporation of the applying entity issued by
                                    Registrar
                                    of Companies, Ministry of Corporate Affairs, Government of India.</td>
                                <td>
                                    <?php if(($application_data->attc_incorporation_cerificate ?? '')!=null): ?>
                                    <i class="fa fa-check text-success"></i> Yes
                                    <?php else: ?> No <?php endif; ?>

                                </td>
                                <td>
                                    <?php if(($application_data->attc_incorporation_cerificate ?? '')!=null): ?>
                                    <small><a target="_blank"
                                            href="<?php echo e(URL::to($docBaseUrl.$application_data->attc_incorporation_cerificate)); ?>"
                                            class="document">Attachment No. 1</a></small><?php endif; ?>
                                </td>
                            </tr>
                            <tr>
                                <th> 2</th>
                                <td>Details of Payment of Application and Inspection Fee</td>
                                <td>
                                    <?php if(($application_data->attc_application_inspection_payment ?? '')!=null): ?>
                                    <i class="fa fa-check text-success"></i> Yes
                                    <?php else: ?> No <?php endif; ?>
                                </td>
                                <td> <?php if(($application_data->attc_application_inspection_payment ?? '')!=null): ?>
                                    <small><a target="_blank"
                                            href="<?php echo e(URL::to($docBaseUrl.$application_data->attc_application_inspection_payment)); ?>"
                                            class="document">Attachment No. 2</a></small><?php endif; ?>
                                </td>
                            </tr>
                            <tr>
                                <th> 3</th>
                                <td>Datasheets of the modules applied for enlistment in ALMM</td>
                                <td>
                                    <?php if(($application_data->attc_enlisted_module_datalist ?? '')!=null): ?>
                                    <i class="fa fa-check text-success"></i> Yes
                                    <?php else: ?> No <?php endif; ?>
                                </td>
                                <td> <?php if(($application_data->attc_enlisted_module_datalist ?? '')!=null): ?>
                                    <small><a target="_blank"
                                            href="<?php echo e(URL::to($docBaseUrl.$application_data->attc_enlisted_module_datalist)); ?>"
                                            class="document">Attachment No. 3</a></small><?php endif; ?>
                                </td>
                            </tr>
                            <tr>
                                <th> 4</th>
                                <td>Datasheets of the solar cells used in the modules</td>
                                <td>
                                    <?php if(($application_data->attc_solar_cell_datalist ?? '')!=null): ?>
                                    <i class="fa fa-check text-success"></i> Yes
                                    <?php else: ?> No <?php endif; ?>
                                </td>
                                <td> <?php if(($application_data->attc_solar_cell_datalist ?? '')!=null): ?>
                                    <small><a target="_blank"
                                            href="<?php echo e(URL::to($docBaseUrl.$application_data->attc_solar_cell_datalist)); ?>"
                                            class="document">Attachment No. 4</a></small><?php endif; ?>
                                </td>
                            </tr>
                            <tr>
                                <th> 5</th>
                                <td>Details of Balance of Materials as sought in Application Form</td>
                                <td>
                                    <?php if(($application_data->attc_bom_details ?? '')!=null): ?>
                                    <i class="fa fa-check text-success"></i> Yes
                                    <?php else: ?> No <?php endif; ?>
                                </td>
                                <td> <?php if(($application_data->attc_bom_details ?? '')!=null): ?>
                                    <small><a target="_blank"
                                            href="<?php echo e(URL::to($docBaseUrl.$application_data->attc_bom_details)); ?>"
                                            class="document">Attachment No. 5</a></small><?php endif; ?>
                                </td>
                            </tr>
                            <tr>
                                <th> 6</th>
                                <td>Copy of Certificate for BIS Registration/ Certification</td>
                                <td>
                                    <?php if(($application_data->attc_bis_certificate ?? '')!=null): ?>
                                    <i class="fa fa-check text-success"></i> Yes
                                    <?php else: ?> No <?php endif; ?>
                                </td>
                                <td><?php if(($application_data->attc_bis_certificate ?? '')!=null): ?>
                                    <small><a target="_blank"
                                            href="<?php echo e(URL::to($docBaseUrl.$application_data->attc_bis_certificate)); ?>"
                                            class="document">Attachment No. 6</a></small><?php endif; ?>
                                </td>
                            </tr>
                            <tr>
                                <th> 7</th>
                                <td>Copy of the Accreditation Certificate of the Lab which has given test
                                    certificates required for BIS Registration/ Certification</td>
                                <td>
                                    <?php if(($application_data->attc_accreditation_certificate ?? '')!=null): ?>
                                    <i class="fa fa-check text-success"></i> Yes
                                    <?php else: ?> No <?php endif; ?>
                                </td>
                                <td><?php if(($application_data->attc_accreditation_certificate ?? '')!=null): ?>
                                    <small><a target="_blank"
                                            href="<?php echo e(URL::to($docBaseUrl.$application_data->attc_accreditation_certificate)); ?>"
                                            class="document">Attachment No. 7</a></small><?php endif; ?>
                                </td>
                            </tr>
                            <tr>
                                <th> 8</th>
                                <td>Calibration Report of Sun Simulator</td>
                                <td>
                                    <?php if(($application_data->attc_calibration_report_sun_simulator ?? '')!=null): ?>
                                    <i class="fa fa-check text-success"></i> Yes
                                    <?php else: ?> No <?php endif; ?>
                                </td>
                                <td><?php if(($application_data->attc_calibration_report_sun_simulator ?? '')!=null): ?>
                                    <small><a target="_blank"
                                            href="<?php echo e(URL::to($docBaseUrl.$application_data->attc_calibration_report_sun_simulator)); ?>"
                                            class="document">Attachment No. 8</a></small><?php endif; ?>
                                </td>
                            </tr>
                            <tr>
                                <th>9</th>
                                <td>Calibration Report of Reference Modules</td>
                                <td>
                                    <?php if(($application_data->attc_calibration_report_module ?? '')!=null): ?>
                                    <i class="fa fa-check text-success"></i> Yes
                                    <?php else: ?> No <?php endif; ?>
                                </td>
                                <td><?php if(($application_data->attc_calibration_report_module ?? '')!=null): ?>
                                    <small><a target="_blank"
                                            href="<?php echo e(URL::to($docBaseUrl.$application_data->attc_calibration_report_module)); ?>"
                                            class="document">Attachment No. 9</a></small><?php endif; ?>
                                </td>
                            </tr>
                            <tr>
                                <th> 10</th>
                                <td>Copy of valid ISO Certificate for quality management system. Copy of
                                    Accreditation certificate of ISO certifying body</td>
                                <td>
                                    <?php if(($application_data->attc_iso_certificate ?? '')!=null): ?>
                                    <i class="fa fa-check text-success"></i> Yes
                                    <?php else: ?> No <?php endif; ?>
                                </td>
                                <td><?php if(($application_data->attc_iso_certificate ?? '')!=null): ?>
                                    <small><a target="_blank"
                                            href="<?php echo e(URL::to($docBaseUrl.$application_data->attc_iso_certificate)); ?>"
                                            class="document">Attachment No. 10</a></small><?php endif; ?>
                                </td>
                            </tr>
                            <tr>
                                <th> 11</th>
                                <td>Balance Sheet for last three years or the period of existence of such units,
                                    whichever is less</td>
                                <td>
                                    <?php if(($application_data->attc_balance_sheet_last_years ?? '')!=null): ?>
                                    <i class="fa fa-check text-success"></i> Yes
                                    <?php else: ?> No <?php endif; ?>
                                </td>
                                <td><?php if(($application_data->attc_balance_sheet_last_years ?? '')!=null): ?>
                                    <small><a target="_blank"
                                            href="<?php echo e(URL::to($docBaseUrl.$application_data->attc_balance_sheet_last_years)); ?>"
                                            class="document">Attachment No. 10</a></small><?php endif; ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="3" class="text-center">
                    <table cellspacing="0" style="border:0px;">
                        <tr style="border:0px;">
                            <td style="border:0px;">
                                <div class="col-md-3">
                                    <i>Shri Default Name<br>
                                        Director, Company<br><br><br>
                                        ..............................</i>
                                </div>
                            </td>
                            <td style="border:0px;">
                                <div class="col-md-3">
                                    <i>Shri Default Name<br>
                                        Director, Company<br><br><br>
                                        ..............................</i>
                                </div>
                            </td>
                            <td style="border:0px;">
                                <div class="col-md-3">
                                    <i>Shri Default Name<br>
                                        Director, Company<br><br><br>
                                        ..............................</i>
                                </div>
                            </td>
                            <td style="border:0px;">
                                <div class="col-md-3">
                                    <i>Shri Default Name<br>
                                        Director, Company<br><br><br>
                                        ..............................</i>
                                </div>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </body>

</html>
<?php /**PATH D:\xamp\htdocs\ALMM\resources\views/backend/user/form/pdf_newApplication.blade.php ENDPATH**/ ?>