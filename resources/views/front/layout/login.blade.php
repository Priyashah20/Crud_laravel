@extends('front.layout.app')
@section('title')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-sm-offset-1">
                <div class="login-form"><!--login form-->
                    <h2>Login to your account</h2>
                    <form action="{{route('login.store')}}" method="POST" enctype="multipart/form-data" id="signin">
                        @csrf
                        <input type="email" placeholder="Email Address" name="email">
                        <input type="password" placeholder="Password" name="password" id="password">
                        <button type="submit" class="btn btn-default">Login</button>
                    </form>
                </div><!--/login form-->
            </div>
            <div class="col-sm-1">
                <h2 class="or">OR</h2>
            </div>
            <div class="col-sm-4">
                <div class="signup-form"><!--sign up form-->
                    <h2>New User Signup!</h2>
                    <form action="{{route('signUp.store')}}" method="POST" enctype="multipart/form-data" id="signup">
                        @csrf
                        <input type="text" placeholder="Name" name="name">
                        <input type="email" placeholder="Email Address" name="email">
                        <input type="phone" placeholder="Phone" name="phone">
                        <input type="password" id="txtNewPassword" placeholder="Enter passward" name="password">
                        <input type="password" id="txtConfirmPassword" placeholder="Confirm Passward" name="confirm_password">
                        <button type="submit" class="btn btn-default">Signup</button>
                        <div style="color:green;" id="CheckPasswordMatch">
                    </form>
                </div><!--/sign up form-->
            </div>
        </div>
    </div>
</br>
    {{-- <footer id="footer">
    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <p class="pull-left">2022</p>

            </div>
        </div>
    </div>
</footer> --}}
@section('js')
<script type="text/javascript">
$(document).ready(function () {
    $('#signup').validate({
        rules: {
            name:{
                required: true
            },
            email:{
                required:true
            },
            phone: {
                required: true
            },
            password:{
                required:true
            },
            confirm_password:{
                required:true,
            }
        },
        messages: {
            name: 'Please Enter Your Name.',
            email: 'Please Enter Your Email.',
            phone: 'Please Enter Your Phone Number.',
            password:'Please Enter Your Password.',
            confirm_password:'Please Confirm Your Password.',
        },
        submitHandler: function(form) {
            form.submit();
        }
    });
});
</script>
<script>
function checkPasswordMatch() {
        var password = $("#txtNewPassword").val();
        var confirmPassword = $("#txtConfirmPassword").val();
        if (password != confirmPassword)
            $("#CheckPasswordMatch").html("Passwords does not match!");
        else
            $("#CheckPasswordMatch").html("Passwords match.");
    }
    $(document).ready(function () {
       $("#txtConfirmPassword").keyup(checkPasswordMatch);
    });
</script>
<script type="text/javascript">
$(document).ready(function () {
    $('#signin').validate({
        rules: {
            email:{
                required:true
            },
            password: {
                required: true
            },
        },
        messages: {
            email:'Please Enter Your Email.',
            password:'Please Enter Your Password.',
        },
        submitHandler: function (form) {
            form.submit();
        }
    });
});
</script>
@stop
@endsection
