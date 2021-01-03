@extends('layouts.admin')
@section('content')
@if(session()->has('success'))
<p class="alert alert-success"> {{session()->get('success')}}</p>
@endif

<div class="d-flex justify-content-between mb-5">
    <h5>Roles</h5>
    <a href="{{route('role.create')}}"><button class="btn btn-primary btn-sm px-5">Create </button></a>
</div>

<thead>
    <tr>
        <th style="width: 1%;">#</th>
        <th style="width: 4%;">Role</th>
        <th style="width: 15%;">Date Created</th>
        <th style="width: 15%;">Updated Created</th>
        <th style="width: 4%;">Update</th>
        <th style="width: 4%;">Delete</th>
    </tr>
</thead>

@foreach($role as $role)
<tr>

       

        <td>{{$role->id}}</td>
        <td>{{$role->name}}</td>
        <td>{{$role->created_at}}</td>
        <td>{{$role->updated_at}}</td>
        <td>
            <a href="role/{{$role->id}}"><button class="btn btn-success btn-sm">Update</button></a>
        </td>
        <td>
            <form action="{{route ('role.destroy', $role->id)}}" style="float: right; " method="POST">
            @csrf
            @method('Delete')
            <button class="btn btn-danger btn-sm">Delete</button>
            </form>
        </td>

        

        

    
</tr>
@endforeach

<div>

</div>
@endsection