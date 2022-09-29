@extends('layouts.masters.backend')
@section('content')
@section('title', 'Edit Profile')
<div class="row">
    <div class="col-md-12">
        @include('layouts.partials.backend._flash')
        <div class="box box-primary">
            <div class="box-body">
                <form action="{{URL::to('/inspector/edit-profile')}}" id="editProfileForm" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="email">{{ __('Email') }} <span class="error">*</span></label>
                                <input type="email" class="form-control required" name="email" value="{{$user->email}}" disabled>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="user_id">{{ __('User ID') }} <span class="error">*</span></label>
                                <input type="text" class="form-control required" name="user_id" value="{{$user->inspector_id}}" disabled>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="user_id">{{ __('State') }} <span class="error">*</span></label>
                                <select class="form-control select2 required" name="state_id">
                                    @foreach ($states as $state)
                                        <option value="{{$state->code}}" @if($state->code === $user->state_id) selected @endif>{{$state->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="name">{{ __('Name') }} <span class="error">*</span></label>
                                <input type="text" class="form-control required" name="name" value="{{$user->name}}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="phone">{{ __('Phone') }} <span class="error">*</span></label>
                                <input type="text" class="form-control required required number" maxlength="10" minlength="10" name="phone" value="{{$user->phone}}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="dob">{{ __('Date of Birth') }} <span class="error">*</span></label>
                                <input type="text" class="form-control required dob" name="dob" value="{{$user->dob}}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="cv">{{ __('Updated CV') }}</label>
                                <input type="file" class="form-control" name="cv">
                            </div>
                        </div>
                    </div>
                    <p>If you want to change your password <a href="{{URL::to('/'.Auth::getDefaultDriver().'/change-password')}}">Click Here</a></p>
                    <input type="submit" class="mt-1 btn btn-primary" value="Submit">
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@push('backend-js')
<script>
    $(function(){
        $('#editProfileForm').validate();
        $(".dob").datepicker({
            autoclose: true,
            format: "dd-mm-yyyy",
            orientation: "bottom",
            endDate: new Date()
        });
    });
</script>
@endpush

