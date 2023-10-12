@extends('adminlte::page')
@section('title', 'Products')
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Products</h2>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-3"><strong>Name:</strong></div>
    <div class="col-sm-9"> {{ $image[0]->product->name }}</div>
</div>
<div class="row">
    <div class="col-sm-3"><strong>Price:</strong></div>
    <div class="col-sm-9">{{ $image[0]->product->price}}</div>
</div>
<div class="row">
    <div class="col-sm-3"><strong>Quantity:</strong></div>
    <div class="col-sm-9">{{ $image[0]->product->quantity}}
    </div>
</div>
<div class="row">
    <div class="col-sm-3"><strong>Description:</strong></div>
    <div class="col-sm-9"> {{ $image[0]->product->description}}</div>
</div>
<div class="row">
    <div class="col-sm-3"><strong>Image:</strong></div>
    <div class="col-sm-9">
    @foreach($image as $result)
    <img src="{{asset ('image/'.$result->image) }}">
    @endforeach
    </div>
</div>
<div class="pull-right">
    <a class="btn btn-warning" href="{{ route('products.index') }}">Back</a>
</div>
@endsection
@section('css')
<link href="{{ asset('product/product.css') }}" rel="stylesheet">
@stop
