
<?php $__env->startSection('content'); ?>
<?php $__env->startSection('title', 'Edit Profile'); ?>
<div class="row">
    <div class="col-md-12">
        <?php echo $__env->make('layouts.partials.backend._flash', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="box box-primary">
            <div class="box-body">
                <form id="editProfileForm" action="<?php echo e(URL::to('/mnre/edit-profile')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="user_code"><?php echo e(__('User Code')); ?> <span class="error">*</span></label>
                                <input type="text" class="form-control" name="user_code" value="<?php echo e($user->user_code); ?>" disabled>
                                <?php $__errorArgs = ['user_code'];
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
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email"><?php echo e(__('Email')); ?> <span class="error">*</span></label>
                                <input type="email" class="form-control" name="email" value="<?php echo e($user->email); ?>" disabled>
                                <?php $__errorArgs = ['email'];
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
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name"><?php echo e(__('Name')); ?> <span class="error">*</span></label>
                        <input type="text" class="form-control" name="name" value="<?php echo e($user->name); ?>">
                        <?php $__errorArgs = ['name'];
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
                    <p>If you want to change your password <a href="<?php echo e(URL::to('/'.Auth::getDefaultDriver().'/change-password')); ?>">Click Here</a></p>
                    <input type="submit" class="mt-1 btn btn-primary" value="Submit">
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('backend-js'); ?>
<script>
    $(function(){
        $('#editProfileForm').validate();
    });
</script>
<?php $__env->stopPush(); ?>



<?php echo $__env->make('layouts.masters.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\wamp64\www\ALMM\resources\views/backend/mnre/editProfile.blade.php ENDPATH**/ ?>