@extends('layouts.admin')
@section('content')
<h5>Update Role</h5><br>

<div class="row">
    <form action="{{route ('role.update', $id)}}" method="POST" class="d-flex justify-content-between">
        @csrf
        @method('PUT')
        @foreach($permission as $permissions)
        
        <input class = "ml-5" type="checkbox" name="permissions[]" value="{{$permissions->id}}" {{!empty($permissions->id) ? 'checked' : ''}} >
        <label for="">{{$permissions->name}}</label><br>
        @endforeach
        <input type="hidden" name = "hidden" value = "{{$id}}">
        <input type="submit" class="btn btn-success" style="margin-left: 60%;">

    </form>

</div>
@endsection