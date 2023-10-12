@extends('adminlte::page')
@section('title','Teacher')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <h2>Teacher</h2>
        <a class="btn btn-secondary" href="javascript:void(0)" id="createNewTeacher">Create New Teacher &nbsp;<i class="fas fa-fw fa-user-plus"></i></a>
    </div>
</div>
</br>
<table class="table table-bordered teacher-list" id="datatable">
  <thead class="table-dark">
    <tr>
        <th class="col-sm-1">Id</th>
        <th class="col-sm-1">First Name</th>
        <th class="col-sm-1">Last Name</th>
        <th class="col-sm-1">Email</th>
        <th class="col-sm-1">Mobile</th>
        <th class="col-sm-2">Subject</th>
        <th class="col-sm-2">Image</th>
        <th class="col-sm-1">Gender</th>
        <th class="col-sm-2">Action</th>
    </tr>
</thead>
</table>
<div class="modal fade" id="ajaxModel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading"></h4>
                <button type="button" class="btn-close"  data-bs-dismiss="modal" aria-label="close"></button>
            </div>
            <div class="modal-body">
                <div class="teacher_form"></div>
                <form method="POST" enctype="multipart/form-data" id="teacherForm" name="teacherForm" class="form-horizontal">
                    @csrf
                    <input type="hidden" name="id" id="id">
                    <div class="form-group">
                        <strong>Enter Your FirstName:</strong>
                        <span class="error">*</span>
                        @if ($errors->has('firstname'))
                            <span class="firstname" style="color:red">{{ $errors->first('firstname') }}</span>
                        @endif
                        <input type="text" value="{{isset($teacher) && !empty($teacher->firstname) ? $teacher->firstname : ''}}" name="firstname" id="firstname" class="form-control" placeholder="Enter Your FirstName">
                    </div>
                    <div class="form-group">
                        <strong>Enter Your LastName:</strong>
                        <span class="error">*</span>
                        @if ($errors->has('lastname'))
                        <span class="lastname" style="color:red">{{ $errors->first('lastname') }}</span>
                        @endif
                        <input type="text" value="{{isset($teacher) && !empty($teacher->lastname) ? $teacher->lastname : ''}}" name="lastname" id="lastname" class="form-control" placeholder="Enter Your LastName" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <strong>Enter Your Email:</strong>
                        <span class="error">*</span>
                        @if ($errors->has('email'))
                        <span class="email" style="color:red">{{ $errors->first('email') }}</span>
                        @endif
                        <input type="email" value="{{isset($teacher) && !empty($teacher->email) ? $teacher->email : ''}}" name="email" class="form-control" id="email"placeholder="Enter Your Email" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <strong>Enter Your MobileNo:</strong>
                        <span class="error">*</span>
                        @if ($errors->has('mobile'))
                            <span class="mobile" style="color:red">{{ $errors->first('mobile') }}</span>
                        @endif
                        <input type="text" value="{{isset($teacher) && !empty($teacher->mobile) ? $teacher->mobile : ''}}" name="mobile" id="mobile" class="form-control" placeholder="Enter Your MobileNo" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <strong>Subject:</strong>
                        <span class="error">*</span>
                        @if ($errors->has('subject'))
                        <span class="subject" style="color:red">{{ $errors->first('subject') }}</span>
                        @endif
                        <select name="subject" id ="subject">
                            <option value="">Select Subject</option>
                            <option value="php" {{isset($teacher) && $teacher->subject=='php'?'selected':''}}>Php</option>
                            <option value="laravel" {{isset($teacher) && $teacher->subject=='laravel'?'selected':''}}>Laravel</option>
                            <option value="java" {{isset($teacher) && $teacher->subject=='java'?'selected':''}}>Java</option>
                            <option value="html" {{isset($teacher) && $teacher->subject=='html'?'selected':''}}>Html</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <strong>Enter Your Image:</strong>
                        <span class="error">*</span>
                        @if ($errors->has('image'))
                        <span class="image" style="color:red">{{ $errors->first('image') }}</span>
                        @endif
                        <input type="file" name="image" id="image" class="form-control" >
                        @if(isset($teacher) && !empty($teacher->image))
                            <a class="btn btn-primary mt-1" href="{{route('teacher.getfile',isset($teacher) ? ($teacher->id):'')}}"> <i class="fa fa-download"></i></a>
                        @endif
                    </div>
                    <div class="form-group gender">
                        <strong>Enter Your Gender:</strong>
                        <span class="error">*</span>
                        @if ($errors->has('gender'))
                        <span class="gender" style="color:red">{{ $errors->first('gender') }}</span>
                        @endif
                        <input type="radio" name="gender" id="gender" value="0" {{isset($teacher) && $teacher->gender == '0' ? 'checked' : ''}}>Male
                        <span></span>
                        <input type="radio" name="gender" id="gender" value="1" {{isset($teacher) && $teacher->gender == '1' ? 'checked' : ''}}>Female
                        <span></span>
                    </div>
                    <div class="form-group">
                        <strong>Status</strong>
                        <span class="error">*</span>
                        @if ($errors->has('status'))
                        <span class="status">{{ $errors->first('status') }}</span>
                        @endif
                        <input type="radio" name="status" id="status" value="0"
                        {{isset($teacher) && $teacher->status == '0' ? 'checked' : ''}}>Active
                        <span></span>
                        <input type="radio" name="status" id="status" value="1"
                       {{isset($teacher) && $teacher->status == '1' ? 'checked' : ''}}>Inactive
                        <span></span>
                    </div>
                    <div class="pull-right">
                      <a class="btn btn-warning" href="{{ route('teacher.index') }}">Back</a>
                      <button type="submit" class="btn btn-primary" id="saveBtn submit" class="submit">Submit</button>
                  </div>
                </form>
            </div>
        </div>
    </div>
</div>
@section('css')
<link href="{{ asset('students/student.css') }}" rel="stylesheet">
@stop
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
        ajax:{url:"{{route('teacher.index')}}"},
        order: [[0, 'desc']],
        "pageLength": 10,
        columns: [
           // {data:'id',name:'id'},
            {data:'DT_RowIndex', 'orderable': true, 'searchable': true, name:'id'},
            {data:'firstname',name:'firstname'},
            {data:'lastname',name:'lastname'},
            {data:'email',name:'email'},
            {data:'mobile',name:'mobile'},
            {data:'subject',name:'subject'},
            {data:'image',name:'image',"defaultContent":"",
            render:function(data, type, row, meta){
                if (data != null) {
                    return '<a href="{{route('teacher.getfile')}}/'+row.id+'"><i class="fa fa-file-download"></i></a>'
                }
            }
        },
            {data:'gender',name:'gender',
            render:function(data,type,raw){
                if(raw.gender == '0'){
                  return 'Male';
                } else{
                  return 'Female';
                }
            },
        },
            {data: 'action', name: 'action', orderable: false},
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
                url: '{{route('teacher.destroy')}}',
                data: {id:id},
                success: function(response) {
                    console.log(response);
                $('.teacher-list').DataTable().ajax.reload();
            }
        });
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#createNewTeacher').click(function() {
            $('#saveBtn').val("create-teacher");
            $('#id').val('');
            $('#teacherForm').trigger("reset");
            $('#modelHeading').html("Create New Teacher");
            $('#ajaxModel').modal('show');
        });
        $('body').on('click','.editTeacher',function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            $('#teacherForm').trigger("reset");
            $('#modelHeading').html("Edit Teacher");
            $('#saveBtn').val("edit-user");
            $('#ajaxModel').modal('show');
            $.ajax({
                type: "post",
                dataType: 'json',
                url: '{{route('teacher.edit')}}',
                data:{id:id,_token: '{{csrf_token()}}'},
                success: function (response) {
                    $('#id').val(response.id);
                    $('#firstname').val(response.firstname);
                    $('#lastname').val(response.lastname);
                    $('#email').val(response.email);
                    $('#mobile').val(response.mobile);
                    $('#subject').val(response.subject);
                    // $('#image').val(response.image);
                    $("input[name=gender][value=" + response.gender + "]").prop('checked', true);
                    $("input[name=status][value=" + response.status + "]").prop('checked', true);
                },
            });
        });
        $('#teacherForm').validate({
            rules:{
                firstname:{
                    required: true
                },
                lastname:{
                    required: true
                },
                email:{
                    required: true,
                    email: true,
                    remote: {
                        /*type: "post",
                        data:{id:id,_token: '{{csrf_token()}}'},*/
                        url: '{{route('teacher.email')}}',
                    },
                },
                mobile:{
                    required: true,
                },
                subject:{
                    required:true
                },
                gender:{
                    required:true
                }
            },
            messages: {
                firstname: 'Please Enter Your First Name.',
                lastname: 'Please Enter Your Last Name.',
                email: {
                    required: 'Please Enter Email Address.',
                    email: 'Please enter a valid Email Address.',
                    remote:'Email already exists.',
                },
                mobile:{
                    required:'Please Enter Your Mobile Number.',
                    number:"Please Enter Numbers Only",
                },
                subject:'Select Your Subject.',
                gender: 'Select Your Gender.'
            },
            errorPlacement: function(error, element)
            {
                if(element.is(":radio"))
                {
                  error.appendTo(element.parents('.gender'));
                }
                else{
                  error.insertAfter( element );
                }
            },
            submitHandler: function() {
                $.ajax({
                    type : "POST",
                    dataType: 'json',
                    url : "{{route('teacher.store')}}",
                    data : $('#teacherForm').serialize(),
                    success: function(){
                        console.log('success');
                        $('#ajaxModel').modal('hide');
                        $('.teacher-list').DataTable().ajax.reload();
                    }
                });
            }
        });
    });
</script>
@stop
@endsection
