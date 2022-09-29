@extends('frontend.includes.master')
@section('title')
ALMM | Home
@endsection()
@section('styles')
@endsection()
@section('content')
<section class="signup_sectn">
<div class="container pt-5 pb-5">
  <div class="row pt-5 pb-5 animatedParent">
    <div class="col-md-4 col-sm-3"></div>
    <div class="col-md-4 col-sm-6  signup_blk animated fadeInDownShort go">
      <div class="heading">Forgot Password</div>
      <div class="row signupforms">
        @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
        @endif
        @if(session()->has('error'))
        <div class="alert alert-danger">
            {{ session()->get('error') }}
        </div>
        @endif
        <form method="POST" action="{{URL::to('reset-user-password')}}">
            @csrf
        <div class="col-md-12 col-sm-12 login_error_cls">
          <select name="user_type" class="form-control required" required id="user_type" onChange="hide_phone()">
                    <option selected="" disabled="">Select User Type</option>
                    <option value="MNRE">MNRE</option>
                    <option value="MANUFATURER">MANUFATURER</option>
                </select>
        </div> 
        <div class="col-md-12 col-sm-12 login_error_cls">
          <label for="email">Email</label>
          <input type="email" id="email" class="form-control form-control-lg required" required placeholder="Login email" name="email"
                    autocomplete="off" autofocus="">
        </div>
         
        <div class="col-md-12 d-grid text-center">
            <button type="submit" class="btn btn-success btn-lg btn-block mb-3">CHANGE PASSWORD</button><br>
            <p><span><a href="{{url('login')}}"  style="text-decoration: none;"><strong class="text-success">Login</strong></a></span> | <span><a href="{{url('register-user')}}"  style="text-decoration: none;"><strong class="text-success">sign in</strong></a></span></p>
        </div>
    </form>
      </div>
    </div>
    <div class="col-md-4 col-sm-3"></div>
  </div>
</div>

</section>
<script>
function hide_phone() {
    $('#phone_div').show();
    var utype = $("#user_type option:selected").text();
    if (utype == 'MNRE') {
        $('#phone_div').hide();
    }
}
</script>
@endsection()