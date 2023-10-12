@extends('adminlte::page')
@section('title', 'Products')
@section('content')
<div class="row">
  <div class="col-lg-12 margin-tb">
    <div class="pull-left">
      <h2>Products</h2>
    </div>
    <div class="pull-left">
      <a class="btn btn-secondary" href="{{ route('products.create') }}">Create New Product <i class="fas fa-fw fa-user-plus"></i></a><br><br>
    </div>
  </div>
</div>
<table class="table table-bordered" id="datatable">
  <thead class="table-dark">
    <tr>
      <th>id</th>
      <th>Name</th>
      <th>Price</th>
      <th>Quantity</th>
      <th class="action">Desctiption</th>
      <th>Category Name</th>
      <th>Status</th>
      <th class="action">Action</th>
  </tr>
</thead>
</table>
@stop
@section('css')
<link href="{{ asset('product/product.css') }}" rel="stylesheet">
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
        ajax:{url:"{{route('products.index')}}" },
        order: [[0, 'desc']],
        "pageLength": 10,
        columns: [
        {data: 'id',name:'id'},
        {data:'name',name:'name'},
        {data:'price',name:'price'},
        {data:'quantity',name:'quantity'},
        {data:'description',name:'description'},
        {data:'category_name',name:'category_name'},
        {data:'status',name:'status',orderable:false,
        render: function ( data, type, full, meta ) {
         return '<label class="switch"><input data-id= ' + full['id'] + ' type="checkbox" class="toggle-class" checked data-on="Active" data-off="Inactive" data-toggle="toggle" data-onstyle="success" data-offstyle="danger"><span class="slider round"></span></label>';
        }},
        {data: 'action', name: 'action', orderable: false},
        ],
    });
});
  $(document).on('change', '.toggle-class', function() {
    var status = $(this).prop('checked') == true ? 'Active' : 'Inactive';
    var userid = $(this).data('id');
    console.log(userid);
    console.log(status);
    $.ajax({
        type: "GET",
        dataType: "json",
        url:'{{route("products.changeStatus")}}',
        data: {'status': status, 'userid': userid},
        success:function(response){
        toastr.success(response.message);
    },
    error:function(response) {
        toastr.error(response.responseJSON.message);
    }
});
})
</script>
@stop
