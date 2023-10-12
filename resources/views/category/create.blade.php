@extends('adminlte::page')
@section('title', 'Category')
@section('content')
<div class="row">
  <div class="col-lg-12 margin-tb">
    <div class="pull-left">
      <h2>Add Category</h2>
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
<form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data" id="form">
  @csrf
  <div class="row">
    <div id="showError"></div>
    <div class="col-xs-12 col-sm-12 col-md-12">
      <div class="form-group">
        <strong>Category Name:</strong>
        <span class="error">*</span>
        <input type="text" value="{{old('category_name')}}" name="category_name" class="form-control" placeholder="Category Name" autocomplete="off">
        @if ($errors->has('category_name'))
        <span class="text-danger">{{ $errors->first('category_name') }}</span>
        @endif
      </div>
      <div class="form-group">
        <strong>Status</strong>
        <span class="error">*</span>
        @if ($errors->has('status'))
        <span class="status">{{ $errors->first('status') }}</span>
        @endif
        <input type="radio" name="status" value="0"
        @if(isset($data)){{($data->status)=="Active"? 'checked':''}} @else{{ (old('status') == 'Active') ? 'checked': '' }}@endif>Active
        <span></span>
        <input type="radio" name="status" value="1"
        @if(isset($data)){{($data->status)=="0"? 'checked':''}}@else{{ (old('status') == '1') ? 'checked': '' }}@endif>Inactive
        <span></span>
      </div>
    </div>
  </div>
  <input type="hidden" name="userid" id="userid" class="form-control">
  <div class="pull-right">
    <a class="btn btn-warning" href="{{ route('categories.index') }}">Back</a>
    <button type="submit" class="btn btn-primary a">Submit</button>
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
@stop
