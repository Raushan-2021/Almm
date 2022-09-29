@extends('frontend.includes.master')
@section('title')
ALMM | Login
@endsection()
@section('content')
<section class="signup_sectn">
    <div class="container pt-5 pb-5">
        <div class="row pt-5 pb-5 animatedParent">
            <div class="col-md-4 col-sm-3">

            </div>
            <div class="col-md-4 col-sm-6  signup_blk animated fadeInDownShort go">
                <div class="heading">Login Here</div>
                <div class="row signupforms">
                    @if (session('status'))
                    <div class="alert alert-success">
                        <strong>Success!</strong> {{ session('status') }}
                    </div>
                    <br>
                    @endif

                    <form id="formLogin" action="{{ route('login') }}" method="POST" autocomplete="off">
                        {{ csrf_field() }}
                        <div class="col-md-12 col-sm-12 login_error_cls">
                            <label for="email">User Name <span class="text-danger">*</span></label>
                            <input type="email" id="email" class="form-control  form-control-lg"
                                placeholder="Login email" name="email" autocomplete="off" autofocus>
                            <!-- <div class="text-danger" style="padding-top: 3px; padding-left: 10px;">error msg sample</div> -->
                        </div>
                        <div class="col-md-12 col-sm-12 login_error_cls">
                            <label for="email">Password <span class="text-danger">*</span></label>
                            <input type="password" id="password" class="form-control form-control-lg"
                                placeholder="Enter Password" name="password" autocomplete="off">
                        </div>
                        <label for="email">User Type <span class="text-danger">*</span></label>
                        <div class="col-md-12 col-sm-12 login_error_cls">
                            <select name="user_type" class="form-control form-control-lg required mb-15" id="user_type">
                                <option value="">Select User Type</option>
                                <option value="MNRE">MNRE</option>
                                <option value="NISE">NISE</option>
                                <option value="MANUFATURER">MANUFATURER</option>
                            </select>
                        </div>



                        @if(!env('DEV_ENVIRONMENT'))
                        <div class="col-md-12 col-sm-12 login_error_cls">
                            <div class="captcha login-captcha col-sm-12">
                                <?php echo captcha_img('flat'); ?>
                                <i id="refresh-captcha" class="fa fa-refresh pull-right captcha-refresh"
                                    aria-hidden="true"></i>
                                <div class="clearfix"></div>
                                <input type="text" id="captcha-input" class="form-control required" name="captcha"
                                    placeholder="Captcha">
                            </div>
                        </div>
                        @else
                        <span class="req fs12">Application is in DEV MODE, captcha disabled</span>
                        @endif
                        <div class="clearfix"></div>
                        <div>
                            @if(count($errors))
                            <div class="alert alert-danger alert-validations text-center">
                                @foreach ($errors->all() as $error)
                                <span class="fs12">{{ $error }}</span><br>
                                @endforeach
                            </div>
                            @endif
                        </div>

                        <div class="col-md-12 d-grid text-center">


                            <button type="submit" class="btn btn-success btn-lg btn-block mb-3">LOGIN</button><br>
                            <span><a href="{{url('register-user')}}" style="text-decoration: none;"><strong
                                        class="text-success">REGISTER</strong></a></span>
                            <span><a href="{{route('reset.password')}}" class="text-secondary" href="">Forgot
                                    Password?</a></span>

                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-4 col-sm-3"></div>
        </div>
    </div>

</section>
@endsection
@section('scripts')
<script>
$(function() {
    $('#formLogin').validate();
    $('#refresh-captcha').click(function() {
        let captcha_array = $('.captcha > img').attr('src').split('?');
        let new_captcha = captcha_array[0] + '?' + makeid(8);
        $('.captcha > img').attr('src', new_captcha);
    });
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
        checkboxClass: 'icheckbox_minimal-blue',
        radioClass: 'iradio_minimal-blue'
    });
})
</script>
@endsection
@section('styles')
<style>
label.error {
    bottom: initial;
    right: 0px;
    top: 35px;
}

</style>
@endsection
