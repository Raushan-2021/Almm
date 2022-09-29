
<?php $__env->startSection('title', 'Module Master'); ?>
<?php $__env->startSection('content'); ?>

<div class="row">
    <div class="col-md-12">
        <?php echo $__env->make('layouts.partials.backend._flash', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="box box-primary">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">

                        <div class="box-header with-border">
                            <a class="btn btn-success btn-sm" href="<?php echo e(URL::to('/users/module-master/add')); ?>"><i
                                    class="fa fa-plus"></i> Add</a>
                        </div>

                        <div class="box-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr class="bg-warning">
                                        <th width="7%">S.No</th>
                                        <th width="24%">Type of Modules</th>
                                        <th width="24%">Main Model</th>
                                        <th width="8%"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $moduleData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($loop->iteration); ?></td>
                                        <td><?php echo e($data->module_type); ?></td>
                                        <td><?php echo e($data->main_model); ?></td>
                                        <td>
                                            <a href="javascript:;"> <i class="fa fa-pencil"></i>Edit</a> |
                                            <a href="javascript:;" class="text-danger"> <i
                                                    class="fa fa-trash"></i>Delete</a>
                                        </td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
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


    <?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.masters.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\almm\resources\views/backend/user/Module/viewModule.blade.php ENDPATH**/ ?>