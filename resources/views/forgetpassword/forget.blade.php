@extends('layouts.admin')
@section('content')
<h5 class="middle" style="font-weight: 500;">Change Password</h5><br>
<form action="{{route('forgetpassword')}}" method="POST" class="middle" style="margin-top:7%; margin-left:50%">
    @csrf
    <input type="email" name="email" placeholder="Email" class="col-md-4 form-control"><br>
    @if($errors->has('email'))
    <p class="alert-danger" style="width: 300px;">{{$errors->first('email')}}</p>
    @endif
    <input type="submit" class="btn btn-success">
</form>

@endsection