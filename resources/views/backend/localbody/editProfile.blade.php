@extends('layouts.masters.backend')
@section('content')
@section('title', 'Edit Profile')
<div class="row">
    <div class="col-md-12">
        @include('layouts.partials.backend._flash')
        <div class="box box-primary">
            <div class="box-body">
                <form action="{{URL::to('/localbody/edit-profile')}}" id="editProfileForm" method="POST">
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
                                <input type="text" class="form-control required" name="user_id" value="{{$user->user_id}}" disabled>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="user_id">{{ __('State') }} <span class="error">*</span></label>
                                <select class="form-control required" name="state_id">
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
                                <input type="text" class="form-control required number" maxlength="10" minlength="10" name="phone" value="{{$user->phone}}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="contact_person">{{ __('Contact Person') }} <span class="error">*</span></label>
                                <input type="text" class="form-control required" name="contact_person" value="{{$user->contact_person}}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="user_id">{{ __('Nodal') }} <span class="error">*</span></label>
                                <select class="form-control required" name="nodal">
                                    <option value="0" @if($user->nodal === 0) selected @endif>No</option>
                                    <option value="1" @if($user->nodal === 1) selected @endif>Yes</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="agency_type">{{ __('Agency Type') }} <span class="error">*</span></label>
                                <input type="text" class="form-control required" name="agency_type" value="{{$user->agency_type}}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="superior_agency">{{ __('Superior Agency') }} <span class="error">*</span></label>
                                <input type="text" class="form-control required" name="superior_agency" value="{{$user->superior_agency}}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="address">{{ __('Address') }} <span class="error">*</span></label>
                        <input type="text" class="form-control required" name="address" value="{{$user->address}}">
                    </div>
                    <div class="form-group">
                        <label for="short_info">{{ __('Short Information') }}</label>
                        <textarea class="form-control" name="short_info" cols="30" rows="4">{{$user->short_info}}</textarea>
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
    });
</script>
@endpush




