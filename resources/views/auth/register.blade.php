@extends('frontend.includes.master')
@section('title')
ALMM | Register
@endsection()
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}" />
<section class="signup_sectn">
<div class="container pt-5 pb-5 animatedParent">
  <div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8 signup_blk animated fadeInDownShort go">
      <div class="heading">Sign Up Here</div>
      <form method="POST" action="{{ url('register-user') }}">
        @csrf
      <div class="row signupforms">
        <div class="col-md-6 col-sm-12 error_cls"> 
        <input type="text" name="name" value="{{ old('name') }}" class="form-control form-control-lg @error('name') is-invalid @enderror" placeholder="Full name*">
        @error('name') <span class="text-danger valid_class" role="alert" style="padding-top: 3px; padding-left: 10px;">{{ $message }}</span> @enderror
        </div> 
        <div class="col-md-6 col-sm-12 error_cls">
         <input type="email" class="form-control form-control-lg @error('email') form-control-lg is-invalid @enderror" name="email" value="{{ old('email') }}"  placeholder="Email">
          @error('email') <span class="invalid-feedback valid_class" role="alert"> {{ $message }} </span> @enderror
        </div>

        <div class="col-md-6 col-sm-12 error_cls">
        <input type="text" name="pan" class="form-control form-control-lg @error('pan') is-invalid @enderror" value="{{ old('pan') }}" placeholder="PAN*">
        @error('pan') <span class="invalid-feedback valid_class"> {{ $message }} </span> @enderror   
        </div> 

        <div class="col-md-6 col-sm-12 error_cls">
        <input type="text" name="gst" class="form-control form-control-lg @error('gst') is-invalid @enderror" value="{{ old('gst') }}" placeholder="GST*">
            @error('gst') <span class="invalid-feedback valid_class"> {{ $message }} </span> @enderror 
        </div>

        <div class="col-md-12 error_cls"> 
         <input type="text" name="phone" class="form-control form-control-lg @error('phone') is-invalid @enderror" value="{{ old('phone') }}" placeholder="Mobile">
         @error('phone') <span class="invalid-feedback valid_class"> {{ $message }} </span> @enderror
        </div> 
        <div class="col-md-12 error_cls_txtbox">
            <textarea name="address" id="address" class="form-control form-control-lg" cols="30" rows="3"
                        placeholder="Complete address">{{ old('address') }}</textarea>
            @error('address') <div class="text-danger" style="padding-top: 3px;padding-left: 10px;"> {{ $message }}</div> @enderror
          </div>

        <div class="col-md-6 col-sm-12 error_cls">
            <select name="country_id" id="country_id" class="form-control form-control-lg">
                        <option value="">Select Country</option>
                        @foreach($countries as $country)
                        <option value="{{$country->countrycd}}">{{$country->name}}</option>
                        @endforeach
                    </select>
          @error('country_id') <span class="invalid-feedback valid_class" role="alert"> {{ $message }} </span> @enderror
        </div> 
        <div class="col-md-6 col-sm-12 error_cls state">
            <select name="state_id" id="state_id" class="form-control form-control-lg">
                        <option value="">Select State</option>
                         @foreach($state as $state)
                        <option value="{{$state->code}}">{{$state->name}}</option>
                        @endforeach
            </select>
            @error('district_id') <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span> @enderror
          </div>
        <div class="col-md-6 col-sm-12 error_cls district"> 
           <select name="district_id" id="district_id" class="form-control form-control-lg">
            <option value="">Select District</option>
            </select>
           @error('district_id') <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span> @enderror
          </div> 
        <div class="col-md-6 col-sm-12 error_cls"> 
             <input type="number" name="pincode" id="pincode" class="form-control form-control-lg @error('pincode') is-invalid @enderror pincode" value="{{ old('pincode') }}" maxlength="6" placeholder="Pincode">
                        @error('pincode') <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span> @enderror
        </div>

        <div class="clearfix"></div>
                @if(!env('DEV_ENVIRONMENT'))
                  <div class="col-md-6 col-sm-12 error_cls">
                    <div class="captcha login-captcha col-sm-12">
                        <?php echo captcha_img('flat'); ?>
                        <i id="refresh-captcha" class="fa fa-refresh pull-right captcha-refresh" aria-hidden="true"></i>
                        <div class="clearfix"></div>
                        <input type="text" id="captcha-input" class="form-control required" name="captcha"
                            placeholder="Captcha">
                    </div>
                </div>
                @else
                <span class="req fs12">Application is in DEV MODE, captcha disabled</span>
                @endif
                <div class="clearfix"></div>

        <div class="col-md-12 d-grid text-center">
          
          
            <button type="submit" class="btn btn-success btn-lg btn-block mb-3">REGISTER</button><br>
        <span><a href="{{ route('login')}}"  style="text-decoration: none;"><strong class="text-success">I already have a membership</strong></a></span>
            <span><a class="text-secondary" href="{{route('reset.password')}}">Forgot Password?</a></span>
          
        </div>
      </div>
  </form>
    </div>
    <div class="col-md-2"></div>
  </div>
</div>

</section>

@endsection
@section('scripts')
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
url:"{{ url('get_distictbystate') }}",
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
@endsection
@section('styles')
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
@endsection

