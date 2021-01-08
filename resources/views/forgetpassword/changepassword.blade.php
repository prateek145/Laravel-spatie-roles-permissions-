@extends('layouts.admin')
@section('content')
<h5 class="middle" style="font-weight: 500;">Enter passoword</h5><br>
<form action="{{route ('ChangePasswordSave')}}" method="POST" style="margin-left: 50%; margin-top:5%;">
    @csrf
    @if($errors->has('password'))
    <p class="alert alert-danger" style="width: 300px;">{{$errors->first('password')}}</p>
    @endif
    @if($errors->has('password1'))
    <p class="alert alert-danger" style="width: 300px;">{{$errors->first('password1')}}</p>
    @endif

    <input type="password" name="password" placeholder="Enter Password" class="col-md-4 form-control"><br>
    <input type="password" name="password1" placeholder="Re Password" class="col-md-4 form-control"><br>
    <input type="hidden" name="hidden" value="{{session()->get('id')}}">
    @if(session()->has('error'))
    <p class="alert alert-danger" style="width:300px">{{session()->get('error')}}</p><br>
    @endif 
    <input type="submit" class="btn btn-success">
</form>

@endsection