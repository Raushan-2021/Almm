
<?php $__env->startSection('title', 'New Application'); ?>
<?php $__env->startSection('content'); ?>
<?php $docBaseUrl ='users/preview-docs/Certificate/';
$logoBaseUrl ='users/preview-docs/Logo/';
$attcBaseUrl ='users/preview-docs/Attachment/';
?>
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
                            <small class="text-danger float-right">* All Fields are mandatory</small>

                        </div>
                        <div class="box-body">

                            <form action="<?php echo e(URL::to('/users/existing-application')); ?>" method="POST"
                                enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('POST'); ?>
                                <table class="table table-bordered">
                                    <tr>
                                        <th>1</th>
                                        <td width="30%"> <strong>Name of Manufacturer <small
                                                    class="text-danger">*</small></strong>
                                        </td>
                                        <th>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <input type="text" name="manufacturer_name"
                                                        placeholder="Name of Manufacturer" id="manufacturer_name"
                                                        class="form-control" maxlength="70"
                                                        value="<?php echo e($appData->manufacturer_name ?? old('manufacturer_name')); ?>">
                                                    <?php $__errorArgs = ['manufacturer_name'];
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
                                    <tr>
                                        <th>2</th>
                                        <td width="30%"> <strong>Manufacturer Brand Name & Logo <small
                                                    class="text-danger">*</small></strong> </small>
                                        </td>
                                        <th>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <input type="text" name="manufacturer_brand_name"
                                                        placeholder="Manufacturer Brand Name"
                                                        id="manufacturer_brand_name" class="form-control" maxlength="60"
                                                        value="<?php echo e($appData->manufacturer_brand_name ?? old('manufacturer_brand_name')); ?>">
                                                    <?php $__errorArgs = ['manufacturer_brand_name'];
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
                                                    <div class="col-md-3" style="display: contents;">
                                                        <label for="">Upload Logo<small class="text-primary">(Max.
                                                                1MB and JPF,PNG Format
                                                                Only)</small></label>

                                                    </div>

                                                    <div class="col-md-9">
                                                        <input type="file" name="manufacturer_brand_logo"
                                                            id="manufacturer_brand_logo" class="form-control">
                                                        <?php $__errorArgs = ['manufacturer_brand_logo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span
                                                            class="invalid-feedback custom_valid_class">
                                                            <?php echo e($message); ?> </span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                        <?php if(!empty($appData->manufacturer_brand_logo)): ?>
                                                        <input type="hidden" name="old_manufacturer_brand_logo"
                                                            value="<?php echo e($appData->manufacturer_brand_logo); ?>" id="">
                                                        <small><a target="_blank"
                                                                href="<?php echo e(URL::to($logoBaseUrl.$appData->manufacturer_brand_logo)); ?>"
                                                                class="document">View
                                                                Logo</a></small>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>3</th>
                                        <td width="30%"> <strong>Registered Office Address of the
                                                Manufacturer
                                                <small class="text-danger">*</small></strong> <br>

                                        </td>
                                        <th>
                                            <textarea name="register_office_address" id="register_office_address"
                                                cols="30" rows="5" class="form-control" maxlength="1000"
                                                placeholder="Registered Office Address of the Manufacturer"><?php echo e($appData->register_office_address ?? old('register_office_address')); ?></textarea>
                                            <?php $__errorArgs = ['register_office_address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span
                                                class="invalid-feedback custom_valid_class">
                                                <?php echo e($message); ?> </span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            <i class="custom_valid_class" id="reg_address_char"></i>
                                            <small class="max-char"> (Max. 1000 Characters)</small>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label for="phone">Phone:</label>
                                                    <input type="number" name="register_office_phone"
                                                        id="register_office_phone" maxlength="10"
                                                        placeholder="Contact Number" class="form-control"
                                                        value="<?php echo e($appData->register_office_phone ?? old('register_office_phone')); ?>">
                                                    <?php $__errorArgs = ['register_office_phone'];
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
                                                    <label for="email">Email:</label>
                                                    <input type="email" name="register_office_email"
                                                        id="register_office_email" class="form-control"
                                                        placeholder="Email Address"
                                                        value="<?php echo e($appData->register_office_email ?? old('register_office_email')); ?>">
                                                    <?php $__errorArgs = ['register_office_email'];
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

                                    <tr>
                                        <th>4</th>
                                        <td width="30%"> <strong>Communication Address of the
                                                Manufacturer <small class="text-danger">*</small> <br>( <input
                                                    type="checkbox" name="is_comm_add_same" id="is_comm_add_same"
                                                    <?php if(isset($appData->is_comm_add_same) &&
                                                $appData->is_comm_add_same ==1): ?>checked
                                                <?php endif; ?>> Check,if address same as registered
                                                address)</strong>

                                        </td>
                                        <th>
                                            <textarea name="com_address" id="com_address" cols="30" rows="5"
                                                class="form-control" maxlength="1000"
                                                placeholder="Communication Office Address of the Manufacturer"><?php echo e($appData->com_address ?? old('com_address')); ?></textarea>
                                            <?php $__errorArgs = ['com_address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="invalid-feedback custom_valid_class">
                                                <?php echo e($message); ?> </span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            <i class="custom_valid_class" id="com_address_char"></i>
                                            <small class="max-char"> (Max. 1000 Characters)</small>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label for="phone">Phone:</label>
                                                    <input type="number" name="com_phone" id="com_phone"
                                                        class="form-control" placeholder="Contact Number" maxlength="10"
                                                        value="<?php echo e($appData->com_phone ?? old('com_phone')); ?>">
                                                    <?php $__errorArgs = ['com_phone'];
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
                                                    <label for="email">Email:</label>
                                                    <input type="email" name="com_email" id="com_email"
                                                        class="form-control" placeholder="Email Address"
                                                        value="<?php echo e($appData->com_email ?? old('com_email')); ?>">
                                                    <?php $__errorArgs = ['com_email'];
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
                                    <tr>
                                        <th>5</th>
                                        <td width="30%"> <strong>Location/Address of Manufacturing Plant
                                                including
                                                Latitude/Longitude for the current application <small
                                                    class="text-danger">*</small></strong> <br>
                                        </td>
                                        <th>
                                            <div class="row">
                                                <div class="col-md-7">
                                                    <textarea name="plant_address" id="plant_address" cols="30" rows="7"
                                                        class="form-control" maxlength="1000"
                                                        placeholder="Location/Address of Manufacturing Plant"><?php echo e($appData->plant_address ?? old('plant_address')); ?></textarea>
                                                    <?php $__errorArgs = ['plant_address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span
                                                        class="invalid-feedback custom_valid_class">
                                                        <?php echo e($message); ?> </span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                    <i class="custom_valid_class" id="plant_address_char"></i>
                                                    <small class="max-char"> (Max. 1000 Characters)</i></small>
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="col-md-12">
                                                        <label for="">Latitude:</label>
                                                        <input type="text" name="plant_latitude" id="plant_latitude"
                                                            class="form-control" placeholder="Plant Latitude"
                                                            value="<?php echo e($appData->plant_latitude ?? old('plant_latitude')); ?>">
                                                        <?php $__errorArgs = ['plant_latitude'];
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
                                                        <label for="Longitude">Longitude:</label>
                                                        <input type="text" name="plant_longitude" id="plant_longitude"
                                                            class="form-control" placeholder="Plant Longitude"
                                                            value="<?php echo e($appData->plant_longitude ?? old('plant_longitude')); ?>">
                                                        <?php $__errorArgs = ['plant_longitude'];
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

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label for="phone">Phone:</label>
                                                    <input type="number" name="plant_phone" id="plant_phone"
                                                        maxlength="10" placeholder="Contact/Phone Number"
                                                        class="form-control"
                                                        value="<?php echo e($appData->plant_phone ?? old('plant_phone')); ?>">
                                                    <?php $__errorArgs = ['plant_phone'];
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
                                                <div class="col-md-6"><label for="email">Email:</label>
                                                    <input type="email" name="plant_email" id="plant_email"
                                                        class="form-control" placeholder="Email Address"
                                                        value="<?php echo e($appData->plant_email ?? old('plant_email')); ?>">
                                                    <?php $__errorArgs = ['plant_email'];
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
                                                    <label for="Longitude">Country:</label>
                                                    <select name="country" id="country">
                                                        <option value="">Select</option>
                                                        <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($country->countrycd); ?>" <?php if(!Empty($appData->
                                                            country) && $appData->country==$country->countrycd): ?> selected
                                                            <?php endif; ?> ><?php echo e($country->name); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                    <?php $__errorArgs = ['country'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <br> <br> <span
                                                        class="invalid-feedback custom_valid_class">
                                                        <?php echo e($message); ?> </span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                </div>
                                                <div class="col-md-12">
                                                    <!-- <div id="floating-panel">
                                                    <input id="latlng" type="text" value="40.714224,-73.961452">
                                                    <input id="submit" type="button" value="Get Address">
                                                    </div>
                                                    <div id="map"></div> -->
                                                </div>
                                            </div>

                                        </th>
                                    </tr>

                                    <!-- <tr>
                                        <th>6</th>
                                        <td width="30%"> <strong>Details of all Manufacturing Plant
                                                under same <br> Brand/Company name
                                                <small class="text-danger">*</small></strong> <br>
                                            <small> <i class="text-primary"><label for="phone">Provide details as per
                                                        annexure 6 </label></i>
                                            </small>
                                        </td>
                                        <td>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label for="">No. of Manufacturing plant in India:</label>
                                                    <input type="number" name="existing_plant_india"
                                                        id="existing_plant_india" min="0" class="form-control"
                                                        value="<?php echo e($appData->existing_plant_india ?? old('existing_plant_india')); ?>">
                                                    <?php $__errorArgs = ['existing_plant_india'];
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
                                                    <label for="">No. of Manufacturing plant out of
                                                        India:</label>
                                                    <input type="number" name="existing_plant_outindia"
                                                        id="existing_plant_outindia" min="0" class="form-control"
                                                        value="<?php echo e($appData->existing_plant_outindia ?? old('existing_plant_outindia')); ?>">
                                                    <?php $__errorArgs = ['existing_plant_outindia'];
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

                                        </td>

                                    </tr> -->
                                    <tr>
                                        <th>6</th>
                                        <td width="30%"> <strong>Contact Person <small class="text-danger">*</small>
                                            </strong> <br>
                                        </td>
                                        <td>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label for="">Name:</label>
                                                    <input type="text" name="contact_person_name"
                                                        id="contact_person_name" placeholder="Contact Person Name"
                                                        class="form-control"
                                                        value="<?php echo e($appData->contact_person_name ?? old('contact_person_name')); ?>">
                                                    <?php $__errorArgs = ['contact_person_name'];
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
                                                    <label for="">Designation:</label>
                                                    <input type="text" name="person_designation" id="person_designation"
                                                        placeholder="Designation" class="form-control"
                                                        value="<?php echo e($appData->person_designation ?? old('person_designation')); ?>">
                                                    <?php $__errorArgs = ['person_designation'];
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
                                                    <label for="">Phone No:</label>
                                                    <input type="number" name="person_contact_no" id="person_contact_no"
                                                        placeholder="Contact Number" class="form-control"
                                                        value="<?php echo e($appData->person_contact_no ?? old('person_contact_no')); ?>">
                                                    <?php $__errorArgs = ['person_contact_no'];
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
                                                    <label for="">E-mail:</label>
                                                    <input type="email" name="person_email" id="person_email"
                                                        placeholder="Contact Email" class="form-control"
                                                        value="<?php echo e($appData->person_email ?? old('person_email')); ?>">
                                                    <?php $__errorArgs = ['person_email'];
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
                                        </td>

                                    </tr>
                                    <tr>
                                        <th>7</th>
                                        <td width="30%"> <strong>Authorized signatory details <small
                                                    class="text-danger">*</small></strong> <br></td>
                                        <td>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label for="">Name:</label>
                                                    <input type="text" name="authorize_name" id="authorize_name"
                                                        maxlength="50" placeholder="Authorized Signatory Name"
                                                        class="form-control"
                                                        value="<?php echo e($appData->authorize_name ?? old('authorize_name')); ?>">
                                                    <?php $__errorArgs = ['authorize_name'];
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
                                                    <label for="">Designation:</label>
                                                    <input type="text" name="authorize_designation"
                                                        id="authorize_designation" maxlength="50"
                                                        placeholder="Designation" class="form-control"
                                                        value="<?php echo e($appData->authorize_designation ?? old('authorize_designation')); ?>">
                                                    <?php $__errorArgs = ['authorize_designation'];
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
                                                    <label for="">Authorization Letter: <small
                                                            class="text-primary">(Max. 1MB
                                                            and PDF Format
                                                            Only)</small></label>
                                                    <input type="file" name="authorize_letter" id="authorize_letter">
                                                    <?php if(!empty($appData->authorize_letter)): ?>
                                                    <br>
                                                    <input type="hidden" name="old_authorize_letter"
                                                        value="<?php echo e($appData->authorize_letter); ?>" id="">
                                                    <span><a target="_blank"
                                                            href="<?php echo e(URL::to($attcBaseUrl.$appData->authorize_letter)); ?>"
                                                            class="document text-primary">View
                                                            Authorized Document</a></span>
                                                    <?php endif; ?>
                                                    <?php $__errorArgs = ['authorize_letter'];
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
                                        </td>

                                    </tr>
                                    <tr>
                                        <th colspan="3">
                                            <input type="submit" name="submit"
                                                value="<?php if(isset($appData->id)): ?> Update <?php else: ?> Save <?php endif; ?>"
                                                class="btn btn-success" id="">
                                            <?php if(isset($appData->id)): ?>
                                            <a href="<?php echo e(URL::to('users/existing-application-step2/'.$appData->id)); ?>"
                                                class="btn btn-warning" style="float:right">Next <i
                                                    class='fa fa-arrow-right'></i></a>
                                            <a href="" class="btn btn-danger">Cancel <i class='fa fa-close'></i></a>
                                            <input type="hidden" name="edit_id" id="edit_id" value="<?php echo e($appData->id); ?>">

                                            <?php endif; ?>
                                            <input type="hidden" name="step1" id="step1"
                                                value="<?php echo e($appData->step1 ?? 0); ?>">

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

        right: 35px;
        font-size: 10px;
        color: #337ab7;
    }

    .document {
        margin-top: -8px;
        position: absolute;
        font-size: 10px !important;
    }
    </style>

    <?php $__env->stopSection(); ?>
    <?php $__env->startPush('backend-js'); ?>
    <script>
    $('#register_office_address').on('keyup', function(event) {
        var maxlength = 1000;
        var len = $(this).val().length;
        if (len >= maxlength) {
            $(this).val($(this).val().substring(-1, len - 1));
        }
        $('#reg_address_char').html((maxlength - len + " chars left"));
    });
    $('#com_address').on('keyup', function(event) {
        var maxlength = 1000;
        var len = $(this).val().length;
        if (len >= maxlength) {
            $(this).val($(this).val().substring(-1, len - 1));
        }
        $('#com_address_char').html((maxlength - len + " chars left"));
    });
    $('#plant_address').on('keyup', function(event) {
        var maxlength = 1000;
        var len = $(this).val().length;
        if (len >= maxlength) {
            $(this).val($(this).val().substring(-1, len - 1));
        }
        $('#plant_address_char').html((maxlength - len + " chars left"));
    });
    $(function() {
        $("#is_comm_add_same").click(function() {
            if ($('[type="checkbox"]').is(":checked")) {
                $('#com_address').val($('#register_office_address').val()).attr('readonly', 'readonly');
                $('#com_phone').val($('#register_office_phone').val()).attr('readonly', 'readonly');
                $('#com_email').val($('#register_office_email').val()).attr('readonly', 'readonly');
            } else {
                $('#com_address').val('').attr('placeholder',
                    'Communication Office Address of the Manufacturer').removeAttr('readonly',
                    'readonly');
                $('#com_phone').val('').attr('placeholder', 'Contact Number').removeAttr('readonly',
                    'readonly');
                $('#com_email').val('').attr('placeholder', 'Email Address').removeAttr('readonly',
                    'readonly');
            }
            //return false;
        })

    });
    </script>

    <?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.masters.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\almm\resources\views/backend/user/\existingmodel\newExistingApplication.blade.php ENDPATH**/ ?>