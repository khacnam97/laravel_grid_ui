@extends('layouts.app')
@section('title', __('user.Create User') )
@section('content')
    <form method="POST" action="{{route('user.postCreate')}}">
        @csrf
        <div class="form-group row">
            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('user.User name') }}</label>

            <div class="col-md-6">
                <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" autocomplete="username" autofocus>

                @include('errors.alert_error', ['name'=> 'username'])
            </div>
        </div>

        <div class="form-group row">
            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('user.Full Name') }}</label>

            <div class="col-md-6">
                <input id="full_name" type="text" class="form-control @error('full_name') is-invalid @enderror" name="full_name" value="{{ old('full_name') }}" autocomplete="full_name" autofocus>

                @include('errors.alert_error', ['name'=> 'full_name'])
            </div>
        </div>

        <div class="form-group row">
            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('user.Phone Number') }}</label>

            <div class="col-md-6">
                <input id="phone_number" type="text" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" value="{{ old('phone_number') }}" autocomplete="phone_number" autofocus>

                @include('errors.alert_error', ['name'=> 'phone_number'])
            </div>
        </div>

        <div class="form-group row">
            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('user.Center Name') }}</label>

            <div class="col-md-6">
                <input id="center_name" type="text" class="form-control @error('center_name') is-invalid @enderror" name="center_name" value="{{ old('center_name') }}" autocomplete="center_name" autofocus>

                @include('errors.alert_error', ['name'=> 'center_name'])
            </div>
        </div>

        <div class="form-group row">
            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('user.Password') }}</label>

            <div class="col-md-6">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" value="{{ old('password') }}" name="password" autocomplete="new-password">

                @include('errors.alert_error', ['name'=> 'password'])
            </div>
        </div>
        <div class="form-group row">
            <label for="role" class="col-md-4 col-form-label text-md-right">{{ __('user.Role') }}</label>
            <div class="col-md-6">
                <select id="role_id" class="form-control select2bs4 @error('role_id') is-invalid @enderror" style="width: 100%;" name="role_id">
                    @foreach($roles as $role)
                        <option value="{{$role->id}}" {{ old('role_id') == $role->id ? 'selected="selected"' : '' }}>{{ $role->name === 'admin' ? __('user.Admin') : __('user.DistributionCenter') }}</option>
                    @endforeach
                </select>
                @include('errors.alert_error', ['name'=> 'role_id'])
            </div>
        </div>
        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    {{ __('common.Create') }}
                </button>
            </div>
        </div>
    </form>
@endsection
