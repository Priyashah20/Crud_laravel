@extends('adminlte::page')
@section('title', 'Category')
@section('content')
<div class="row">
  <div class="col-lg-12 margin-tb">
    <div class="pull-left">
      <h2>Category</h2>
    </div>
    <div class="pull-left">
      <a class="btn btn-secondary" href="{{ route('categories.create') }}">Create New Category <i class="fas fa-fw fa-user-plus"></i></a><br><br>
    </div>
  </div>
</div>
<table class="table table-bordered" id="datatable">
  <thead class="table-dark">
    <tr>
      <th class="col-sm-2">Id</th>
      <th class="col-sm-2">Category Name</th>
      <th class="col-sm-2">Product Name</th>
      <th class="col-sm-2">Title</th>
      <th class="col-sm-2">Status</th>
      <th class="col-sm-2 action">Action</th>
    </tr>
  </thead>
</table>
@stop
@section('css')
<link href="{{ asset('category/category.css') }}" rel="stylesheet">
@stop

@section('js')
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

  $(document).ready(function() {
    $('#datatable').DataTable({
      // processing: true,
      // serverSide: true,
      ajax:{url:"{{route('categories.index')}}" },
      order: [[0, 'desc']],
      "pageLength": 10,
      columns: [
      {data: 'id',name:'id'},
      {data:'category_name',name:'category_name'},
      {data:'product_name',name:'product_name'},
      {data:'title',name:'title'},
      {data:'status',name:'status',
      render:function(data,type,raw){
        if(raw.status == '0'){
          return 'active';
        }else{
          return 'in-active';
        }
      },
    },
    {data: 'action', name: 'action', orderable: false},
    ],
  });
  });
</script>
@stop
