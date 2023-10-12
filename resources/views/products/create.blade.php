@extends('adminlte::page')
@section('title', 'Products')
@section('content')
<div class="row">
  <div class="col-lg-12 margin-tb">
    <div class="pull-left">
      <h2>Add Product</h2>
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
<form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" id="form">
  @csrf
  <div class="row">
    <div id="showError"></div>
    <div class="col-xs-12 col-sm-12 col-md-12">
      <div class="form-group">
        <strong>Name:</strong>
        <span class="error">*</span>
        <input type="text" value="{{old('name')}}" name="name" class="form-control" placeholder="Name" autocomplete="off">
        @if ($errors->has('name'))
        <span class="text-danger">{{ $errors->first('name') }}</span>
        @endif
    </div>
</div>
<div class="col-xs-12 col-sm-12 col-md-12">
  <div class="form-group ">
    <strong>Price:</strong>
    <span class="error">*</span>
    <input type="text" value="{{old('price')}}" name="price" class="form-control" placeholder="Price" autocomplete="off">
    @if ($errors->has('price'))
    <span class="text-danger">{{ $errors->first('price') }}</span>
    @endif
</div>
</div>
<div class="col-xs-12 col-sm-12 col-md-12">
  <div class="form-group">
    <strong>Quantity:</strong>
    <span class="error">*</span>
    <input type="number" min="0" max="1000" step="1" name="quantity" value="{{old('quantity')}}"  class="form-control" placeholder="Quantity" autocomplete="off">
    @if ($errors->has('quantity'))
    <span class="text-danger">{{ $errors->first('quantity') }}</span>
    @endif
</div>
</div>
<div class="col-xs-12 col-sm-12 col-md-12">
  <div class="form-group">
    <strong>Description:</strong>
    <span class="error">*</span>
    <textarea name="description" class="form-control" placeholder="Description">{{old('description')}}</textarea>
    @if ($errors->has('description'))
    <span class="text-danger">{{ $errors->first('description') }}</span>
    @endif
</div>
</div>
<div class="col-xs-12 col-sm-12 col-md-12">
  <div class="form-group">
    <strong>Image:</strong>
    <span class="error">*</span>
    <input type="file" name="image[]" class="form-control" placeholder="Image"
    id="gallery-photo-add" multiple>
    @if ($errors->has('image'))
    <span class="text-danger">{{ $errors->first('image') }}</span>
    @endif
    <div class="gallery"></div>
    <div id="preview"></div>
</div>
</div>
<div class="col-xs-12 col-sm-12 col-md-12">
  <div class="form-group">
    <strong>Category:</strong>
    <span class="error">*</span>
    <select name="category_id" id ="category_id">
       <option value="">select category</option>
       @foreach($categories as $key=>$value)
       <option value="{{$value->id}}">{{!empty($value->category_name) ? $value->category_name : ''}}</option>
       @endforeach
    </select>
</div>
</div>
<input type="hidden" name="userid" id="userid" class="form-control">
<div class="pull-right">
    <button type="submit" class="btn btn-primary">Submit</button>
    <a class="btn btn-warning" href="{{ route('products.index') }}">Back</a>
</div>
</div>
</form>
@endsection
@section('css')
<link href="{{ asset('product/product.css') }}" rel="stylesheet">
@stop

@section('js')
<script>
  $(function() {
    var imagesPreview = function(input, placeToInsertImagePreview) {
      if (input.files) {
        var filesAmount = input.files.length;
        for (i = 0; i < filesAmount; i++) {
          var reader = new FileReader();
          reader.onload = function(event) {
            $($.parseHTML('<img>')).attr('src', event.target.result).appendTo(placeToInsertImagePreview);
        }
        reader.readAsDataURL(input.files[i]);
    }
}
};

$('#gallery-photo-add').on('change', function() {
  imagesPreview(this, 'div.gallery');
});
});
</script>
<script>
  $(document).ready(function () {
      $('#form').validate({
          rules: {
              name: {
                  required: true
              },
              price: {
                  required: true
              },
              quantity: {
                  required: true
              },
              description: {
                  required: true
              },
              image:{
                  required:true
              },
          },
          messages: {
              name: 'Please Enter Your Name.',
              price: 'Please Enter Price.',
              quantity: 'Please Enter Quantity.',
              description: 'Please Enter Description.',
              image: 'Please Enter Image.',
          },
          submitHandler: function (form) {
              form.submit();
          }
      });
  });
</script>
@stop
