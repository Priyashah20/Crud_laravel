@extends('adminlte::page')
@section('title','ChangePassword')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <h2>Change Password</h2>
                <div class="panel-body">
                    @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                    @endif
                    @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif
                    @if($errors)
                    @foreach ($errors->all() as $error)
                    <div class="alert alert-danger">{{ $error }}</div>
                    @endforeach
                    @endif
                    <form  method="POST" action="{{ route('changePasswordPost') }}" id="form">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('current-password') ? ' has-error' : '' }}">
                            <label for="new-password" class="col-md-4 control-label">Current Password &nbsp;<span class="error">*</span>
                            </label>
                            <div class="col-md-12">
                                <input id="current_password" type="password" class="form-control" name="current_password" placeholder='Current Password' required>
                                @if ($errors->has('current-password'))
                                <span class="error">
                                    <strong>{{ $errors->first('current-password') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('new-password') ? ' has-error' : '' }}">
                            <label for="new-password" class="col-md-4 control-label">New Password &nbsp;<span class="error">*</span>
                            </label>
                            <div class="col-md-12">
                                <input id="new_password" type="password" class="form-control" name="new_password" placeholder='New Password' required>
                                @if ($errors->has('new-password'))
                                <span class="error">
                                    <strong>{{ $errors->first('new-password') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="new-password-confirm" class="col-md-4 control-label">Confirm Password &nbsp;<span class="error">*</span>
                            </label>
                            <div class="col-md-12">
                                <input id="new_password_confirm" type="password" class="form-control" name="new_password_confirmation" placeholder='Confirm Password' required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-primary">Change Password</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('css')
<link href="{{ asset('profile/profile.css') }}" rel="stylesheet">
@stop
@section('js')
<
<script>
    jQuery.validator.addMethod("notEqual", function(value, element, param) {
     return this.optional(element) || value != $(param).val();
 }, "Current Password do not match with Password.");

    $(document).ready(function () {
        $('#form').validate({
            rules: {
              current_password: {
                required: true,
                minlength: 8

            },

            new_password: {
                required: true,
                minlength: 8,
                notEqual: "#current_password"

            },
            new_password_confirmation: {
                required: true,
                minlength: 8,
                equalTo: "#new_password"
            },
        },
        messages:
        {
            current_password:
            {
                required: 'Please Enter Current Password.',
                minlength: 'Password must be at least 8 characters long.',
            },
            new_password:
            {
                required: 'Please Enter Your New Password.',
                minlength: 'Password must be at least 8 characters long.',
                notEqualTo: 'Current Password do not match with Password.',


            },
            new_password_confirmation:
            {
                required: 'Please Enter Confirm Password.',
                minlength: 'Password must be at least 8 characters long.',
                equalTo: 'Confirm Password do not match with Password.',
            },
        },
        submitHandler: function (form) {
          form.submit();
      }
  });
    });

</script>

@stop

