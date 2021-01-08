@extends('layouts.admin')
@section('content')

<div class="d-flex justify-content-between mb-5">
    <h5>User</h5>
    <a href="{{route('user.index')}}"><button class="btn btn-danger btn-sm px-5">return back </button></a>
</div>

<div style="margin-top:4%; margin-left:10%; margin-right:10%;">
    <form action="{{route ('user.store')}}" method="POST">
        @csrf
        <input type="text" name="name" placeholder="Name" class="form-control @error('name') is-invalid @enderror" value="{{old('name')}}"><br>
        @if($errors->has('name'))
        <p class=" text-danger "> {{$errors->first('name')}}</p>
        @endif

        <input type="text" name="email" placeholder="Email" class="form-control @error('email') is-invalid @enderror" value="{{old('email')}}"><br>
        @if($errors->has('email'))
        <p class="text-danger "> {{$errors->first('email')}}</p>
        @endif

        <input type="password" name="password" placeholder="Enter Password" class="form-control @error('password') is-invalid @enderror"><br>
        @if($errors->has('password'))
        <p class="text-danger"> {{$errors->first('password')}}</p>
        @endif

        <input type="password" name="re_password" placeholder="Re Password" class="form-control @error('re_password') is-invalid @enderror"><br>
        @if($errors->has('re_password'))
        <p class="text-danger "> {{$errors->first('re_password')}}</p>
        @endif


        <div>
            <h5>Roles</h5>
            @foreach($role as $roles)
            <input type="checkbox" name="roles[]" value="{{$roles->id}}">
            <label for="">{{$roles->name}}</label>
            @endforeach
        </div><br>


        <div>
            <h5>Permissions</h5>
            @foreach($permissions as $permission)
            <input type="checkbox" name="permissions[]" value="{{$permission->id}}">
            <label for="">{{$permission->name}}</label>
            @endforeach
        </div><br>

        <input type="submit" class="btn btn-success"><br>
        @if(session()->has('error'))
        <p class="text-danger ">{{session()->get('error')}}</p>
        @endif
    </form>

</div>
@endsection