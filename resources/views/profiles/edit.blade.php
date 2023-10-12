@extends('adminlte::page')
@section('title', 'User')
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

<form action="{{route('users.update',$profile->id)}}" method="POST" enctype="multipart/form-data" id="form">
  @csrf
  @method('PUT')
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Username:</strong>
            <span class="error">*</span>
            <input type="text" name="username" value="{{ $profile->username }}" class="form-control" placeholder="Username">
            @if ($errors->has('username'))
            <span class="error">{{ $errors->first('username') }}</span>
            @endif
        </div>
    </div>
    <div id="showError"></div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>MobileNo:</strong>
            <span class="error">*</span>
            <input type="text" name="number" value="{{ $profile->number }}" class="form-control" placeholder="Number">
            @if ($errors->has('number'))
            <span class="error">{{ $errors->first('number') }}</span>
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
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Password:</strong>
            <span class="error">*</span>
            <input type="password" name="password" value="{{ $profile->password }}" class="form-control" placeholder="Password">
            @if ($errors->has('password'))
            <span class="error">{{ $errors->first('password') }}</span>
            @endif
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Image:</strong>
            <span class="error">*</span>
            <input type="file" name="image" class="form-control" id="main_image">
            <a class="btn btn-primary mt-1" href="{{route('getfile',$profile->id)}}"> <i class="fa fa-download"></i></a>
            <img src = "{{ asset('image/'.$profile->image) }}" style= "height: 110px; width: 110px; float:right;">
            @if ($errors->has('image'))
            <span class="error">{{ $errors->first('image') }}</span>
            @endif
            <div id="preview"></div>
        </div>
    </div>
    <input type="hidden" name="userid" id="userid" class="form-control" value="{{ $profile->id }}">
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
                        //$('#preview').html('<img src="'+event.target.result+'" width="110" height="110"/>');
                    };
                    fileReader.readAsDataURL(fileInput.files[0]);
                }
            }
            $("#main_image").change(function () {
                imagePreview(this);
            });
</script>
<script>
$(document).ready(function ()
{
    $('#form').validate(
    {
        rules:
        {
            username:
            {
                required: true
            },
            number:
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
                username: 'Please Enter Your Username.',
                number: 'Please Enter Your number.',
                email:
                {
                    required: 'Please Enter Email Address.',
                    email: 'Please enter a valid Email Address.',
                    remote:'Email already exists.',
                },
                password:
                {
                    required: 'Please Enter Password.',
                    minlength: 'Password must be at least 8 characters long.',
                },
                image: 'Please Enter Image.',
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

