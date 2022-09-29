
<?php $__env->startSection('title', 'New Application'); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
    <?php echo $__env->make('layouts.partials.backend._stepper_application', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="col-md-12">
        <?php echo $__env->make('layouts.partials.backend._flash', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="box box-primary">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="box-header with-border">
                            Final Submission

                        </div>
                        <div class="box-body">
                            <form action="<?php echo e(URL::to('/users/application-submission')); ?>" method="POST"
                                enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('POST'); ?>
                                <table class="table table-bordered" id="show_data" style="">

                                    <tr>
                                        <th>
                                            <div class="row">

                                                <div class="col-md-6 col-md-offset-3">
                                                    <p style="color:blue"><i>Please download the Application
                                                            and
                                                            upload duly signed
                                                            copy (<a
                                                                href="<?php echo e(URL::to('/users/download-application/'.$application_id)); ?>"
                                                                class="text-danger">Click
                                                                Here to Download Application</a>)</i></p>
                                                </div>
                                                <div style="clear:both"></div>
                                                <div class="col-md-6 col-md-offset-3">
                                                    <label for="">Upload Application <small class="text-primary">(File
                                                            should be in PDF Format and
                                                            Max. 10 MB)</small></label>
                                                    <input type="file" name="signatory_document" class="form-control">
                                                    <?php $__errorArgs = ['signatory_document'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="valid_class">
                                                        <?php echo e($message); ?> </span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                                                    <input type="checkbox" name="declaration" id="declaration"
                                                        value="1">
                                                    <i>I authorize that entered information in proposal are correct and
                                                        verified(<a href="javascript:void(0)" data-toggle="modal"
                                                            data-target="#exampleModalCenter">Terms and
                                                            Conditions</a></i>)
                                                    <?php $__errorArgs = ['declaration'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="valid_class">
                                                        <?php echo e($message); ?> </span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>



                                                </div>
                                                <div style="clear:both"></div>
                                                <div class="col-md-6 col-md-offset-3"><br>
                                                    <input type="submit" name="submit" value="Final Submission"
                                                        class="btn btn-success" id="">
                                                    <a href="<?php echo e(URL::to('users/annexure-attachment/'.$application_id)); ?>"
                                                        class="btn btn-primary" style="float:right"><i
                                                            class="fa fa-arrow-left"></i>
                                                        Back </a>
                                                    <br>


                                                    <input type="hidden" name="edit_id" id="edit_id"
                                                        value="<?php echo e($application_id); ?>">
                                                    <input type="hidden" name="application_id" id="application_id"
                                                        value="<?php echo e($application_id); ?>">



                                                </div>

                                            </div>


                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
                                                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h3 class="modal-title" id="exampleModalLongTitle">
                                                                Declaration</h3>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <span
                                                                style="font-weight: 400;color: #0d0da2;font-style: italic;">I
                                                                do hereby
                                                                declare that all information and
                                                                documents are provided in complete manner. I confirm
                                                                that all the
                                                                information provided in the ‘Application Form’ and in
                                                                the other
                                                                documents is true, complete and correct. I agree that in
                                                                the event
                                                                of any particular information given being found false or
                                                                incorrect
                                                                or any discrepancy at any point of time, our application
                                                                is liable
                                                                to be rejected or cancelled or liable to be terminated
                                                                and the Solar
                                                                Photovoltaic (PV) Module Model shall be removed from the
                                                                List, if
                                                                enlisted, without any prior notice by MNRE. I
                                                                unconditionally agree
                                                                to comply with all the requirements, terms and
                                                                conditions stipulated
                                                                by MNRE. I also undertake to provide to MNRE, even after
                                                                enlistment,
                                                                any additional information, that is subsequently added
                                                                to this
                                                                Standard Application Format, by MNRE or any other
                                                                agency/
                                                                organisations, authorised by MNRE to do so.</span>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Close</button>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
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
    .valid_class {
        color: #e73434;
        font-weight: 100;
        font-family: arial;
        font-size: 11px;
        display: block;
    }

    </style>
    <?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.masters.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\almm\resources\views/backend/user/form/finalSubmission.blade.php ENDPATH**/ ?>