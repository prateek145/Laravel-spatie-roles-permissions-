@extends('layouts.admin')
@section('content')
<div class="d-flex justify-content-between mb-5">
    <h5>Users</h5>
    <a href="{{route('user.index')}}"><button class="btn btn-danger btn-sm px-5">return back </button></a>
</div>



<div style="margin-top:4%; margin-left:10%; margin-right:10%;">
    <form action="{{route('user.update', $user->id)}}" method="POST">
        @csrf
        @method('PUT')
        <div class="col-md-6">
            <input type="text" name="name" placeholder="Name" class="form-control @error('name') is-invalid @enderror" value="{{$user->name}}"><br>
            @if($errors->has('name'))
            <p class="text-danger  "> {{$errors->first('name')}}</p>
            @endif
        </div>
        <div class="col-md-6">
            <input type="text" name="email" placeholder="Email" class="form-control @error('email') is-invalid @enderror" value="{{$user->email}}"><br>
            @if($errors->has('email'))
            <p class="text-danger "> {{$errors->first('email')}}</p>
            @endif
        </div>

        <h5>Roles</h5>
        <div class="col-md-12">
            @foreach($roles as $role)
            <input style="margin-left:1%;" type="checkbox" name="role[]" id="" value="{{$role->id}}" {{in_array($role->name, $user->getRoleNames()->toArray()) ? 'checked' : ''}}>
            <label for="">{{$role->name}}</label>
            @endforeach
        </div><br><br>

        <h5>Permissions</h5>
        <div class="col-md-12">
            @foreach($permissions as $permission)

            <input style="margin-left:1%;" type="checkbox" name="permission[]" id="" value="{{$permission->id}}" {{in_array($permission->id, $user->permissions->pluck('id')->toArray()) ? 'checked' : ''}}>
            <label for="">{{$permission->name}}</label>
            @endforeach
        </div>
        <div class="col-md-12"><br>
            <input type="submit" class="btn btn-success"><br>
        </div>



    </form>

</div>

@endsection