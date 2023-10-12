@extends('adminlte::page')
@section('title', 'Category')
@section('content')
<div class="row">
  <div class="col-lg-12 margin-tb">
    <div class="pull-left">
      <h2>Edit Category</h2>
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
<form action="{{route('categories.update',$category->id)}}" method="POST" enctype="multipart/form-data" id="form">
  @csrf
  @method('PUT')
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
      <div class="form-group">
        <strong>Category Name:</strong>
        <span class="error">*</span>
        <input type="text" name="category_name" value="{{ $category->category_name }}" class="form-control" placeholder="Category Name" autocomplete="off">
        @if ($errors->has('category_name'))
        <span class="error">{{ $errors->first('category_name') }}</span>
        @endif
      </div>
    </div>
    <div id="showError"></div>
  </div>
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
      <div class="form-group">
        <strong>Status</strong>
        <span class="error">*</span>
        @if ($errors->has('status'))
        <span class="status">{{ $errors->first('status') }}</span>
        @endif
        <input type="radio" name="status" value="0" {{isset($category) && $category->status == '0' ? 'checked' : ''}}>Active
        <span></span>
        <input type="radio" name="status" value="1"
        {{isset($category) && $category->status == '1' ? 'checked' : ''}}>Inactive
        <span></span>
      </div>
    </div>
  </div>
  <div class="pull-right">
   <a class="btn btn-warning" href="{{ route('categories.index') }}">Back</a>
   <button type="submit" class="btn btn-primary a">Submit</button>
 </div>
</div>
</form>
@endsection

@section('css')
<link href="{{ asset('category/category.css') }}" rel="stylesheet">
@stop

@section('js')
<script>
  $(document).ready(function () {
    $('#form').validate({
      rules: {
        category_name: {
          required: true
        },
      },
      messages: {
        category_name: 'Please Enter Category Name.',
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
