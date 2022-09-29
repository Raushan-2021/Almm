<script type="text/javascript" src="<?php echo e(asset('public/js/jquery.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('public/js/bootstrap.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('public/js/jquery.dataTables.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('public/js/dataTables.bootstrap.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('public/js/jquery.validate.min.js')); ?>"></script>
<script src="http://jqueryvalidation.org/files/dist/additional-methods.min.js"></script>
<script type="text/javascript" src="<?php echo e(asset('public/js/password-validation.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('public/js/select2.full.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('public/js/bootstrap-datepicker.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('public/js/adminlte.min.js')); ?>"></script>
<script type="text/javascript">
var baseUrl = {
    !!json_encode(url('/')) !!
}
var validator = '';
</script>
<script type="text/javascript" src="<?php echo e(asset('public/js/common.js')); ?>"></script>
<?php echo $__env->yieldPushContent('backend-js'); ?>
<?php /**PATH D:\wamp64\www\ALMM\resources\views/layouts/partials/backend/_scripts.blade.php ENDPATH**/ ?>