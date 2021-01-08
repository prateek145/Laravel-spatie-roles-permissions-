@extends('layouts.admin')
@section('content')
<h5>Update Role</h5><br>

<div >
    <form action="{{route ('role.update', $id)}}" method="POST" class=" justify-content-between">
        @csrf
        @method('PUT')
        <h5 class="ml-5">Permissons</h5><br>
        <input type="text" name="name" value="{{$role->name}}" class="col-md-4 form-control ml-5"><br>
        @foreach($permission as $permissions)
        
        <input class = "ml-5" type="checkbox" name="permissions[]" value="{{$permissions->id}}" {{in_array($permissions->name, $role_have_permissions->toArray()) ? 'checked' : ''}} >
        <label for="">{{$permissions->name}}</label>
        @endforeach
        <input type="hidden" name = "hidden" value = "{{$id}}"><br><br>
        <input type="submit" class="btn btn-success ml-5" >

    </form>

</div>
@endsection