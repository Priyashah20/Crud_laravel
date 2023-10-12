<!DOCTYPE html>
<html lang="en">

    <!-- begin::Head -->
    <head>
        <meta charset="utf-8" />
        <title>Login</title>
        <meta name="description" content="Latest updates and statistic charts">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">

        <!--begin::Web font -->
        <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
        <script>
            WebFont.load({
            google: {"families":["Poppins:300,400,500,600,700","Roboto:300,400,500,600,700"]},
            active: function() {
                sessionStorage.fonts = true;
            }
          });
        </script>

        <!--end::Web font -->

        <!--begin::Global Theme Styles -->
        <link href="{!!asset('assets/vendors/base/vendors.bundle.css')!!}" rel="stylesheet" type="text/css" />

        <link href="{!!asset('assets/demo/default/base/style.bundle.css')!!}" rel="stylesheet" type="text/css" />
        <link rel="shortcut icon" href="{!!asset('assets/demo/default/media/img/logo/favicon.ico')!!}" />
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
    </head>

    <!-- end::Head -->

    <!-- begin::Body -->
    <body class="m--skin- m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--fixed m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default">

        <!-- begin:: Page -->
        <div class="m-grid m-grid--hor m-grid--root m-page">
            <div class="m-grid__item m-grid__item--fluid m-grid m-grid--hor m-login m-login--signin m-login--2 m-login-2--skin-3" id="m_login" style="background-image: url({!!asset('assets/app/media/img//bg/bg-2.jpg')!!});">
                <div class="m-grid__item m-grid__item--fluid m-login__wrapper">
                    <div class="m-login__container">
                        <div class="m-login__logo">
                            <a href="#">
                                <img src="{!!asset('assets/app/media/img/logos/logo-1.png')!!}">
                            </a>
                        </div>
                        <div class="m-login__signin">
                            <div class="m-login__head">
                                <h3 class="m-login__title">Sign In To Admin</h3>
                            </div>
                            <form class="m-login__form m-form" action="{{route('admin.login')}}" method="POST" id="signIn">
                                @csrf
                                <div class="form-group m-form__group">
                                    <input class="form-control m-input" type="text" placeholder="Email" name="email" autocomplete="off">
                                </div>
                                <div class="form-group m-form__group">
                                    <input class="form-control m-input m-login__form-input--last" type="password" placeholder="Password" name="password">
                                </div>
                                <div class="row m-login__form-sub">
                                    <div class="col m--align-right m-login__form-right">
                                        <a href="javascript:;" id="m_login_forget_password" class="m-link">Forget Password ?</a>
                                    </div>
                                </div>
                                <div class="m-login__form-action">
                                    <button type="submit" class="btn btn-focus m-btn">Sign In</button>
                                </div>
                            </form>
                        </div>
                        <div class="m-login__signup">
                            <div class="m-login__head">
                                <h3 class="m-login__title">Sign Up</h3>
                                <div class="m-login__desc">Enter your details to create your account:</div>
                            </div>
                            <form class="m-login__form m-form" action="{{route('admin.signup')}}" method="POST" enctype="multipart/form-data" id="signUp">
                                @csrf
                                <div class="form-group m-form__group">
                                    <input class="form-control m-input" type="text" placeholder="Fullname" name="name">
                                </div>
                                <div class="form-group m-form__group">
                                    <input class="form-control m-input" type="text" placeholder="Email" name="email" autocomplete="off">
                                </div>
                                <div class="form-group m-form__group">
                                    <input class="form-control m-input" type="password" placeholder="Password" name="password" id="txtNewPassword">
                                </div>
                                <div class="form-group m-form__group">
                                    <input class="form-control m-input m-login__form-input--last" type="password" placeholder="Confirm Password" name="confirm_password" id="txtConfirmPassword">
                                </div>
                                <div class="row form-group m-form__group m-login__form-sub">
                                    <div class="col m--align-left">
                                        <label class="m-checkbox m-checkbox--light">
                                            <input type="checkbox" name="agree">I Agree the <a href="#" class="m-link m-link--focus">terms and conditions</a>.
                                            <span></span>
                                        </label>
                                        <span class="m-form__help"></span>
                                    </div>
                                </div>
                                <div class="m-login__form-action">
                                    <button type="submit" class="btn btn-focus m-btn">Sign Up</button>&nbsp;&nbsp;
                                    <button class ="btn btn-outline-focus m-btn" href="{{route('admin.index')}}">Cancel</button>
                                </div>
                            </form>
                        </div>
                            <div style="color:green;" id="CheckPasswordMatch">
                        <div class="m-login__forget-password">
                            <div class="m-login__head">
                                <h3 class="m-login__title">Forgotten Password ?</h3>
                                <div class="m-login__desc">Enter your email to reset your password:</div>
                            </div>
                            <form class="m-login__form m-form" action="">
                                <div class="form-group m-form__group">
                                    <input class="form-control m-input" type="text" placeholder="Email" name="email" id="m_email" autocomplete="off">
                                </div>
                                <div class="m-login__form-action">
                                    <button id="m_login_forget_password_submit" class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air m-login__btn m-login__btn--primary">Request</button>&nbsp;&nbsp;
                                    <button id="m_login_forget_password_cancel" class="btn btn-outline-focus m-btn m-btn--pill m-btn--custom  m-login__btn">Cancel</button>
                                </div>
                            </form>
                        </div>
                        <div class="m-login__account">
                            <span class="m-login__account-msg">
                                Don't have an account yet ?
                            </span>&nbsp;&nbsp;
                            <a href="javascript:;" id="m_login_signup" class="m-link m-link--light m-login__account-link">Sign Up</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- end:: Page -->

        <!--begin::Global Theme Bundle -->
        <script src="{!!asset('assets/vendors/base/vendors.bundle.js')!!}" type="text/javascript"></script>
        <script src="{!!asset('assets/demo/default/base/scripts.bundle.js')!!}" type="text/javascript"></script>

        <!--end::Global Theme Bundle -->

        <!--begin::Page Scripts -->
        <script src="{!!asset('assets/snippets/custom/pages/user/login.js')!!}" type="text/javascript"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

        <!--end::Page Scripts -->
        @if($message = Session::get('success'))
            <script type ="text/javascript">
                setTimeout(function() {
                    toastr.options = {
                    closeButton: true,
                    progressBar: true,
                    showMethod: 'slideDown',
                    timeOut: 4000
                    };
                toastr.success('{{$message["msg"]}}');
                }, 1300);
            </script>
        @endif
    </body>
    <!-- end::Body -->
</html>
<script type="text/javascript">
    $(document).ready(function () {
        $('#signIn').validate({
            rules: {
                email:{
                    required:true,
                    email:true
                },
                password: {
                    required: true
                },
            },
            messages: {
                email:{
                    required:'Please Enter Your Email',
                    email:'Please enter valid email',
                },
                password:'Please Enter Your Password.',
            },
        });
        $('#signUp').validate({
            rules: {
                name:{
                    required: true
                },
                email:{
                    required:true,
                    email:true
                },
                password:{
                    required:true
                },
                confirm_password:{
                    required:true,
                }
            },
            messages: {
                name: 'Please Enter Your Fullname.',
                email: {
                    required:'Please Enter Your Email',
                    email:'Please enter valid email',
                },
                password:'Please Enter Your Password.',
                confirm_password:'Please Confirm Your Password.',
            },
        });
    });
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
