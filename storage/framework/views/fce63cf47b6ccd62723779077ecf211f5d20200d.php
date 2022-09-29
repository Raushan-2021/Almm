
<?php $__env->startSection('title', 'User Applications'); ?>
<?php $__env->startSection('content'); ?>
<!-- Small boxes (Stat box) -->
<div class="box box-primary">
    <div class="box-body">
        <div class="row">
            <div class="col-md-12">
                <!-- <button class="btn btn-sm btn-info pull-right mt-25" type="submit">Filter</button> -->
                <table id="stakeHoldersTable" class="table table-bordered" style="width:100%">
                    <thead>
                        <tr class="bg-warning">
                            <th width="5%">S.No</th>
                            <th width="10%">Application No</th>
                            <th width="13%">Application Type</th>

                            <th width="13%">Manufacturer Name</th>
                            <th width="20%">Address</th>
                            <th>Submitted on</th>
                            <th width="15%">Inspection Status</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $applications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $application): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($loop->iteration); ?></td>
                            <td><?php if($application->application_no ==''): ?>--- <?php else: ?> <?php echo e($application->application_no); ?> <?php endif; ?>
                            </td>
                            <td>
                                <?php
                                $url='view-application';
                                if($application->application_type=='2'){
                                $url='existing-application';
                                }
                                ?>
                                <?php
                                $url='view-application';
                                if($application->application_type=='3'){
                                $url='existing-application-step2';
                                }
                                ?>
                                <?php
                                $url='view-application';
                                if($application->application_type=='4'){
                                $url='existing-annexure-one';
                                }
                                ?>
                                <?php if($application->application_type=='1'): ?>
                                New Application
                                <?php elseif($application->application_type=='2'): ?>
                                Model Addition
                                <?php elseif($application->application_type=='3'): ?>
                                Update
                                <?php elseif($application->application_type=='4'): ?>
                                Delete
                                <?php elseif($application->application_type=='5'): ?>
                                List
                                <?php else: ?>
                                Download
                                <?php endif; ?>
                            </td>
                            <td><?php echo e($application->manufacturer_name); ?></td>
                            <td><?php echo e($application->register_office_address); ?></td>

                            <td><?php echo e($application->updated_at); ?></td>
                            <td><?php if(!empty($application->inspectionData)): ?>

                                <?php $__currentLoopData = $application->inspectionData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $incData): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <strong class="text-success">Inspection Scheduled</strong><br>
                                Date : <?php echo e(date("d-M-Y",strtotime($incData['inspection_date']))); ?> <br>
                                Remark : <?php echo e($incData['remark']); ?>

                                <?php if($incData['change_request'] == 1): ?>
                                <hr>
                                Requested for New Date<br>
                                New Proposed Date : <strong
                                    class="text-danger"><?php echo e(date("d-M-Y",strtotime($incData['proposed_date']))); ?></strong><br>
                                Remark : <?php echo e($incData['request_remark']); ?>

                                <?php endif; ?>
                                <?php if($incData['change_request'] == 0): ?>
                                <br><a href="javascript:;" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal<?php echo e($incData['id']); ?>" class="text-primary">Request for
                                    Change</a>
                                <div class="modal fade" id="exampleModal<?php echo e($incData['id']); ?>" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">

                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Request for
                                                    Re-Schedule
                                                    Inscpection Date</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <span class="text-success" id="msg<?php echo e($incData['id']); ?>"></span>
                                                <span class="text-danger" id="err<?php echo e($incData['id']); ?>"></span>
                                                <table class="table">
                                                    <tr>
                                                        <th>Last Inspection Date</th>
                                                        <td class="text-danger">
                                                            <?php echo e(date("d-M-Y",strtotime($incData['inspection_date']))); ?>

                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>New Proposed Date</th>
                                                        <td><input type="date" class="form-control" name="proposed_date"
                                                                id="proposed_date<?php echo e($incData['id']); ?>"></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Mention Reason</th>
                                                        <td><textarea name="request_remark"
                                                                id="request_remark<?php echo e($incData['id']); ?>" cols="30"
                                                                rows="3"></textarea></td>
                                                    </tr>
                                                </table>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-primary "
                                                    onclick="requestSave(<?php echo e($incData['id']); ?>)">Submit</button>
                                                <input type="hidden" name="" value="<?php echo e($incData['inspection_date']); ?>"
                                                    id="last_inspection_date<?php echo e($incData['id']); ?>">
                                                <input type="hidden" name="" value="<?php echo e($application->id); ?>"
                                                    id="application<?php echo e($incData['id']); ?>">
                                                <button type="button" class="btn btn-danger"
                                                    data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                Pending
                                <?php endif; ?>
                            </td>
                            <td> <?php if($application->forward_status=='mnre'): ?> Not Forwarded
                                <?php elseif($application->forward_status=='reject'): ?> Rejected
                                <?php elseif($application->forward_status=='nise'): ?> Forwarded to NISE <?php endif; ?></td>

                            <td><?php if($application->final_submission == '0'): ?>
                                <a href="<?php echo e(url('users/'.$url.'/'.$application->id)); ?>"><i class="fa fa-edit"></i></a>
                                <?php else: ?>
                                <a href="<?php echo e(url('users/'.$url.'/'.base64_encode($application->id))); ?>">View</a> |
                                <a href="<?php echo e(url('users/track-detail/'.base64_encode($application->id))); ?>">Track</a>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- /.row -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
<script type="text/javascript">
function requestSave(id) {

    //e.preventDefault();

    let proposed_date = $('#proposed_date' + id).val();
    let request_remark = $('#request_remark' + id).val();
    let application_id = $('#application' + id).val();


    if (proposed_date == '') {
        $('#err' + id).html('Please select schedule date');
        return false;
    }
    if (request_remark == '') {
        $('#err' + id).html('Please enter remark');
        return false;
    }

    if (Date.parse(proposed_date) < Date.parse($("#last_inspection_date" + id).val())) {
        alert('Schedule date should be greater than last inspection date');
        return false;
    }
    $.ajax({
        url: "<?php echo e(url('users/changeScheduleDate')); ?>",
        type: "POST",
        data: {
            "_token": "<?php echo e(csrf_token()); ?>",
            id: id,
            proposed_date: proposed_date,
            request_remark: request_remark,
            application_id: application_id
        },
        success: function(response) {
            //console.log(response);
            $('#err' + id).html('');
            if (response) {
                $('#msg' + id).html(response.success);
                //alert(response.success);
                setTimeout(() => {
                    window.location.href = '/users/user-applications';
                }, 1500);
                //$('#success-message').text(response.success);  
            }
        },
        error: function(response) {
            alert(response.error);
            //$('#name-error').text(response.responseJSON.errors.name);
        }

    });
};
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.masters.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\almm\resources\views/backend/user/userApplications.blade.php ENDPATH**/ ?>