@extends('adminlte::page')
@section('title', 'Teacher')
@section('content')
<div class="row">
 @if(isset($teacher))
 <h1>Edit Teacher</h1>
 @else
 <h1>Create New Teacher</h1>
 @endif
</div>

<form action="{{isset($teacher) ? route('teacher.update'): route('teacher.store')}}" method="POST" enctype="multipart/form-data" id="form">
  @csrf
  <input type="hidden" name="id" value="{{isset($teacher) ? $teacher->id : ''}}">
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
      <div class="form-group">
        <strong>Enter Your FirstName:</strong>
        <span class="error">*</span>
        @if ($errors->has('firstname'))
        <span class="firstname" style="color:red">{{ $errors->first('firstname') }}</span>
        @endif
        <input type="text" value="{{isset($teacher) && !empty($teacher->firstname) ? $teacher->firstname : ''}}" name="firstname" class="form-control" placeholder="Enter Your FirstName" autocomplete="off">
      </div>

      <div class="form-group">
        <strong>Enter Your LastName:</strong>
        <span class="error">*</span>
        @if ($errors->has('lastname'))
        <span class="lastname" style="color:red">{{ $errors->first('lastname') }}</span>
        @endif
        <input type="text" value="{{isset($teacher) && !empty($teacher->lastname) ? $teacher->lastname : ''}}" name="lastname" class="form-control" placeholder="Enter Your LastName" autocomplete="off">
      </div>

      <div class="form-group">
        <strong>Enter Your Email:</strong>
        <span class="error">*</span>
        @if ($errors->has('email'))
        <span class="email" style="color:red">{{ $errors->first('email') }}</span>
        @endif
        <input type="email" value="{{isset($teacher) && !empty($teacher->email) ? $teacher->email : ''}}" name="email" class="form-control" placeholder="Enter Your Email" autocomplete="off">
      </div>

      <div class="form-group">
        <strong>Enter Your MobileNo:</strong>
        <span class="error">*</span>
        @if ($errors->has('mobile'))
        <span class="mobile" style="color:red">{{ $errors->first('mobile') }}</span>
        @endif
        <input type="text" value="{{isset($teacher) && !empty($teacher->mobile) ? $teacher->mobile : ''}}" name="mobile" class="form-control" placeholder="Enter Your MobileNo" autocomplete="off">
      </div>

      <div class="form-group">
        <strong>Subject:</strong>
        <span class="error">*</span>
        @if ($errors->has('subject'))
        <span class="subject" style="color:red">{{ $errors->first('subject') }}</span>
        @endif
        <select name="subject" id ="subject">
          <option value="">Select Subject</option>
          <option value="php" {{isset($teacher) && $teacher->subject=='php'?'selected':''}}>php</option>
          <option value="laravel" {{isset($teacher) && $teacher->subject=='laravel'?'selected':''}}>Laravel</option>
          <option value="java" {{isset($teacher) && $teacher->subject=='java'?'selected':''}}>Java</option>
        </select>
      </div>

      <div class="form-group">
        <strong>Enter Your Image:</strong>
        <span class="error">*</span>
        @if ($errors->has('image'))
        <span class="image" style="color:red">{{ $errors->first('image') }}</span>
        @endif
        <input type="file" name="image" class="form-control" placeholder="Image" value="{{isset($teacher) && !empty($teacher->image) ? $teacher->image : ''}}" >
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
        <input type="radio" name="gender" value="0" {{isset($teacher) && $teacher->gender == '0' ? 'checked' : ''}}
        @if(isset($data)){{($data->gender)=="Male"? 'checked':''}} @else{{ (old('gender') == 'Male') ? 'checked': '' }}@endif>Male
        <span></span>
        <input type="radio" name="gender" value="1" {{isset($teacher) && $teacher->gender == '1' ? 'checked' : ''}}
        @if(isset($data)){{($data->gender)=="Female"? 'checked':''}}@else{{ (old('gender') == 'Female') ? 'checked': '' }}@endif>Female
        <span></span>
      </div>
    </div>
  </div>
  @if(isset($teacher))
  <input type="hidden" name="id" id="id" value="{{$teacher->id}}">
  @endif
  <div class="pull-right">
    <a class="btn btn-warning" href="{{ route('teacher.index') }}">Back</a>
    <button type="submit" class="btn btn-primary">Submit</button>
  </div>
</form>
@endsection

@section('css')
<link href="{{ asset('students/student.css') }}" rel="stylesheet">
@stop
@section('js')
<script type="text/javascript">
  $(document).ready(function () {
    $('form').validate({
      rules: {
        firstname: {
          required: true
        },
        lastname: {
          required: true
        },
        email: {
          required: true,
          email: true,
          remote: {
            url: '{{ url("validate_email") }}',
          },
        },
        mobile: {
          required: true,
          minlength: 10,
          number:true,
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
