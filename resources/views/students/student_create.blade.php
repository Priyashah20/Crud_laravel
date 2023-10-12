@extends('adminlte::page')
@section('title', 'Students')
@section('content')
<div class="row">
  @if(isset($students))
  <h2>Edit Student</h2>
  @else
  <h2>Create New Student</h2>
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
<form action="{{isset($students) ? route('students.update'): route('students.store')}}" method="POST" enctype="multipart/form-data" id="form">
  @csrf
  <input type="hidden" name="id" id="id" value="{{isset($students) ? $students->id : ''}}">
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
      <div class="form-group">
        <strong>Enter Your FirstName:</strong>
        <span class="error">*</span>
        @if ($errors->has('firstname'))
            <span class="firstname" style="color:red">{{ $errors->first('firstname') }}</span>
        @endif
        <input type="text" value="{{isset($students) && !empty($students->firstname) ? $students->firstname : ''}}" name="firstname" class="form-control" placeholder="Enter Your FirstName" autocomplete="off">
      </div>
      <div class="form-group">
        <strong>Enter Your LastName:</strong>
        <span class="error">*</span>
        @if ($errors->has('lastname'))
            <span class="lastname" style="color:red">{{ $errors->first('lastname') }}</span>
        @endif
        <input type="text" value="{{isset($students) && !empty($students->lastname) ? $students->lastname : ''}}" name="lastname" class="form-control" placeholder="Enter Your LastName" autocomplete="off">
      </div>
      <div class="form-group">
        <strong>Enter Your Email:</strong>
        <span class="error">*</span>
        @if ($errors->has('email'))
            <span class="email" style="color:red">{{ $errors->first('email') }}</span>
        @endif
        <input type="email" value="{{isset($students) && !empty($students->email) ? $students->email : ''}}" name="email" class="form-control" placeholder="Enter Your Email" autocomplete="off">
      </div>
      <div class="form-group">
        <strong>Enter Your MobileNo:</strong>
        <span class="error">*</span>
        @if ($errors->has('mobile'))
            <span class="mobile" style="color:red">{{ $errors->first('mobile') }}</span>
        @endif
        <input type="text" value="{{isset($students) && !empty($students->mobile) ? $students->mobile : ''}}" name="mobile" class="form-control" placeholder="Enter Your MobileNo" autocomplete="off">
      </div>
      <div class="form-group gender">
        <strong>Enter Your Gender:</strong>
        <span class="error">*</span>
        @if ($errors->has('gender'))
            <span class="gender" style="color:red">{{ $errors->first('gender') }}</span>
        @endif
        <input type="radio" name="gender" value="0" {{isset($students) && $students->gender == '0' ? 'checked' : ''}}
        @if(isset($data)){{($data->gender)=="Male"? 'checked':''}} @else{{ (old('gender') == 'Male') ? 'checked': '' }}@endif>Male
        <span></span>
        <input type="radio" name="gender" value="1" {{isset($students) && $students->gender == '1' ? 'checked' : ''}}
        @if(isset($data)){{($data->gender)=="Female"? 'checked':''}}@else{{ (old('gender') == 'Female') ? 'checked': '' }}@endif>Female
        <span></span>
      </div>
      <div class="form-group">
        <strong>Enter Your Image:</strong>
        <span class="error">*</span>
        @if ($errors->has('image'))
            <span class="image" style="color:red">{{ $errors->first('image') }}</span>
        @endif
        <input type="file" name="image" class="form-control" placeholder="Image" value="{{isset($students) && !empty($students->image) ? $students->image : ''}}" >
        @if(isset($students) && !empty($students->image))
        <a class="btn btn-primary mt-1" href="{{route('students.getfile',isset($students) ? ($students->id):'')}}"> <i class="fa fa-download"></i></a>
        @endif
      </div>
      <div class="form-group status">
        <strong>Enter Your Status:</strong>
        <span class="error">*</span>
        @if ($errors->has('status'))
            <span class="status" style="color:red">{{ $errors->first('status') }}</span>
        @endif
        <input type="radio" name="status" value="0" {{isset($students) && $students->status == '0' ? 'checked' : ''}}
        @if(isset($data)){{($data->status)=="Active"? 'checked':''}} @else{{ (old('status') == 'Active') ? 'checked': '' }}@endif>Active
        <span></span>
        <input type="radio" name="status" value="1" {{isset($students) && $students->status == '1' ? 'checked' : ''}}
        @if(isset($data)){{($data->status)=="Inactive"? 'checked':''}}@else{{ (old('status') == 'Inactive') ? 'checked': '' }} @endif >Inactive
        <span></span>
      </div>
      <div class="form-group">
        <strong>Enter Your Address:</strong>
        <span class="error">*</span>
        @if ($errors->has('address'))
            <span class="address" style="color:red">{{ $errors->first('address') }}</span>
        @endif
        <textarea name="address" class="form-control" placeholder="Enter Your Address">@if(isset($students)){{$students->address}}@endif{{old('address')}}</textarea>
      </div>
      <div class="form-group">
        <strong>City:</strong>
        <span class="error">*</span>
        @if ($errors->has('city'))
        <span class="city" style="color:red">{{ $errors->first('city') }}</span>
        @endif
        <select name="city" id="city">
            <option value="selectcity">Select City</option>
            <option value="ahmedabad"{{isset($students) && $students->city=='ahmedabad'? 'selected' :''}}>Ahmedabad</option>
            <option value="surat"{{isset($students) && $students->city=='surat'? 'selected' :''}}>Surat</option>
            <option value="vadodara" {{isset($students) && $students->city=='vadodara'? 'selected' :''}}>Vadodara</option>
            <option value="mumbai" {{isset($students) && $students->city=='mumbai'? 'selected' :''}}>Mumbai</option>
        </select>
     </div>
      <div class="form-group">
        <strong>State:</strong>
        <span class="error">*</span>
        @if ($errors->has('state'))
        <span class="state" style="color:red">{{ $errors->first('state') }}</span>
        @endif
        <select name="state" id="state">
            <option value="selectstate">Select State</option>
            <option value="gujarat"{{isset($students) && $students->state=='gujarat'? 'selected' :''}}>Gujarat</option>
            <option value="maharashtra"{{isset($students) && $students->state=='maharashtra'? 'selected' :''}}>Maharashtra</option>
        </select>
     </div>
     <div class="form-group">
       <strong>Semester:</strong>
       <span class="error">*</span>
       @if ($errors->has('semester'))
       <span class="semester" style="color:red">{{ $errors->first('semester') }}</span>
       @endif
        <select name="semester" id ="semester">
            <option value="">Select Semester</option>
            <option value="1" {{isset($students) && $students->semester=='1'?'selected':''}}>1</option>
            <option value="2" {{isset($students) && $students->semester=='2'?'selected':''}}>2</option>
            <option value="3" {{isset($students) && $students->semester=='3'?'selected':''}}>3</option>
            <option value="4" {{isset($students) && $students->semester=='4'?'selected':''}}>4</option>
        </select>
     </div>
        <div class="form-group">
        <strong>Hobby:</strong>
        <span class="error">*</span>
        @if ($errors->has('hobby'))
        <span class="hobby" style="color:red">{{ $errors->first('hobby') }}</span>
        @endif
            <input type="checkbox" name="hobby[]" value="cricket" {{isset($students) ? (in_array('cricket', $hobby) ? 'checked' : '') : '' }}> Cricket
            <input type="checkbox" name="hobby[]" value="singing" {{isset($students) ? (in_array('singing', $hobby) ? 'checked' : '' ): ''}}> Singing
            <input type="checkbox" name="hobby[]" value="playing" {{isset($students) ? (in_array('playing', $hobby) ? 'checked' : '' ): ''}}> Playing
            <input type="checkbox" name="hobby[]" value="reading" {{isset ($students) ? (in_array('reading', $hobby) ? 'checked' : ''):''}}> Reading
        </div>
        <div class="department_list">
        </div>
        </div>
        @if(isset($students))
          <input type="hidden" name="id" id="id" value="{{$students->id}}">
        @endif
        <div class="pull-right">
          <button type="submit" class="btn btn-primary">Submit</button>
          <a class="btn btn-warning" href="{{ route('students.index') }}">Back</a>
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
          maxlength: 10,
          number:true,
        },
        gender:{
          required:true
        },
        status:{
          required:true
        },
        address:{
          required:true
        },
        city:{
          required:true
        },
        semester:{
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
        gender: 'Select Your Gender.',
        status:'Select Your Status.',
        address:'Please Enter Your Address.',
        city:'Please Enter Your City.',
        semester:'Please Enter Your Semester.'
      },
      errorPlacement: function(error, element)
      {
        if(element.is(":radio"))
        {
          error.appendTo(element.parents('.gender,.status'));
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
<script>
    $(document).ready(function (){
        $('#city').on('change', function () {
            var id = $(this).val();
            if(id=='ahmedabad' || id=='surat' || id=='vadodara')
            {
                $("#state").val('gujarat');
            }
            else if(id=='mumbai'){
                $("#state").val('maharashtra');
            }
            else{
                $('#state').val('selectstate');
            }
        });
    });

</script>
<script>
   $(document).ready(function(){
         var id = $('#id').val();
         // var id = '{{isset($students) ? $students->id : ''}}';
        // alert(id);
         $_token = "{{ csrf_token() }}";
         $.ajax({
            headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
            url: "{{ route('departmentlist') }}",
            type: 'POST',
            data: {'id':id,'_token': $_token },
            datatype: 'json',
            success: function(data) {
                console.log(data);
                $('.department_list').html(data.html);
            }
        });
    });
</script>
@stop
