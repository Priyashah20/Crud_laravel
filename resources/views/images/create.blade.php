@extends('adminlte::page')
@section('content')
<html lang="en">
<head>
    <title>Laravel 8 multiple image upload Tutorial</title>
</head>
<body>
<div class="container lst">
    <h1>multiple image upload Tutorial</h1>
    @if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <form method="post" action="{{ route('file.post') }}" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="control-group">
            <input type="file" name="image[]" class="myfrm form-control" multiple>
        </div>
        <button type="submit" class="btn btn-success" style="margin-top:10px">Upload</button>
    </form>
</div>
</body>
</html>
@endsection

@section('css')
<link href="{{ asset('profile/profile.css') }}" rel="stylesheet">
@stop

@section('js')
@stop
