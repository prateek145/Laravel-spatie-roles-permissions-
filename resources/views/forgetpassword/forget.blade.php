@extends('layouts.admin')
@section('content')
<h5 class="middle" style="font-weight: 500;">Change Password</h5><br>
<form action="{{route('forgetpassword')}}" method="POST" class="middle" style="margin-top:7%; margin-left:50%">
    @csrf
    <input type="password" name="passwordb" placeholder="Current password" class="col-md-4 form-control"><br>
    @if($errors->has('passwordb'))
    <p class="text-danger" style="width: 300px;">{{$errors->first('passwordb')}}</p>
    @endif

    <input type="password" name="password" placeholder=" password" class="col-md-4 form-control"><br>
    @if($errors->has('password'))
    <p class="text-danger" style="width: 300px;">{{$errors->first('password')}}</p>
    @endif

    <input type="password" name="password1" placeholder="Re-password" class="col-md-4 form-control"><br>
    @if($errors->has('password1'))
    <p class="text-danger" style="width: 300px;">{{$errors->first('password1')}}</p>
    @endif

    <input type="submit" class="btn btn-success">
</form>

@endsection