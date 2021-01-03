@extends('layouts.admin')
@section('content')

<div class="d-flex justify-content-between mb-5">
    <h5>User</h5>
    <a href="{{route('user.index')}}" ><button class="btn btn-danger btn-sm px-5">return back </button></a>
</div>

<div style="margin-top:4%; margin-left:10%; margin-right:10%;">
    <form action="{{route ('user.store')}}" method="POST" >
        @csrf
        @if($errors->has('name'))
        <p class = "alert alert-danger  form-control" > {{$errors->first('name')}}</p>
        @endif
        <input type="text" name="name" placeholder="Name" class="form-control" value="{{old('name')}}"><br>
        @if($errors->has('email'))
        <p class = "alert alert-danger form-control" > {{$errors->first('email')}}</p>
        @endif
        <input type="text" name="email" placeholder="Email" class="form-control" value="{{old('email')}}"><br>
        @if($errors->has('password'))
        <p class = "alert alert-danger form-control" > {{$errors->first('password')}}</p>
        @endif
        <input type="password" name="password" placeholder="Enter Password" class="form-control"><br>
        @if($errors->has('re_password'))
        <p class = "alert alert-danger form-control" > {{$errors->first('re_password')}}</p>
        @endif
        <input type="password" name="re_password" placeholder="Re Password" class="form-control"><br>
        <input type="submit" class="btn btn-success"><br>
        @if(session()->has('error'))
        <p class="alert alert-danger form-control">{{session()->get('error')}}</p>
        @endif 
    </form>

</div>
@endsection