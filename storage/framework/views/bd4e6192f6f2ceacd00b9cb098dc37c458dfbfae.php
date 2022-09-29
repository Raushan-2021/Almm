
<?php $__env->startSection('content'); ?>
<?php $__env->startSection('title', 'Applications list'); ?>
<div class="box box-primary">
    <div class="box-body">
        <div class="row">
            <div class="col-md-12">
                <!-- <a href="<?php echo e(URL::to('mnre/create-mnre-user')); ?>" class="btn btn-info">
                    <span class="btn-icon-wrapper pr-2 opacity-7"><i class="fa fa-plus-circle fa-w-20"></i></span> ADD
                    USER
                </a> -->
            </div>
            <div class="col-md-12">
              <?php echo $__env->make('layouts.partials.backend._flash', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <table id="stakeHoldersTable" class="table table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th width="10%">SNo.</th>
                            <th>Application No</th>
                            <th>Type</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Submitted Date</th>
                            <th>Forward Status</th>
                            <th width="15%">Action</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $applications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $application): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <!--$user -> MainController->mnreUsers->compact se liya h  -->
                        <tr>
                            <td><?php echo e($key + 1); ?></td>
                            <td><?php echo e($application->application_no); ?></td>
                            <td>
                               <?php if($application->application_type==1): ?>
                                 New Application
                                <?php elseif($application->application_type==2): ?>
                                PV Model Addition at
                                the existing manufacturing facility
                                <?php elseif($application->application_type==3): ?>
                                 Application for new
                                manufacturing facility
                                <?php elseif($application->application_type==4): ?>
                                 Renewal
                                <?php elseif($application->application_type==5): ?>
                                 Co-ALMM
                                <?php endif; ?>
                            </td>
                            <td><?php echo e($application->manufacturer_name); ?></td>
                            <td> <?php if($application->status==1): ?> Activate <?php else: ?> InActivate <?php endif; ?></td>
                            <td><?php echo e(date("d, M Y",strtotime($application->updated_at))); ?></td>
                            
                            <td> <?php if($application->forward_status=='mnre'): ?> Not Forwarded <?php elseif($application->forward_status=='reject'): ?> Rejected <?php elseif($application->forward_status=='nise'): ?> Forwarded to NISE <?php endif; ?></td>
                            <td>
                                
                                
                                <a href="<?php echo e(url('mnre/view-application/'.base64_encode($application->id))); ?>"
                                    class="btn btn-xs btn-primary-hallow">View</a> | <a href="<?php echo e(url('mnre/track-detail/'.base64_encode($application->id))); ?>"
                                    class="btn btn-xs btn-primary-hallow">Track</a>
                            </td>

                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
                <div class="pull-right"><?php echo e($applications->links('pagination::bootstrap-4')); ?></div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.masters.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\wamp64\www\ALMM\resources\views/backend/mnre/applications-list.blade.php ENDPATH**/ ?>