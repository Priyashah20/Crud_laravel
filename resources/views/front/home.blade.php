@extends('front.layout.app')
@section('title')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-3">
            <div class="left-sidebar">
                <h2>Category</h2>
                <div class="panel-group category-products" id="accordian">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            @foreach($category as $key=>$value)
                                <h4 class="panel-title">
                                    <a href="javascript:void(0)" class="category_product" data-id="{{$value->id}}">{{$value->category_name}} ({{$value->get_product_name_count}})
                                    </a>
                                </h4>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="price-range">
                    <h2>Price Range</h2>
                    <div class="well">
                       {{--  <input type="text" class="span2" value="" data-slider-min="0" data-slider-max="500" data-slider-step="5" data-slider-value="[250,450]" id="sl2 "><br/>
                        <b></b> <b class="pull-right">$600</b>
                         <div id="slider-range"></div> --}}
                        <label for="amount">Price(₹):</label>
                        <input type="text" name="amount" id="amount"  class="border-0 fw-bold text-warning amount" style="border:0; color:#f6931f; font-weight:bold;" value="" class="amount">
                        <div id="slider-range"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-9 padding-right">
            <div class="features_items">
                <h2 class="title text-center">Features Items</h2>
                <div class="product-of-category">
                    @foreach($product as $k=>$v)
                    <form action="{{route('cart.list',$v->id)}}" method="POST">
                        <div class="col-sm-4">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center">
                                        @foreach($v->getImage as $k1=>$v1)
                                        <img src="{!! asset('image/'.$v1->image) !!}" alt=" " height="200px" width="200px" />
                                        @endforeach
                                        <h2>{{$v->price}}</h2>
                                        <p>{{$v->name}}</p>
                                        <p>{{$v->description}}</p>
                                        <a href="{{ route('cart.list',$v->id) }}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart
                                        </a>
                                    </div>
                                </div>
                                <div class="choose">
                                    <ul class="nav nav-pills nav-justified">
                                        <li><a href=""><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                                        <li><a href=""><i class="fa fa-plus-square"></i>Add to compare</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </form>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@section('js')
<script>
    $(document).ready(function(){
        $('.category_product').click(function(){
            var id = $(this).attr('data-id');
            $_token = "{{ csrf_token() }}";
            $.ajax({
                headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
                url: "{{ route('front.category_list') }}",
                type: 'POST',
                data: {id:id,'_token': $_token },
                datatype: 'json',
                success: function(response) {
                    console.log(response);
                    $('.product-of-category').html(response.result);
                }
            });
        });
        $(document).on('keyup','.search',function(){
            var search = $(this).val();
            $.ajax({
                url: "{{ route('front.search') }}",
                type: 'POST',
                data : {'search':search,_token: '{{csrf_token()}}'},
                datatype: 'json',
                success: function(response) {
                    console.log(response);
                     $('.product-of-category').html(response.result);
                }
            })
        });
    });
</script>
<script>
$(function() {
    $("#slider-range" ).slider({
        range: true,
        min: 0,
        max: 12000,
        values: [ '0', '12000' ],
        slide: function( event, ui ) {
            var min = $("#slider-range").slider("option", "min"),
                max = $("#slider-range").slider("option", "max")
            $( ".amount" ).val( "₹" + ui.values[ 0 ] + " - ₹" + ui.values[ 1 ] );
             console.log(ui.values[0]);
             console.log(ui.values[1]);
            $.ajax({
                url: "{{ route('front.price') }}",
                type: 'POST',
                data:{_token: '{{csrf_token()}}','min':ui.values[0],'max':ui.values[1]},
                datatype: 'json',
                success: function (response) {
                     console.log(response);
                     $('.product-of-category').html(response.result);
                }
            });
        }
    });
        //$( "#amount" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) +
          //  " - $" + $( "#slider-range" ).slider( "values", 1 ) );
});
</script>
@stop
@endsection


