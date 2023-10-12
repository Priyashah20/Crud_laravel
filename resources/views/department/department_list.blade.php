@extends('adminlte::page')
@section('title', 'Department')
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Department</h2>
        </div>
    <div class="pull-left">
        <a class="btn btn-secondary" href="{{ route('department.create') }}">Create New Department <i class="fas fa-fw fa-user-plus"></i></a><br><br>
    </div>
  </div>
</div>
<table class="table table-bordered department-list" id="datatable">
    <thead class="table-dark">
        <tr>
            <th class ="col-sm-1">Id</th>
            <th class ="col-sm-2">Name</th>
            <th class ="col-sm-2">Student</th>
            <th class ="col-sm-2">Title</th>
            <th class ="col-sm-2">Semester</th>
            <th class ="col-sm-2">Status</th>
            <th class ="col-sm-1 action">Action</th>
        </tr>
    </thead>
</table>
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
      ajax:{url:"{{route('department.index')}}" },
      order: [[0, 'desc']],
      "pageLength": 10,
      columns: [
      {data:'id',name:'id'},
      {data:'name',name:'name'},
      {data:'firstname',name:'firstname'},
      {data:'title',name:'title'},
      {data:'semester',name:'semester'},
      {data:'status',name:'status',
      render:function(data,type,raw){
        if(raw.status == '0'){
          return 'Active';
        }else{
          return 'In-active';
        }
      },
    },
    {data: 'action', name: 'action', orderable: false},
    ],
  });
  });
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
<script>
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
    $(document).on('click','.delete',function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        swal({
          title: "Are you sure?",
          text: "Once deleted, you will not be able to recover this imaginary file!",
          icon: "warning",
          buttons: true,
          dangerMode: true,
      })
        .then((willDelete) => {
          if (willDelete) {
            swal("Poof! Your imaginary file has been deleted!", {
              icon: "success",
          });
        } else {
            swal("Your imaginary file is safe!");
        }
        $.ajax({
            type: "POST",
            url: '{{route('department.destroy')}}',
            data: {id:id},
            success: function(response) {
                console.log(response);
                $('.department-list').DataTable().ajax.reload();
            }
        });
    });
    });
</script>
@stop
