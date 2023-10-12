@extends('adminlte::page')
@section('title', 'Products')
@section('content')
<div class="row">
  <div class="col-lg-12 margin-tb">
    <div class="pull-left">
      <h2>Edit Product</h2>
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
<form action="{{route('products.update',$product->id)}}" method="POST" enctype="multipart/form-data" id="form">
  @csrf
  @method('PUT')
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
      <div class="form-group">
        <strong>Name:</strong>
        <span class="error">*</span>
        <input type="text" name="name" value="{{ $product->name }}" class="form-control" placeholder="Name" autocomplete="off">
        @if ($errors->has('name'))
        <span class="error">{{ $errors->first('name') }}</span>
        @endif
      </div>
    </div>
    <div id="showError"></div>
    <div class="col-xs-12 col-sm-12 col-md-12">
      <div class="form-group">
        <strong>Price:</strong>
        <span class="error">*</span>
        <input type="text" name="price" value="{{ $product->price }}" class="form-control" placeholder="Price" autocomplete="off">
        @if ($errors->has('price'))
        <span class="error">{{ $errors->first('price') }}</span>
        @endif
      </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
      <div class="form-group">
        <strong>Quantity:</strong>
        <span class="error">*</span>
        <input type="number" min="0" max="1000" step="1" name="quantity" id= "quantity" value="{{ $product->quantity }}" class="form-control" placeholder="Quantity" autocomplete="off">
        @if ($errors->has('email'))
        <span class="error">{{ $errors->first('email') }}</span>
        @endif
      </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
      <div class="form-group">
        <strong>Description:</strong>
        <span class="error">*</span>
        <textarea name="description" id= "description" class="form-control" placeholder="Description">{{ $product->description }}</textarea>
        @if ($errors->has('description'))
        <span class="error">{{ $errors->first('description') }}</span>
        @endif
      </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
      <div class="form-group">
        <strong>Image:</strong>
        <span class="error">*</span>
        <input type="file" name="image[]" class="form-control" id="gallery-photo-add"  multiple />
        <!--  <input type="file" id="files" name="files[]" multiple /> -->
        <!--  <img src = "{{ asset('image/'.$product->image) }}" style= "height: 110px; width: 110px; float:right;"> -->
        @if ($errors->has('image'))
        <span class="error">{{ $errors->first('image') }}</span>
        @endif
        <div id="abc">
          @foreach($product_id as $key=>$image)
          <img src = "{{ asset('image/'.$image->image) }}" class="deleteRecord" id="img">
          <span data-id="{{$image->id}}" class="a btn d" id="img_del">X</span>
          @endforeach
        </div>
        <div id="preview"></div>
      </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
      <div class="form-group">
        <strong>Category:</strong>
        <span class="error">*</span>
        <select name="category_id" id ="category_id" >
         <option value="">select category</option>
         @foreach($categories as $key=>$value)
         <option value="{{$value->id}}"{{isset($product) && ($product->category_id == $value->id) ? 'selected': ''}}>{{!empty($value->category_name) ? $value->category_name : ''}}</option>
         @endforeach
       </select>
     </div>
   </div>
    <input type="hidden" name="userid" id="userid" class="form-control" value="{{ $product->id }}">
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
      imagesPreview(this,'div#preview');
    });
  });
  $(".d").on("click",function(e) {
    e.preventDefault();
    var id = $(this).attr("data-id");
    console.log(id);
    if(confirm('Are you sure you want to delete this?')){
    $.ajax({
      type: "GET",
      url:"{{route('products.deleteimage','')}}"+"/"+id,
      success:function(response){
        toastr.success(response.message);
        window.location.reload();
      },
      error:function(response) {
       toastr.error(response.message);
     }
   }); }
  });


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
      },
      messages: {
        name: 'Please Enter Your Name.',
        price: 'Please Enter Price.',
        quantity: 'Please Enter Quantity.',
        description: 'Please Enter Description.',
      },
      submitHandler: function (form) {
        form.submit();
      }
    });
  });
</script>

<script>
  @if(Session::has('success'))
  toastr.success("{{ Session::get('success') }}");
  @endif
  @if(Session::has('info'))
  toastr.info("{{ Session::get('info') }}");
  @endif
  @if(Session::has('warning'))
  toastr.warning("{{ Session::get('warning') }}");
  @endif
  @if(Session::has('error'))
  toastr.error("{{ Session::get('error') }}");
  @endif
</script>
@stop

