@extends('adminlte::page')
@section('title', 'User')
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
          <h2>Add User</h2>
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
<form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data" id="form">
    @csrf
    <div class="row">
        <div id="showError"></div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
              <strong>Username:</strong>
              <span class="error">*</span>
              <input type="text" value="{{old('username')}}" name="username" class="form-control" placeholder="Username">
              @if ($errors->has('username'))
              <span class="text-danger">{{ $errors->first('username') }}</span>
              @endif
          </div>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
          <strong>MobileNo:</strong>
          <span class="error">*</span>
          <input type="text" value="{{old('number')}}" name="number" class="form-control" placeholder="Number" >
          @if ($errors->has('number'))
          <span class="text-danger">{{ $errors->first('number') }}</span>
          @endif
      </div>
  </div>
  <div class="col-xs-12 col-sm-12 col-md-12">
    <div class="form-group">
      <strong>Email:</strong>
      <span class="error">*</span>
      <input type="email" name="email" value="{{old('email')}}"  class="form-control" placeholder="Email">
      @if ($errors->has('email'))
      <span class="text-danger">{{ $errors->first('email') }}</span>
      @endif
  </div>
</div>
<div class="col-xs-12 col-sm-12 col-md-12">
    <div class="form-group">
      <strong>Password</strong>
      <span class="error">*</span>
      <input type="password" value="{{old('password')}}" name="password" class="form-control" placeholder="Password">
      @if ($errors->has('password'))
      <span class="text-danger">{{ $errors->first('password') }}</span>
      @endif
  </div>
</div>
<div class="col-xs-12 col-sm-12 col-md-12">
    <div class="form-group">
      <strong>Image:</strong>
      <span class="error">*</span>
      <input type="file" name="image" class="form-control" placeholder="Image" id="main_image">
      @if ($errors->has('image'))
      <span class="text-danger">{{ $errors->first('image') }}</span>
      @endif
      <div id="preview"></div>
  </div>
</div>
<input type="hidden" name="userid" id="userid" class="form-control">
<div class="pull-right">
  <button type="submit" class="btn btn-primary">Submit</button>
  <a class="btn btn-warning" href="{{ route('users.index') }}">Back</a>
</div>

</div>
</form>
@endsection
@section('css')
<link href="{{ asset('profile/profile.css') }}" rel="stylesheet">
@stop
@section('js')
<script>
  function imagePreview(fileInput) {
    if (fileInput.files && fileInput.files[0]) {
      var fileReader = new FileReader();
      fileReader.onload = function (event) {
        $('#preview').html('<img src="'+event.target.result+'" "/>');
    };
    fileReader.readAsDataURL(fileInput.files[0]);
}
}
$("#main_image").change(function () {
    imagePreview(this);
});

$(document).ready(function () {
    $('#form').validate({
      rules: {
        username: {
          required: true
      },
      number: {
          required: true
      },
      email: {
       required: true,
       email: true,
       remote: {
          url: '{{ url("validate_email") }}',
      },
  },
  password: {
    required: true,
    minlength: 8
},
image:{
    required:true
},
},
messages: {
  username: 'Please Enter Your Username.',
  number: 'Please Enter Your number.',
  email: {
    required: 'Please Enter Email Address.',
    email: 'Please enter a valid Email Address.',
    remote:'Email already exists.',
},
password: {
    required: 'Please Enter Password.',
    minlength: 'Password must be at least 8 characters long.',
},
image: 'Please Enter Image.',
},
submitHandler: function (form) {
  form.submit();
}
});
});
</script>
@stop
