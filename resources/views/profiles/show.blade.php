@extends('adminlte::page')
@section('title', 'User')
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>User</h2>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-3"><strong>Username:</strong></div>
    <div class="col-sm-9"> {{ $profile->username }}</div>
</div>
<div class="row">
    <div class="col-sm-3"><strong>MobileNo:</strong></div>
    <div class="col-sm-9"> {{ $profile->number }}
    </div>
</div>
<div class="row">
    <div class="col-sm-3"><strong>Password:</strong></div>
    <div class="col-sm-9">  {{ $profile->password }}</div>
</div>
<div class="row">
    <div class="col-sm-3"><strong>Email:</strong></div>
    <div class="col-sm-9">  {{ $profile->email }}</div>
</div>
<div class="row">
    <div class="col-sm-3"><strong>Image:</strong></div>
    <div class="col-sm-9"> <img src = "{{ asset('image/'.$profile->image) }}"></div>
</div>
<div class="pull-right">
    <a class="btn btn-warning" href="{{ route('users.index') }}">Back</a>
</div>
@endsection

@section('css')
<link href="{{ asset('profile/profile.css') }}" rel="stylesheet">
@stop
