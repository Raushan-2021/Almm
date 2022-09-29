
<?php $__env->startSection('content'); ?>
<?php $__env->startSection('title', 'Track Application : '.$applications->application_no); ?>
<style type="text/css">
.events li {
    display: flex;
    color: #999;
}

.events time {
    position: relative;
    padding: 0 1.5em;
}

.events time::after {
    content: "";
    position: absolute;
    z-index: 2;
    right: 0;
    top: 0;
    transform: translateX(50%);
    border-radius: 50%;
    background: #fff;
    border: 1px #ccc solid;
    width: .8em;
    height: .8em;
}


.events span {
    padding: 0 1.5em 1.5em 1.5em;
    position: relative;
}

.events span::before {
    content: "";
    position: absolute;
    z-index: 1;
    left: 0;
    height: 100%;
    border-left: 1px #ccc solid;
}

.events strong {
    display: block;
    font-weight: bolder;
}

.events {
    margin: 1em;
    width: 50%;
}

.events,
.events *::before,
.events *::after {
    box-sizing: border-box;
    font-family: arial;
}

</style>
<div class="box box-primary">
    <div class="box-body">
        <div class="row">
            <div class="col-md-3"></div>

            <div class="col-md-9">


                <ul class="events">

                    <?php $__currentLoopData = $trackDetail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $trackDetail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li>
                        <time datetime=""><?php echo e(date("d, M Y",strtotime($trackDetail->created_at))); ?></time>
                        <span><strong><?php echo e($trackDetail->action); ?></strong><?php echo e($trackDetail->description); ?></span>
                    </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <li>
                        <time datetime=""><?php echo e(date("d, M Y",strtotime($applications->created_at))); ?></time>
                        <span><strong>Application has been submitted successfully</strong></span>
                    </li>

                </ul>


            </div>
        </div>
        <a href="<?php echo e(url('/login')); ?>" class="btn btn-warning">Back</a>
    </div>

</div>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.masters.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\wamp64\www\ALMM\resources\views/backend/common/track-detail.blade.php ENDPATH**/ ?>