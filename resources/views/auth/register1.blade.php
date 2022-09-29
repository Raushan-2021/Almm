@extends('layouts.masters.home')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}" />

<div class="register-box text-center container-fluid">
    <h1>ALMM</h1>

    <div class="register-box-body">
        <!-- <p class="login-box-msg">Register a new membership</p> -->
        <form method="POST" action="{{ url('register-user') }}">
            @csrf
            <div class="row">
                <div class="form-group has-feedback col-md-6">
                    <input type="text" name="name" value="{{ old('name') }}"
                        class="form-control @error('name') is-invalid @enderror" placeholder="Full name*">
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    @error('name') <span class="invalid-feedback  valid_class" role="alert">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group has-feedback col-md-6">
                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                        value="{{ old('email') }}" placeholder="Email">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    @error('email') <span class="invalid-feedback valid_class" role="alert"> {{ $message }} </span>
                    @enderror
                </div>
                <div class="form-group has-feedback col-md-6">
                    <input type="text" name="pan" class="form-control @error('pan') is-invalid @enderror"
                        value="{{ old('pan') }}" placeholder="PAN">
                    @error('pan') <span class="invalid-feedback valid_class"> {{ $message }} </span> @enderror
                </div>
                <div class="form-group has-feedback col-md-6">
                    <input type="text" name="gst" class="form-control @error('gst') is-invalid @enderror"
                        value="{{ old('gst') }}" placeholder="GST">
                    @error('gst') <span class="invalid-feedback valid_class"> {{ $message }} </span> @enderror
                </div>
                <div class="form-group has-feedback col-md-6">
                    <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror"
                        value="{{ old('phone') }}" class="form-control" placeholder="Contact">
                    @error('phone') <span class="invalid-feedback valid_class"> {{ $message }} </span> @enderror
                </div>

                <div class="form-group has-feedback col-md-12">
                    <textarea name="address" id="address" class="form-control" cols="30" rows="3"
                        placeholder="Complete address">{{ old('address') }}</textarea>
                    @error('address') <span class="invalid-feedback valid_class" role="alert"> {{ $message }} </span>
                    @enderror
                </div>
                <div class="form-group has-feedback col-md-6">
                    <select name="country_id" id="country_id" class="form-control">
                        <option value="">Select Country</option>
                        @foreach($countries as $country)
                        <option value="{{$country->countrycd}}">{{$country->name}}</option>
                        @endforeach
                    </select>
                    @error('country_id') <span class="invalid-feedback valid_class" role="alert"> {{ $message }} </span>
                    @enderror
                </div>

                <div class="form-group has-feedback col-md-6  state">
                    <select name="state_id" id="state_id" class="form-control">
                        <option value="">Select State</option>
                        @foreach($state as $state)
                        <option value="{{$state->code}}">{{$state->name}}</option>
                        @endforeach
                    </select>
                    @error('district_id') <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong>
                    </span> @enderror
                </div>
                <div class="form-group has-feedback col-md-6  district">
                    <select name="district_id" id="district_id" class="form-control">
                        <option value="">Select District</option>
                    </select>
                    @error('district_id') <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong>
                    </span> @enderror
                </div>
                <div class="form-group has-feedback col-md-6">
                    <input type="number" name="pincode" id="pincode"
                        class="form-control @error('pincode') is-invalid @enderror pincode" value="{{ old('pincode') }}"
                        maxlength="6" class="form-control" placeholder="Pincode">
                    @error('pincode') <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong>
                    </span> @enderror
                </div>
                <div class="clearfix"></div>
                @if(!env('DEV_ENVIRONMENT'))
                <div class="col-sm-12 p-0">
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

            </div>

            <div class="row">
                <div class="col-xs-12">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
                </div>
            </div>
        </form>

        <a href="{{ route('login')}}" class="text-center">I already have a membership</a>
    </div>
</div>
@endsection
@section('scripts')
<script>
$(function() {
    $('.state').hide();
    $('.district').hide();
    $('#formLogin').validate();
    $('#refresh-captcha').click(function() {
        let captcha_array = $('.captcha > img').attr('src').split('?');
        let new_captcha = captcha_array[0] + '?' + makeid(8);
        $('.captcha > img').attr('src', new_captcha);
    });
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

})
</script>

<script>
$(document).ready(function() {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    //$('.state-group,.ministry-group,.department-group,.organization-group,.state-dept-group').hide();

    $('#state_id').on('change', function(e) {
        $('.district').hide();
        var state_id = $(this).val();
        $.ajax({
            url: "{{ url('get_distictbystate') }}",
            type: "POST",
            data: {
                state_id: state_id
            },
            success: function(data) {
                if (data != '') {
                    $('.district').slideDown();
                    $('#district_id').empty();
                    $("#district_id").append('<option value="">---Select---</option>');
                    $.each(data, function(key, value) {
                        $("#district_id").append('<option value="' + value.code +
                            '">' + value.name + '</option>');
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

.valid_class {
    margin-top: -16px;
    display: block;
    text-align: center;
    color: red;
}

</style>
@endsection
