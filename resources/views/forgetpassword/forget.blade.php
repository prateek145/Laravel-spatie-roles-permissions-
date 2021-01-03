@extends('layouts.app')
@section('content')
<h3 class="middle" style="font-weight: 800;">Reset Password</h3>
<form action="{{route('forgetpassword')}}" method="POST" class="middle" style="margin-top:7%; margin-left:50%">
    @csrf
    <input type="email" name="email" placeholder="Email"><br>
    @if($errors->has('email'))
    <p class="alert alert-danger" style="width: 300px;">{{$errors->first('email')}}</p>
    @endif
    <input type="submit" class="button">
</form>

@endsection