
<?php $__env->startSection('title', 'Annexure 6 ::Details of all Manufacturing Plant under same Brand/Company name'); ?>
<?php $__env->startSection('content'); ?>
<?php $docBaseUrl ='users/preview-docs/Annexure/';
?>
<div class="row">
    <?php echo $__env->make('layouts.partials.backend._stepper', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="col-md-12">

        <?php echo $__env->make('layouts.partials.backend._flash', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="box box-primary">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">


                        <div class="box-body">

                            <form action="<?php echo e(URL::to('/users/annexure-seven')); ?>" method="POST"
                                enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('POST'); ?>
                                <table class="table table-bordered" id="show_data" style="">
                                    <?php if($appData->id!=null): ?>
                                    <input type="hidden" name="id" value="<?php echo e($appData->id); ?>">
                                    <?php endif; ?>
                                    <tr>
                                        <th>
                                            <div class="row">
                                                <div class="col-md-6 col-md-offset-3">
                                                    <label for="">Upload Annexure 7 <small class="text-primary">(File
                                                            should be in PDF Format and
                                                            Max. 10 MB)</small></label>
                                                    <input type="file" name="annexure7" class="form-control">
                                                    <?php if(isset($appData) && $appData->annexure7!=null): ?>
                                                    <i style="display: inline-block;float: right;"><a
                                                            href="<?php echo e(URL::to($docBaseUrl.$appData->annexure7)); ?>"
                                                            style="margin-top: -8px;display: block;"
                                                            target="_blank">View
                                                            uploaded Annexure</a></i>
                                                    <?php endif; ?>
                                                    <?php $__errorArgs = ['annexure7'];
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
                                                <div style="clear:both"></div>
                                                <div class="col-md-6 col-md-offset-3"><br>
                                                    <input type="submit" name="submit"
                                                        value="<?php if(isset($appData->id) && $appData->annexure7!=null): ?>Update <?php else: ?> Upload <?php endif; ?>"
                                                        class="btn btn-success" id=""><br>
                                                    <small style="color:blue"><i>Please download the annexure form 7
                                                            and
                                                            upload duly signed
                                                            copy (<a
                                                                href="<?php echo e(URL::asset('public/downloadables/Annexure7.pdf')); ?>"
                                                                download class="text-danger">Click
                                                                Here to Download Annexure 7 Form</a>)</i></small>

                                                    <input type="hidden" name="edit_id" id="edit_id"
                                                        value="<?php if(isset($appData->id)): ?><?php echo e($appData->id); ?><?php endif; ?>">
                                                    <input type="hidden" name="application_id" id="application_id"
                                                        value="<?php echo e($application_id); ?>">



                                                </div>

                                            </div>
                                        </th>
                                    </tr>
                                </table>


                            </form>
                            <table class="table table-bordered">
                                <tr>
                                    <th colspan="13">
                                        <?php if($appData->annexure7!=null): ?>

                                        <a href="<?php echo e(URL::to('users/annexure-eight/'.$application_id)); ?>"
                                            class="btn btn-warning" style="float:right">Next <i
                                                class="fa fa-arrow-right"></i></a>
                                        <?php endif; ?>
                                        <a href="<?php echo e(URL::to('users/annexure-six/'.$application_id)); ?>"
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

<?php echo $__env->make('layouts.masters.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\wamp64\www\ALMM\resources\views/backend/user/form/annexureSeven/annexureSeven.blade.php ENDPATH**/ ?>