@extends('layouts.admin')
@section('content')


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
        <th style="width: 20%;">Actions</th>
    </tr>
</thead>

@foreach($data as $role)
<tr>

       

        <td>{{$role->id}}</td>
        <td>{{$role->name}}</td>
        <td>{{$role->created_at}}</td>
        <td>{{$role->updated_at}}</td>
        <td class="row justify-content-between ml-1 mr-1">
            <a href="role/{{$role->id}}/edit"><button class="btn btn-success btn-sm">Edit</button></a>
        
            <form action="{{route ('role.destroy', $role->id)}}" method="POST">
            @csrf
            @method('Delete')
            <button class="btn btn-danger btn-sm">Delete</button>
            </form>
        </td>

        

        

    
</tr>
@endforeach

<span>

</span>
<div>

</div>
@endsection