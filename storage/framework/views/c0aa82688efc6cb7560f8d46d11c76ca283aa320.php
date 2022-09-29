
<?php $__env->startSection('title'); ?>
ALMM | Register
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />
<section class="signup_sectn">
<div class="container pt-5 pb-5 animatedParent">
  <div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8 signup_blk animated fadeInDownShort go">
      <div class="heading">Sign Up Here</div>
      <form method="POST" action="<?php echo e(url('register-user')); ?>">
        <?php echo csrf_field(); ?>
      <div class="row signupforms">
        <div class="col-md-6 col-sm-12 error_cls"> 
        <input type="text" name="name" value="<?php echo e(old('name')); ?>" class="form-control form-control-lg <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Full name*">
        <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-danger valid_class" role="alert" style="padding-top: 3px; padding-left: 10px;"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div> 
        <div class="col-md-6 col-sm-12 error_cls">
         <input type="email" class="form-control form-control-lg <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> form-control-lg is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="email" value="<?php echo e(old('email')); ?>"  placeholder="Email">
          <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="invalid-feedback valid_class" role="alert"> <?php echo e($message); ?> </span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div class="col-md-6 col-sm-12 error_cls">
        <input type="text" name="pan" class="form-control form-control-lg <?php $__errorArgs = ['pan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('pan')); ?>" placeholder="PAN*">
        <?php $__errorArgs = ['pan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="invalid-feedback valid_class"> <?php echo e($message); ?> </span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>   
        </div> 

        <div class="col-md-6 col-sm-12 error_cls">
        <input type="text" name="gst" class="form-control form-control-lg <?php $__errorArgs = ['gst'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('gst')); ?>" placeholder="GST*">
            <?php $__errorArgs = ['gst'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="invalid-feedback valid_class"> <?php echo e($message); ?> </span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> 
        </div>

        <div class="col-md-12 error_cls"> 
         <input type="text" name="phone" class="form-control form-control-lg <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('phone')); ?>" placeholder="Mobile">
         <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="invalid-feedback valid_class"> <?php echo e($message); ?> </span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div> 
        <div class="col-md-12 error_cls_txtbox">
            <textarea name="address" id="address" class="form-control form-control-lg" cols="30" rows="3"
                        placeholder="Complete address"><?php echo e(old('address')); ?></textarea>
            <?php $__errorArgs = ['address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="text-danger" style="padding-top: 3px;padding-left: 10px;"> <?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
          </div>

        <div class="col-md-6 col-sm-12 error_cls">
            <select name="country_id" id="country_id" class="form-control form-control-lg">
                        <option value="">Select Country</option>
                        <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($country->countrycd); ?>"><?php echo e($country->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
          <?php $__errorArgs = ['country_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="invalid-feedback valid_class" role="alert"> <?php echo e($message); ?> </span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div> 
        <div class="col-md-6 col-sm-12 error_cls state">
            <select name="state_id" id="state_id" class="form-control form-control-lg">
                        <option value="">Select State</option>
                         <?php $__currentLoopData = $state; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $state): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($state->code); ?>"><?php echo e($state->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <?php $__errorArgs = ['district_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="invalid-feedback" role="alert"> <strong><?php echo e($message); ?></strong> </span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
          </div>
        <div class="col-md-6 col-sm-12 error_cls district"> 
           <select name="district_id" id="district_id" class="form-control form-control-lg">
            <option value="">Select District</option>
            </select>
           <?php $__errorArgs = ['district_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="invalid-feedback" role="alert"> <strong><?php echo e($message); ?></strong> </span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
          </div> 
        <div class="col-md-6 col-sm-12 error_cls"> 
             <input type="number" name="pincode" id="pincode" class="form-control form-control-lg <?php $__errorArgs = ['pincode'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> pincode" value="<?php echo e(old('pincode')); ?>" maxlength="6" placeholder="Pincode">
                        <?php $__errorArgs = ['pincode'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="invalid-feedback" role="alert"> <strong><?php echo e($message); ?></strong> </span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div class="clearfix"></div>
                <?php if(!env('DEV_ENVIRONMENT')): ?>
                  <div class="col-md-6 col-sm-12 error_cls">
                    <div class="captcha login-captcha col-sm-12">
                        <?php echo captcha_img('flat'); ?>
                        <i id="refresh-captcha" class="fa fa-refresh pull-right captcha-refresh" aria-hidden="true"></i>
                        <div class="clearfix"></div>
                        <input type="text" id="captcha-input" class="form-control required" name="captcha"
                            placeholder="Captcha">
                    </div>
                </div>
                <?php else: ?>
                <span class="req fs12">Application is in DEV MODE, captcha disabled</span>
                <?php endif; ?>
                <div class="clearfix"></div>

        <div class="col-md-12 d-grid text-center">
          
          
            <button type="submit" class="btn btn-success btn-lg btn-block mb-3">REGISTER</button><br>
        <span><a href="<?php echo e(route('login')); ?>"  style="text-decoration: none;"><strong class="text-success">I already have a membership</strong></a></span>
            <span><a class="text-secondary" href="<?php echo e(route('reset.password')); ?>">Forgot Password?</a></span>
          
        </div>
      </div>
  </form>
    </div>
    <div class="col-md-2"></div>
  </div>
</div>

</section>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<script>
$(function() {
    $('.state').hide();
    $('.district').hide();
    $("#country_id").change(function() {
        $('#pincode').attr("placeholder", "Pincode");
        if ($('#country_id :selected').val() == 99) {
             $('.state').show();
             $('.district').show();
        } else {
            $('.state').hide();
            $('.district').hide();
            $('#pincode').attr("placeholder", "Sipcode");
        }
    });

    $('#formLogin').validate();
    $('#refresh-captcha').click(function() {
        let captcha_array = $('.captcha > img').attr('src').split('?');
        let new_captcha = captcha_array[0] + '?' + makeid(8);
        $('.captcha > img').attr('src', new_captcha);
    });

})
</script>

<script>
    $(document).ready(function(){

    $.ajaxSetup({
    headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
//$('.state-group,.ministry-group,.department-group,.organization-group,.state-dept-group').hide();
 
$('#state_id').on('change',function(e) {
  // $('.district').hide();
  var state_id = $(this).val();
$.ajax({
url:"<?php echo e(url('get_distictbystate')); ?>",
type:"POST",
data: {
state_id: state_id
},
success:function (data) {
   if(data!= ''){
  $('.district').slideDown();
$('#district_id').empty();
$("#district_id").append('<option value="">---District---</option>');
$.each(data,function(key,value){
  $("#district_id").append('<option value="'+value.code+'">'+value.name+'</option>');
});

}
}
})
});



  });
</script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('styles'); ?>
<style>
label.error {
    bottom: initial;
    right: 0px;
    top: 35px;
}
.valid_class{
        margin-top: -16px;
    display: block;
    text-align: center;
    color: red;
}

</style>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('frontend.includes.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\almm\resources\views/auth/register.blade.php ENDPATH**/ ?>