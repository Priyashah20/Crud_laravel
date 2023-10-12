<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Shop | E-Shopper</title>
    <link rel="icon" href="{!! asset('/logos/shop.png') !!}" >
    <link href="{!! asset('front/css/bootstrap.min.css') !!}" rel="stylesheet">
    <link href="{!! asset('front/css/font-awesome.min.css') !!}" rel="stylesheet">
    <link href="{!! asset('front/css/prettyPhoto.css') !!}" rel="stylesheet">
    <link href="{!! asset('front/css/price-range.css') !!}" rel="stylesheet">
    <link href="{!! asset('front/css/animate.css') !!}" rel="stylesheet">
    <link href="{!! asset('front/css/main.css') !!}" rel="stylesheet">
    <link href="{!! asset('front/css/responsive.css') !!}" rel="stylesheet">
    <link href="{!! asset('front/css/toastr.css') !!}" rel="stylesheet">
    <link href="{!! asset('front/css/jquery-ui.css') !!}" rel="stylesheet">


    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
   {{-- <link rel="shortcut icon" href="{!!asset('front/images/ico/favicon.ico')!!}"> --}}
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{!! asset('front/images/ico/apple-touch-icon-144-precomposed.png') !!}">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{!! asset('front/images/ico/apple-touch-icon-114-precomposed.png') !!}">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{!! asset('front/images/ico/apple-touch-icon-72-precomposed.png') !!}">
    <link rel="apple-touch-icon-precomposed" href="{!! asset('front/images/ico/apple-touch-icon-57-precomposed.png') !!}">
</head><!--/head-->

<body>
   <!-- header section-->
        @include('front.layout.header')

    <section>
        @yield('content')
    </section>

    <!--Footer Section-->
    @include('front.layout.footer')
    <script src="{!! asset('front/js/vendors.bundle.js') !!}" type="text/javascript"></script>
    <script src="{!! asset('front/js/scripts.bundle.js') !!}" type="text/javascript"></script>
    <script src="{!! asset('front/js/jquery.js') !!}" type="text/javascript"></script>
    <script src="{!! asset('front/js/bootstrap.min.js') !!}" type="text/javascript"></script>
    <script src="{!! asset('front/js/jquery-3.6.0.js') !!}" type="text/javascript"></script>
    <script src="{!! asset('front/js/jquery.scrollUp.min.js') !!}" type="text/javascript"></script>
    <script src="{!! asset('front/js/price-range.js') !!}" type="text/javascript"></script>
    <script src="{!! asset('front/js/jquery.prettyPhoto.js') !!}" type="text/javascript"></script>
    <script src="{!! asset('front/js/main.js') !!}" type="text/javascript"></script>
    <script src="{!! asset('front/js/toastr.min.js') !!}" type="text/javascript"></script>
    <script src="{!! asset('front/js/jquery-ui.js') !!}" type="text/javascript"></script>
    <script src="{!! asset('front/js/jquery-ui.min.js') !!}" type="text/javascript"></script>
    <script src="{!! asset('front/js/jquery.validate.min.js') !!}" type="text/javascript"></script>
    @yield('js')
    @if($message = Session::get('success'))
    <script type="text/javascript">
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
</html>
