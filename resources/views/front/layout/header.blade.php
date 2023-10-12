<!--header-->
{{-- <div class="header_top">
</div> --}}<!--/header_top-->
<div class="header-middle"><!--header-middle-->
<div class="container">
    <div class="row">
        <div class="col-md-4 clearfix">
            <div class="logo pull-left">
                <a href="index.html"><img src="{!!asset('front/images/home/logo.png')!!}" alt="" /></a>
            </div>
        </div>
        <div class="col-md-8 clearfix">
            <div class="shop-menu clearfix pull-right">
                <ul class="nav navbar-nav">
                    <li><a href="{{route('order.index')}}"><i class="fa fa-crosshairs"></i> Checkout</a></li>
                    <li><a href="{{route('cart.index')}}"><i class="fa fa-shopping-cart"></i> Cart ({{($cart_qty)}})
                    </a></li>
                    <li><a href="{{route('login.index')}}"><i class="fa fa-lock"></i> Login</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
</div>
<div class="header-bottom">
<div class="container">
    <div class="row">
        <div class="col-sm-9">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div class="mainmenu pull-left">
                <ul class="nav navbar-nav collapse navbar-collapse">
                    <li><a href="{{route('front.index')}}">Home</a></li>
                    <li class="dropdown"><a href="#" class="active">Shop<i class="fa fa-angle-down"></i></a>
                        <ul role="menu" class="sub-menu">
                            <li><a href="shop.html" class="active">Products</a></li>
                            <li><a href="product-details.html">Product Details</a></li>
                            <li><a href="{{route('order.index')}}">Checkout</a></li>
                            <li><a href="cart.html">Cart</a></li>
                            <li><a href="login.html">Login</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="search_box pull-right">
                <input type="text" name="search" class="search" placeholder="Search" autocomplete="off">
            </div>
        </div>
    </div>
    </div>
</div>
