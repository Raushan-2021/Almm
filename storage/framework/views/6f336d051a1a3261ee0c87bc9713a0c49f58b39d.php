<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link " href="<?php echo e(URL::to('/login')); ?>">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li class="nav-heading">Pages</li>

        <!--MNRE USERS SECTION START--->
        <?php if(Auth::guard('mnre')->check()): ?>
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-people"></i><span>Users</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="#">
                        <i class="bi bi-circle"></i><span>NISE Users</span>
                    </a>
                </li>
                <!-- <li>
                    <a href="<?php echo e(URL::to('/'.Auth::getDefaultDriver().'/mnre-user-list')); ?>">
                        <i class="bi bi-circle"></i><span>MNRE Users</span>
                    </a>
                </li> -->
                <li>
                    <a href="<?php echo e(URL::to('/'.Auth::getDefaultDriver().'/manufaturer-user-list')); ?>">
                        <i class="bi bi-circle"></i><span>Manufacturer</span>
                    </a>
                </li>

            </ul>
        </li>



        <li class="nav-item">
            <a class="nav-link collapsed" href="<?php echo e(URL::to('/'.Auth::getDefaultDriver().'/manufaturer-user-list')); ?>">
                <i class="bi bi-boxes"></i>
                <span>Manufacturers</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="<?php echo e(URL::to('/'.Auth::getDefaultDriver().'/applications-list')); ?>">
                <i class="bi bi-file-earmark-text"></i>
                <span>Applications</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="#">
                <i class="bi bi-clipboard2-check"></i>
                <span>Inspections</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="#">
                <i class="bi bi-clipboard2-check"></i>
                <span>Payment</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-file-earmark-bar-graph-fill"></i><span>Reports</span><i
                    class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="<?php echo e(URL::to('/'.Auth::getDefaultDriver().'/applications-list')); ?>">
                        <i class="bi bi-circle"></i><span>Applications</span>
                    </a>
                </li>

                <li><a href="#"><i class="fa fa-user-plus"></i>Quality Check Manufacturer</a></li>
                <li><a href="#"><i class="bi bi-circle"></i>Generate Approved Lists</a></li>
                <li><a href="#"><i class="bi bi-circle"></i>Renewals</a></li>
                <li><a href="#"><i class="bi bi-circle"></i>Uploads</a></li>
                <li><a href="#"><i class="bi bi-circle"></i>Help Documents</a></li>
                <li><a href="#"><i class="bi bi-circle"></i>Annexures</a></li>
                <li><a href="#"><i class="bi bi-circle"></i>Fee details</a></li>
                <li><a href="#"><i class="bi bi-circle"></i>Approved lists I & II</a></li>
            </ul>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="<?php echo e(URL::to('/'.Auth::getDefaultDriver().'/audit-trail')); ?>">
                <i class="bi bi-clipboard2-check"></i>
                <span>Audit Trails</span>
            </a>
        </li>

        <?php endif; ?>

        <?php if(Auth::guard('nise')->check()): ?>
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-people"></i><span>Users</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <!-- <li>
                    <a href="#">
                        <i class="bi bi-circle"></i><span>NISE Users</span>
                    </a>
                </li> -->

                <li>
                    <a href="<?php echo e(URL::to('/'.Auth::getDefaultDriver().'/manufaturer-user-list')); ?>">
                        <i class="bi bi-circle"></i><span>Manufacturer Users</span>
                    </a>
                </li>

            </ul>
        </li>



        <li class="nav-item">
            <a class="nav-link collapsed" href="<?php echo e(URL::to('/'.Auth::getDefaultDriver().'/applications-list')); ?>">
                <i class="bi bi-boxes"></i>
                <span>Submitted Applications</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="#">
                <i class="bi bi-file-earmark-text"></i>
                <span>Submitted Inspections</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="#">
                <i class="bi bi-clipboard2-check"></i>
                <span>Track Records</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="#">
                <i class="bi bi-clipboard2-check"></i>
                <span>Payment</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-file-earmark-bar-graph-fill"></i><span>Reports</span><i
                    class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="#">
                        <i class="bi bi-circle"></i><span>Application & Inspections</span>
                    </a>
                </li>
                <li><a href="#"><i class="bi bi-circle"></i>Quality Check Manufacturer</a></li>
                <li><a href="#"><i class="bi bi-circle"></i>Generate Approved Lists</a></li>
                <li><a href="#"><i class="bi bi-circle"></i>Renewals</a></li>
            </ul>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-file-earmark-bar-graph-fill"></i><span>Uploads</span><i
                    class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li><a href="#"><i class="bi bi-circle"></i>Help Documents</a></li>
                <li><a href="#"><i class="bi bi-circle"></i>Annexures</a></li>
                <li><a href="#"><i class="bi bi-circle"></i>Fee details</a></li>
                <li><a href="#"><i class="bi bi-circle"></i>Approved lists I & II</a></li>
                <li><a href="#"><i class="bi bi-circle"></i>Bank Details</a></li>
                <li><a href="#"><i class="bi bi-circle"></i>About Programme</a></li>
            </ul>
        </li>

        <?php endif; ?>

        <!--NISE USERS SECTION END--->

        <!--MNRE USERS SECTION START--->

        <?php if(Auth::guard('manufaturer_users')->check()): ?>

        <li class="nav-item">
            <a class="nav-link collapsed" href="<?php echo e(URL::to('/users/module-master')); ?>">
                <i class="bi bi-boxes"></i>
                <span>Module Maste</span>
            </a>
        </li>



        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-file-earmark-bar-graph-fill"></i><span>Application</span><i
                    class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li><a href="<?php echo e(URL::to('/users/user-applications')); ?>"><i class="bi bi-circle"></i>My
                        Application</a></li>
                <li><a href="<?php echo e(URL::to('/users/new-application')); ?>"><i class="bi bi-circle"></i>New
                        Application</a></li>
                <li><a href="javascript:;" class="text-gray"><i class="bi bi-circle"></i>PV
                        Model addition at the existing<br> manufacturing
                        facility</a>
                </li>
                <li><a href="javascript:;" class="text-gray"><i class="bi bi-circle"></i>Application for new
                        manufacturing<br> facility</a></li>
                <li><a href="javascript:;" class="text-gray"><i class="bi bi-circle"></i>Renewal</a></li>
                <li><a href="javascript:;" class="text-gray"><i class="bi bi-circle"></i>Co–ALMM</a></li>
            </ul>
        </li>

        <?php endif; ?>



        <?php if(Auth::guard('mnre')->check() || Auth::guard('manufaturer_users')->check()): ?>
        <li class="nav-item">
            <a class="nav-link collapsed" href="<?php echo e(URL::to('/'.Auth::getDefaultDriver().'/system-maintenance')); ?>">
                <i class="bi bi-indent"></i>
                <span>Operation maintenance</span>
            </a>
        </li>
        <li>
            <?php endif; ?>

            <!--MNRE USERS SECTION END--->

    </ul>
    <a href="https://www.nic.in/"><img class="nicLogo" src="<?php echo e(URL::asset('images/footerNIC.png')); ?>" width="100%"></a>
</aside>
<?php /**PATH D:\wamp64\www\ALMM\resources\views/layouts/partials/backend/_sidebar.blade.php ENDPATH**/ ?>