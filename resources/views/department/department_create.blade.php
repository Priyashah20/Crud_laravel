@extends('adminlte::page')
@section('title', 'Department')
@section('content')
<div class="row">
    @if(isset($department))
    <h2>Edit Department</h2>
    @else
    <h2>Create New Department</h2>
    @endif
</div>
@if(Session::has('success'))
<div class="alert alert-success">
    {{ Session::get('success') }}
    @php
    Session::forget('success');
    @endphp
</div>
@endif
<form action="{{isset($department) ? route('department.update'): route('department.store')}}" method="POST" enctype="multipart/form-data" id="form">
    @csrf
    <input type="hidden" name="id" value="{{isset($department) ? $department->id : ''}}">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name</strong>
                <span class="error">*</span>
                @if ($errors->has('name'))
                <span class="name" style="color:red">{{ $errors->first('name') }}</span>
                @endif
                <input type="text" value="{{isset($department) && !empty($department->name) ? $department->name : ''}}" name="name" class="form-control" placeholder="Enter Your Name" autocomplete="off">
            </div>
            <div class="form-group">
                <strong>Semester:</strong>
                <span class="error">*</span>
                @if ($errors->has('semester'))
                <span class="semester" style="color:red">{{ $errors->first('semester') }}</span>
                @endif
                <select name="semester" id ="semester">
                    <option value="">Select Semester</option>
                    <option value="1" {{isset($department) && $department->semester=='1'?'selected':''}}>1</option>
                    <option value="2" {{isset($department) && $department->semester=='2'?'selected':''}}>2</option>
                    <option value="3" {{isset($department) && $department->semester=='3'?'selected':''}}>3</option>
                    <option value="4" {{isset($department) && $department->semester=='4'?'selected':''}}>4</option>
                </select>
            </div>
            <div class="form-group status">
                <strong>Enter Your Status:</strong>
                <span class="error">*</span>
                @if ($errors->has('status'))
                <span class="status" style="color:red">{{ $errors->first('status') }}</span>
                @endif
                <input type="radio" name="status" value="0" {{isset($department) && $department->status == '0' ? 'checked' : ''}}
                @if(isset($data)){{($data->status)=="Active"? 'checked':''}} @else{{ (old('status') == 'Active') ? 'checked': '' }}@endif>Active
                <span></span>
                <input type="radio" name="status" value="1" {{isset($department) && $department->status == '1' ? 'checked' : ''}}
                @if(isset($data)){{($data->status)=="Inactive"? 'checked':''}}@else{{ (old('status') == 'Inactive') ? 'checked': '' }} @endif >Inactive
                <span></span>
            </div>
        </div>
    </div>
    @if(isset($department))
    <input type="hidden" name="id" id="id" value="{{$department->id}}">
    @endif
    <div class="pull-right">
        <button type="submit" class="btn btn-primary">Submit</button>
        <a class="btn btn-warning" href="{{ route('department.index') }}">Back</a>
    </div>
</form>
@endsection

@section('css')
<link href="{{ asset('students/student.css') }}" rel="stylesheet">
@stop

@section('js')
<script type="text/javascript">
    $(document).ready(function () {
        $('#form').validate({
            rules: {
                name: {
                    required: true
                },
                semester:{
                    required:true
                },
                status:{
                    required:true
                }
            },
            messages: {
                name: 'Please Enter Your Name.',
                status:'Select Your Status.',
                semester:'Please Enter Your Semester.'
            },
            errorPlacement: function(error, element)
            {
                if(element.is(":radio"))
                {
                    error.appendTo(element.parents('.status'));
                }
                else
                {
                    error.insertAfter( element );
                }
            },
            submitHandler: function (form) {
                form.submit();
            }
        });
    });
</script>
@stop
