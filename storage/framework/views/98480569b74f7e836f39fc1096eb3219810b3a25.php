
<?php $__env->startSection('title', 'Change Password'); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-md-12">
        <?php echo $__env->make('layouts.partials.backend._flash', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="box box-primary">
            <div class="box-body">
                <form action="<?php echo e($submitUrl); ?>" id="changePasswordForm" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="form-group">
                        <label for="current_password"><?php echo e(__('Current Password')); ?></label>
                        <input type="password" class="form-control" name="current_password" autocomplete="off">
                        <?php $__errorArgs = ['current_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="invalid-feedback" role="alert">
                                <strong><?php echo e($message); ?></strong>
                            </span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="form-group">
                        <label for="new_password"><?php echo e(__('New Password')); ?></label>
                        <input type="password" data-placement="bottom" data-toggle="popover" data-trigger="focus" data-html="true" data-content='<div id="errors"></div>' class="form-control required passwordStrength" minlength="6" id="new_password" name="new_password" autocomplete="off">
                        <?php $__errorArgs = ['new_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="invalid-feedback" role="alert">
                                <strong><?php echo e($message); ?></strong>
                            </span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="form-group">
                        <label for="new_password_confirmation"><?php echo e(__('Confirm Password')); ?></label>
                        <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation" autocomplete="off">
                        <?php $__errorArgs = ['new_password_confirmation'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="invalid-feedback" role="alert">
                                <strong><?php echo e($message); ?></strong>
                            </span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <input type="submit" class="mt-1 btn btn-primary" value="Submit">
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('backend-js'); ?>
<script type="text/javascript">
    $(function(){
        $('#changePasswordForm').validate();
        $("#new_password_confirmation").rules('add', {
            equalTo: "#new_password",
            messages: {
                equalTo: "Not matched with password."
            }
        });
    });
</script>
<?php $__env->stopPush(); ?>



<?php echo $__env->make('layouts.masters.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\wamp64\www\ALMM\resources\views/backend/common/changePassword.blade.php ENDPATH**/ ?>