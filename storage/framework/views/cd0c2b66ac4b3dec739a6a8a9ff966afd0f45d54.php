
<?php $__env->startSection('content'); ?>
<?php $__env->startSection('title', 'Edit Profile'); ?>
<div class="row">
    <div class="col-md-12">
        <?php echo $__env->make('layouts.partials.backend._flash', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="box box-primary">
            <div class="box-body">
                <form action="<?php echo e(URL::to('/inspector/edit-profile')); ?>" id="editProfileForm" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="email"><?php echo e(__('Email')); ?> <span class="error">*</span></label>
                                <input type="email" class="form-control required" name="email" value="<?php echo e($user->email); ?>" disabled>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="user_id"><?php echo e(__('User ID')); ?> <span class="error">*</span></label>
                                <input type="text" class="form-control required" name="user_id" value="<?php echo e($user->inspector_id); ?>" disabled>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="user_id"><?php echo e(__('State')); ?> <span class="error">*</span></label>
                                <select class="form-control select2 required" name="state_id">
                                    <?php $__currentLoopData = $states; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $state): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($state->code); ?>" <?php if($state->code === $user->state_id): ?> selected <?php endif; ?>><?php echo e($state->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="name"><?php echo e(__('Name')); ?> <span class="error">*</span></label>
                                <input type="text" class="form-control required" name="name" value="<?php echo e($user->name); ?>">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="phone"><?php echo e(__('Phone')); ?> <span class="error">*</span></label>
                                <input type="text" class="form-control required required number" maxlength="10" minlength="10" name="phone" value="<?php echo e($user->phone); ?>">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="dob"><?php echo e(__('Date of Birth')); ?> <span class="error">*</span></label>
                                <input type="text" class="form-control required dob" name="dob" value="<?php echo e($user->dob); ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="cv"><?php echo e(__('Updated CV')); ?></label>
                                <input type="file" class="form-control" name="cv">
                            </div>
                        </div>
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
        $(".dob").datepicker({
            autoclose: true,
            format: "dd-mm-yyyy",
            orientation: "bottom",
            endDate: new Date()
        });
    });
</script>
<?php $__env->stopPush(); ?>


<?php echo $__env->make('layouts.masters.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\wamp64\www\ALMM\resources\views/backend/inspector/editProfile.blade.php ENDPATH**/ ?>