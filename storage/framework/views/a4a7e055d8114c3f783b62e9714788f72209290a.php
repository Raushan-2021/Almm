
<?php $__env->startSection('title', 'Annexure 4 '); ?>
<?php $__env->startSection('content'); ?>
<?php $docBaseUrl ='users/preview-docs/Certificate/';
?>
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
                            <form action="<?php echo e(URL::to('/users/annexure-four-five')); ?>" method="POST"
                                enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('POST'); ?>
                                <table class="table table-bordered" id="show_data"
                                    style="display:<?php if($annexuredata!=null): ?>  <?php else: ?> none <?php endif; ?>">
                                    <tr>
                                        <th>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label for="">ISO Certificate Title</label>
                                                    <input type="text" name="iso_certificate"
                                                        placeholder="Enter ISO Certificate Title" id="iso_certificate"
                                                        class="form-control" maxlength="70"
                                                        value="<?php echo e($annexuredata->iso_certificate ?? ''); ?>">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="">ISO Certificate <small> <i>( PDF format
                                                                Only)</i></small></label>
                                                    <input type="file" name="iso_certificate_doc"
                                                        id="iso_certificate_doc" class="form-control">
                                                    <?php if(!empty($annexuredata->iso_certificate_doc)): ?>
                                                    <input type="hidden" name="old_iso_certificate_doc"
                                                        value="<?php echo e($annexuredata->iso_certificate_doc); ?>" id="">
                                                    <small><a target="_blank"
                                                            href="<?php echo e(URL::to($docBaseUrl.$annexuredata->iso_certificate_doc)); ?>"
                                                            class="document">View
                                                            Certificate</a></small>
                                                    <?php endif; ?>
                                                </div>

                                                <div class="col-md-12">
                                                    <label for="">Issuing Agency with Address</label>
                                                    <textarea name="issuing_agency" id="issuing_agency" cols="30"
                                                        rows="5"
                                                        class="form-control"><?php echo e($annexuredata->issuing_agency ?? ''); ?></textarea>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="">Issuing Date</label>
                                                    <input type="date" name="issuing_date"
                                                        placeholder="Rated Manufacturing Capacity" id="issuing_date"
                                                        class="form-control" maxlength="70"
                                                        value="<?php echo e($annexuredata->issuing_date ?? ''); ?>">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="">Certificate Valid Upto</label>
                                                    <input type="date" name="certificate_validate"
                                                        placeholder="Rated Manufacturing Capacity"
                                                        id="certificate_validate" class="form-control" maxlength="70"
                                                        value="<?php echo e($annexuredata->certificate_validate ?? ''); ?>">
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
                                            <a href="<?php echo e(URL::to('users/annexure-one-c/'.$application_id)); ?>"
                                                class="btn btn-danger"> Cancel </a>

                                        </td>
                                    </tr>
                                </table>


                            </form>
                            <table class="table table-bordered">
                                <thead>
                                    <tr class="bg-warning">
                                        <th>5.5</th>
                                        <th scope="col" colspan="13" class="text-left">ISO Certification Details for the
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
                                        <th>Certificate Document</th>
                                        <th width="10%"></th>

                                    </tr>
                                    <?php $__currentLoopData = $appData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($loop->iteration); ?></td>
                                        <td><?php echo e($data->iso_certificate); ?></td>
                                        <td><?php echo e($data->issuing_agency); ?></td>
                                        <td><?php echo e($data->issuing_date); ?></td>
                                        <td><?php echo e($data->certificate_validate); ?></td>
                                        <td><?php if(!empty($data->iso_certificate_doc)): ?>
                                            <small><a target="_blank"
                                                    href="<?php echo e(URL::to($docBaseUrl.$data->iso_certificate_doc)); ?>"
                                                    class="document">View
                                                    Certificate</a></small>
                                            <?php endif; ?>
                                        </td>
                                        <td><a
                                                href="<?php echo e(URL::to('users/annexure-four-five/'.$data->application_id.'/'.$data->id)); ?>">Edit
                                                <i class="fa fa-edit"></i></a>
                                            <a href="<?php echo e(URL::to('users/delete-annexure/4/'.$data->id)); ?>"
                                                onCLick="if (confirm('Are you sure to delete?')) { }else{ return false;}"
                                                class="text-danger">Delete <i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                </tbody>
                                <tr>
                                    <th colspan="13">
                                        <?php if(!$appData->isEmpty()): ?>

                                        <a href="<?php echo e(URL::to('users/annexure-five/'.$application_id)); ?>"
                                            class="btn btn-warning" style="float:right">Next <i
                                                class="fa fa-arrow-right"></i></a>
                                        <?php endif; ?>
                                        <a href="<?php echo e(URL::to('users/annexure-four-four/'.$application_id)); ?>"
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

<?php echo $__env->make('layouts.masters.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\almm\resources\views/backend/user/form/annexureFour/annexureFour5.blade.php ENDPATH**/ ?>