@extends('adminlte::page')
@section('title', 'User')
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Users</h2>
        </div>
        <div class="pull-left">
            <a class="btn btn-secondary" href="{{ route('users.create') }}">Create New User <i class="fas fa-fw fa-user-plus"></i></a><br><br>
        </div>
    </div>
</div>
<table class="table table-bordered" id="datatable">
    <thead class="table-dark">
        <tr>
            <th>No</th>
            <th>Username</th>
            <th>MobileNo</th>
            <th>Email</th>
            <th>Image</th>
            <th>Status</th>
            <th class="action">Action</th>
        </tr>
    </thead>
</table>
@stop
@section('css')
<link href="{{ asset('profile/profile.css') }}" rel="stylesheet">
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
        processing: true,
        serverSide: true,
        ajax:{url:"{{route('users.index')}}" },
        order: [[0, 'desc']],
        "pageLength": 10,
        columns: [
        {data: 'DT_RowIndex', 'orderable': true, 'searchable': true },
        {data:'username'},
        {data: 'number',render: function ( data, type, row ) {
            return row.number + '<br>';}},
        {data:'email'},
        {data:'image',name: 'image',orderable:false,
            render: function(data, type, full, meta){
                return "<img src={{ URL::to('/') }}/image/" + data + " width='70' class='img-thumbnail' />";
            },
        },
        {data:'status',name:'status',orderable:false,
            render: function ( data, type, full, meta ) {
             return '<label class="switch"><input data-id= ' + full['id'] + ' type="checkbox" class="toggle-class" checked data-on="Block" data-off="Unblock" data-toggle="toggle" data-onstyle="success" data-offstyle="danger"><span class="slider round"></span></label>';
     }},
     {data: 'action', name: 'action', orderable: false},
     ],
 });
  });
    $(document).on('change', '.toggle-class', function() {
        var status = $(this).prop('checked') == true ? 'Unblock' : 'Block';
        var userid = $(this).data('id');
        console.log(userid);
        console.log(status);
        $.ajax({
            type: "GET",
            dataType: "json",
            url:'{{route("users.changeStatus")}}',
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
