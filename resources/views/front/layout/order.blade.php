@extends('front.layout.app')
@section('title')
@section('content')
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
              <li><a href="{{route('front.index')}}">Home</a></li>
              <li class="active">Check out</li>
            </ol>
        </div>

        <div class="checkout-options">
            <ul class="nav">
                <li>
                    <a href=""><i class="fa fa-times"></i>Cancel process</a>
                </li>
            </ul>
        </div>
        <div class="register-req">
        </div>
        <div class="shopper-informations">
            <div class="row">
                <div class="col-sm-5 clearfix">
                    <div class="bill-to">
                        <p>Bill To</p>
                        <div class="form-one">
                            <form action="{{route('order.store')}}" method="POST" enctype="multipart/form-data" id="users_detail">
                                @csrf
                                <input type="text" placeholder="Name*" name="name">
                                <input type="text" placeholder="Email*" name="email">
                                <input type="text" placeholder="Phone No*" name="phone">
                                <input type="text" placeholder="Address*" name="address">
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="order-message">
                        <p>Shipping Order</p>
                        <textarea name="message" placeholder="Notes about your order, Special Notes for Delivery" rows="16"></textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="review-payment">
            <h2>Review & Confirm Order</h2>
        </div>

        <div class="table-responsive cart_info">
            <table class="table table-condensed">
                <thead>
                    <tr class="cart_menu">
                        <td class="image">Product Image</td>
                        <td class="description">Title</td>
                        <td class="price">Price</td>
                        <td class="quantity">Quantity</td>
                        <td class="total">Total</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cart as $k=>$v)
                    <tr>
                        <td class="cart_product">
                            <a href=""><img src="{!! asset('image/'.$v->image) !!}" alt=" "height="100px" width="100px"/>
                        </td>
                        <td class="cart_description">
                            <h4>{{$v->name}}</h4>
                        </td>
                        <td class="cart_price">
                            <h4>{{$v->price}}</h4>
                        </td>
                        <td class="cart_quantity">
                            <div>
                                <input type="text" disabled name="quantity" class="btn btn-default quantity" status= "by-input" data-id="{{$v->id}}" value="{{$v->quantity}}" autocomplete="off" min="0">
                            </div>
                        </td>
                        <td class="cart_total">
                            <p class="cart_total_price">₹{{ $v->price * $v->quantity}}</p>
                        </td>
                    </tr>
                     @endforeach
                </tbody>
            </table>
            <div class="__web-inspector-hide-shortcut__">
                <button class="btn btn-default update" type="submit">Confirm order</button>
                <a href="{{route('front.index')}}" class="btn btn-default update">Continue shopping</a>
            </div>
        </form>
            <br>
        </div>
    </div>
</section>
@section('js')
<script type="text/javascript">
  $(document).ready(function () {
        $('#users_detail').validate({
            rules: {
                name: {
                  required: true
                },
                email:{
                  required:true
                },
                phone: {
                  required: true
                },
                address:{
                  required:true
                }
            },
            messages: {
                name: 'Please Enter Your First Name.',
                email:'Please Enter Email Address.',
                phone:'Please Enter Your Phone Number.',
                address:'Please Enter Your Address.',
            },
        submitHandler: function (form) {
            form.submit();
        }
    });
  });
</script>
@stop
@endsection
