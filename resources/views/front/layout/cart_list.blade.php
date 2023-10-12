@extends('front.layout.app')
@section('title')
@section('content')
<section id="cart_items">
<div class="container">
    <div class="breadcrumbs">
        <ol class="breadcrumb">
          <li><a href="{{route('front.index')}}">Home</a></li>
          <li class="active">Shopping Cart</li>
        </ol>
    </div>
    <div class="table-responsive cart_info">
    <table class="table table-condensed">
        <thead>
            <tr class="cart_menu">
                <td class="image">Product Image</td>
                <td class="description">Title</td>
                <td class="price">Price</td>
                <td class="quantity">Quantity</td>
               {{--  <td class="discount">Discount % OFF</td> --}}
                <td class="total">Total</td>
                <td class="remove">Remove Product</td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            @php $total = 0; @endphp
            @forelse($cart as $k=>$v)
                <tr>
                    <td class="cart_product">
                        <a href=""><img src="{!! asset('image/'.$v->image) !!}" alt=" "height="100px" width="100px" />
                        </td>
                        <td class="cart_description">
                            <h4>{{$v->name}}</h4>
                        </td>
                        <td class="cart_price">
                            <h4>₹{{$v->price}}</h4>
                        </td>
                        <td class="cart_quantity">
                            <div>
                                <a href="javascript:void(0)" class="btn btn-default quantity" status="minus" data-id="{{$v->id}}"> - </a>
                                <input type="text" name="quantity" class="btn btn-default quantity" status= "by-input" data-id="{{$v->id}}" value="{{$v->quantity}}" autocomplete="off" size="2" min="0">
                                <a href="javascript:void(0)" class="btn btn-default quantity" status="plus" data-id="{{$v->id}}"> + </a>
                            </div>
                        </td>
                       {{--  <td class="cart_total">
                            <p class="cart_discount">{{$v->price - $v->quantity * 100/$v->price}}</p>
                        </td> --}}
                        <td class="cart_total">
                            <p class="cart_total_price">₹{{ $v->price * $v->quantity}}</p>
                        </td>
                        <td class="cart_delete">
                            <a class="cart_quantity_delete" href="{{route('cart.destroy',$v->id)}}"><i class="fa fa-times"></i></a>
                        </td>
                    </td>
                </tr>
                  @php $total +=  $v->price * $v->quantity; @endphp
            @empty
            <h4>Your cart is empty</h4>
            @endforelse
        </tbody>
    </table>
</div>
<form action="{{route('cart.empty')}}" method="POST">
    <input type="hidden" name="_method" value="DELETE" />
    @csrf
    @method('POST')
    <button class="btn btn-danger">Empty Cart</button>
</form>
</div>
</section>
<div class="container">
        <div class="col-sm-6">
            <div class="total_area">
                <ul>
                    <li>Total <span>₹ {{$total}}</span></li>
                </ul>
                    <a class="btn btn-default check_out" href="{{route('order.index')}}">Check Out</a>
            </div>
        </div>
</div>
@section('js')
<script>
    $(document).ready(function () {
        $(document).on('click keyup','.quantity',function() {
            var status = $(this).attr('status');
            var id = $(this).data('id');
            var qty = $(this).val();
            $.ajax({
                type : "POST",
                dataType: 'json',
                url : "{{route('cart.update')}}",
                data : {'id':id,'status':status,'qty':qty,_token: '{{ csrf_token() }}'},
                success: function(response){
                    console.log(response);
                    if(response.status == 'plus' || response.status == 'minus' ){
                        window.location.reload();
                    }
                    if(response.status == 'fail'){
                        var msg=response.msg;
                        setTimeout(function() {
                            toastr.options = {
                                closeButton: true,
                                progressBar: true,
                                showMethod: 'slideDown',
                                timeOut: 40000
                            };
                            toastr.error(msg);
                        }, 1300);
                    }
                }
            })
        });
    });
</script>
@stop
@endsection
