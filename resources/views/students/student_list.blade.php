@extends('adminlte::page')
@section('title', 'Students')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <h2>Student</h2>
        <a class="btn btn-secondary" href="{{ route('students.create') }}">Create New Student &nbsp;<i class="fas fa-fw fa-user-plus"></i></a>
    </div>
</div>
<br>
<table class="table table-bordered student-list" id="datatable">
  <thead class="table-dark">
    <tr>
        <th>Id</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>Mobile</th>
        <th>Gender</th>
        <th>Image</th>
        <th>Status</th>
        <th>Address</th>
        <th>City</th>
        <th>State</th>
        <th>Semester</th>
        <th>Hobby</th>
        <th>Action</th>
    </tr>
</thead>
</table>
@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
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
    ajax:{url:"{{route('students.index')}}" },
    order: [[0, 'desc']],
    "pageLength": 10,
    columns: [
                // {data:'DT_RowIndex', 'orderable': true, 'searchable': true, name:'id'},
            {data:'id', name:'id'},
            {data:'firstname',name:'firstname'},
            {data:'lastname',name:'lastname'},
            {data:'email',name:'email'},
            {data:'mobile',name:'mobile'},
            {data:'gender',name:'gender',
            render:function(data,type,raw){
                if(raw.gender == '0'){
                    return 'Male';
                } else{
                    return 'Female';
                }
            },
            },
            {data:'image',name:'image',
                render:function(data, type, row, meta){
                    if (data != null) {
                        return '<a href="{{route('students.getfile')}}/'+row.id+'"><i class="fa fa-file-download"></i></a>'
                    }
                }
            },
            {data:'status',name:'status',
            render:function(data,type,raw){
                if(raw.status == '0'){
                    return 'Active';
                }else{
                    return 'Inactive';
                }
            },
            },
            {data:'address',name:'address'},
            {data:'city',name:'city'},
            {data:'state',name:'state'},
            {data:'semester',name:'semester'},
            {data:'hobby',name:'hobby'},
            {data:'action'}
        ],
    });
});
</script>
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
            url: '{{route('students.destroy')}}',
            data: {id:id},
            success: function(response) {
                console.log(response);
                $('.student-list').DataTable().ajax.reload();
            }
        });
    });
    });
</script>
@stop
@endsection
