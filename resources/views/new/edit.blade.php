@extends('adminlte::page')
@section('content')
<div class="row">
  <div class="col-lg-12 margin-tb">
      <div class="pull-left">
          <h2>Edit User</h2>
      </div>
  </div>
</div>
@if(Session::has('success'))
<div class="alert alert-success">
  {{ Session::get('success') }}
  @php
  Session::forget('success');
  @endphp
</div>
@endif

<form action="{{ route('user.update') }}" method="POST" enctype="multipart/form-data" id="form">
  @csrf
  <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-12">
          <div class="form-group">
              <strong>Name:</strong>
              <span class="error">*</span>
              <input type="text" name="name" value="{{ $profile->name }}" class="form-control" placeholder="Name">
              @if ($errors->has('name'))
              <span class="error">{{ $errors->first('name') }}</span>
              @endif
          </div>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-12">
          <div class="form-group">
              <strong>Email:</strong>
              <span class="error">*</span>
              <input type="email" name="email" id= "email" value="{{ $profile->email }}" class="form-control" placeholder="Email">
              @if ($errors->has('email'))
              <span class="error">{{ $errors->first('email') }}</span>
              @endif
          </div>
      </div>
      <input type="hidden" name="userid" id="userid" class="form-control" value="{{Auth::guard('web')->user()->id }}">
      <div class="pull-right col-xs-12 col-sm-12 col-md-12">
          <button type="submit" class="btn btn-primary">Update</button>
      </div>
  </div>
</form>
@endsection
@section('css')
<link href="{{ asset('profile/profile.css') }}" rel="stylesheet">

@stop
@section('js')
<script>
  $(document).ready(function ()
  {
      $('#form').validate(
      {
          rules:
          {
              name:
              {
                  required: true
              },
              email:
              {
                  required: true,
                  email: true,
                  remote:
                  {
                      url: '{{ url("validate_email") }}',
                      type: 'POST',
                      data: {
                          email: function()
                          {
                              return $('#form :input[name="email"]').val();
                          },
                          userid: function()
                          {
                              return $('#form :input[name="userid"]').val();
                          },
                          _token: function()
                          {
                              return "{{csrf_token()}}"
                          }
                      },
                  },
              },
              password:
              {
                  required: true,
                  minlength: 8
              },
              messages:
              {
                  name: 'Please Enter Your name.',
                  email:
                  {
                      required: 'Please Enter Email Address.',
                      email: 'Please enter a valid Email Address.',
                      remote:'Email already exists.',
                  },
              },
              submitHandler: function (form)
              {
                  form.submit();
              }
          }
      });

  });

</script>
@stop

