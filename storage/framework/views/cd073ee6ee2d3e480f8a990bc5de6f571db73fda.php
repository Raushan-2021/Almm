
<?php $__env->startSection('title', 'Dashboard'); ?>
<?php $__env->startSection('content'); ?>
      <div class="row">
        <div class="col-lg-12">
          <div class="row">

            
            <div class="col-xxl-3 col-md-6 col-sm-6 col-12 pb-4">
              <div class="col-xxl-12 report_summary blk1">
                <p class="icon"><i class="fa-solid fa-users"></i></p>
                <p class="name">Manufacturers</p>
                <p class="num"><?php echo e($users); ?></p>
              </div>
            </div>

           
            <div class="col-xxl-3 col-md-6 col-sm-6 col-12 pb-4">
              <div class="col-xxl-12 report_summary blk2">
                <p class="icon"><i class="fa-solid fa-file-lines"></i> </p>
                <p class="name">Application in MNRE</p>
                <p class="num">0</p>
              </div>
            </div>

            
            <div class="col-xxl-3 col-md-6 col-sm-6 col-12 pb-4">
              <div class="col-xxl-12 report_summary blk3">
                <p class="icon"><i class="fa-solid fa-file-export"></i></p>
                <p class="name">Application forwarded  to NISE</p>
                <p class="num">0</p>
              </div>
             

            </div>
            <div class="col-xxl-3 col-md-6 col-sm-6 col-12 pb-4">
              <div class="col-xxl-12 report_summary blk4">
                <p class="icon"><i class="fa-solid fa-file-circle-exclamation"></i></p>
                <p class="name">Pending MNRE</p>
                <p class="num"> 0</p>
              </div>
            </div>

           
            <div class="col-xxl-3 col-md-6 col-sm-6 col-12 pb-4">
              <div class="col-xxl-12 report_summary blk5">
                <p class="icon"><i class="fa-solid fa-file-import"></i></p>
                <p class="name">Returned  Correction</p>
                <p class="num">0</p>
              </div>
            </div>

            
            <div class="col-xxl-3 col-md-6 col-sm-6 col-12 pb-4">
              <div class="col-xxl-12 report_summary blk6">
                <p class="icon"><i class="fa-solid fa-file-signature"></i></p>
                <p class="name">Pending verification NISE</p>
                <p class="num">0</p>
              </div>
             

            </div>
            <div class="col-xxl-3 col-md-6 col-sm-6 col-12 pb-4">
              <div class="col-xxl-12 report_summary blk7">
                <p class="icon"><i class="fa-solid fa-file-contract"></i></p>
                <p class="name">Inspection  fixed</p>
                <p class="num">0</p>
              </div>
             

            </div>
            <div class="col-xxl-3 col-md-6 col-sm-6 col-12 pb-4">
              <div class="col-xxl-12 report_summary blk8">
                <p class="icon"><i class="fa-solid fa-file-circle-check"></i></p>
                <p class="name">Inspection  completed</p>
                <p class="num">0</p>
              </div>
             

            </div>
            <div class="col-xxl-3 col-md-6 col-sm-6 col-12 pb-4">
              <div class="col-xxl-12 report_summary blk9">
                <p class="icon"><i class="fa-solid fa-file-pen"></i></p>
                <p class="name">Pending for inspection</p>
                <p class="num">0</p>
              </div>
             

            </div>
            <div class="col-xxl-3 col-md-6 col-sm-6 col-12 pb-4">
              <div class="col-xxl-12 report_summary blk10">
                <p class="icon"><i class="fa-solid fa-file-invoice"></i></p>
                <p class="name">Report Pending  NISE</p>
                <p class="num">0</p>
              </div>
             

            </div>
            

          </div>
        </div>
 
      </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.masters.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xamp\htdocs\ALMM\resources\views/backend/mnre/dashboard.blade.php ENDPATH**/ ?>