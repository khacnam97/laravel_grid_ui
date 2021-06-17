@extends('layouts.app')
@section('title', __('user.Create User') )
@section('content')
    <form method="POST" action="{{route('message.send')}}">
        @csrf
        <div class="form-group row">
            <label for="name" class="col-md-4 col-form-label text-md-right">message</label>

            <div class="col-md-6">
                <input id="message" type="text" class="form-control @error('message') is-invalid @enderror" name="message" value="{{ old('message') }}" autocomplete="message" autofocus>
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
