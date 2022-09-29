<div class="col-lg-12 mt-3">
    <div class="steps">
        <progress id="progress" value=<?php echo e($progressBar['progress']); ?> max=100></progress>
        <div class="step-item" style="text-align:left;">
            <button class="step-button text-center" type="button"
                onclick="window.location='/users/new-application/<?php echo e($progressBar["application_id"]); ?>'"
                aria-expanded="<?php echo e($progressBar['step1']); ?>" aria-controls="collapseOne">
                1
            </button>
            <div class="step-title">
                Manufacturer Details
            </div>
        </div>
        <div class="step-item">
            <button class="step-button text-center collapsed" type="button"
                onclick="window.location='/users/new-application-step2/<?php echo e($progressBar["application_id"]); ?>'"
                aria-expanded="<?php echo e($progressBar['step2']); ?>" aria-controls="collapseTwo">
                2
            </button>
            <div class="step-title">
                Details of Payment
            </div>
        </div>
        <div class="step-item">
            <button class="step-button text-center collapsed" type="button"
                onclick="window.location='/users/annexure-one/<?php echo e($progressBar["application_id"]); ?>'"
                aria-expanded="<?php echo e($progressBar['annexure8']); ?>" aria-controls="collapseTwo">
                3
            </button>
            <div class="step-title">
                Annexure's
            </div>
        </div>
        <div class="step-item">
            <button class="step-button text-center collapsed" type="button"
                onclick="window.location='/users/annexure-three/<?php echo e($progressBar["application_id"]); ?>'"
                aria-expanded="<?php echo e($progressBar['attachment']); ?>" aria-controls="collapseThree">
                4
            </button>
            <div class="step-title">
                Attachment's
            </div>
        </div>
        <div class="step-item">
            <button class="step-button text-center collapsed" type="button"
                onclick="window.location='/users/annexure-attachment/<?php echo e($progressBar["application_id"]); ?>'"
                aria-expanded="<?php echo e($progressBar['annexure4']); ?>" aria-controls="collapseThree">
                5
            </button>
            <div class="step-title">
                Final Submission
            </div>
        </div>


    </div>
</div>
<style>
:root {
    --prm-color: #0381ff;
    --prm-gray: #b1b1b1;
}

.steps {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 2rem;
    position: relative;
}

.step-button {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    border: none;
    background-color: var(--prm-gray);
    transition: .4s;
}

.step-button[aria-expanded="true"] {
    width: 30px;
    height: 30px;
    background-color: var(--prm-color);
    color: #fff;
}

.done {
    background-color: var(--prm-color);
    color: #fff;
}

.step-item {
    z-index: 10;
    text-align: center;
}

#progress {
    -webkit-appearance: none;
    position: absolute;
    width: 95%;
    z-index: 5;
    height: 10px;
    margin-left: 18px;
    margin-bottom: 18px;
}

/* to customize progress bar */
#progress::-webkit-progress-value {
    background-color: var(--prm-color);
    transition: .5s ease;
}

#progress::-webkit-progress-bar {
    background-color: var(--prm-gray);

}

</style>
<?php /**PATH D:\xamp\htdocs\ALMM\resources\views/layouts/partials/backend/_stepper_application.blade.php ENDPATH**/ ?>