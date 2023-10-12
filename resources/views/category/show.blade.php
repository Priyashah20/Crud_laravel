@extends('adminlte::page')
@section('title', 'Category')
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Category</h2>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-3"><strong>Category Name:</strong></div>
    <div class="col-sm-9">{{$category->category_name}}</div>
    <div class="col-sm-3"><strong>Status:</strong></div>
    <div class="col-sm-9">{{$category->status}}</div>
</div>
<br>
<div class="pull-right">
    <a class="btn btn-warning" href="{{ route('categories.index') }}">Back</a>
</div>
@endsection
@section('css')
<link href="{{ asset('category/category.css') }}" rel="stylesheet">
@stop
@section('js')
@stop
