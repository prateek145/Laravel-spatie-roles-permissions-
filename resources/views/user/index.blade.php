@extends('layouts.admin')
@section('content')



<div class="d-flex justify-content-between mb-5">
    <h5>Users</h5>
    <a href="{{route('user.create')}}" ><button class="btn btn-primary btn-sm px-5">Create </button></a>
</div>


<div class="middle" style="margin-right: 30%;">

    <thead>
        <tr>
            <th style="width: 1%;">#</th>
            <th style="width: 4%;">Name</th>
            <th >Email</th>
            <th style="width: 15%;">Date Created</th>
            <th style="width: 15%;">Updated Created</th>
            <th style="width: 4%;">Update</th>
            <th style="width: 4%;">Delete</th>    
        </tr>
    </thead>

    @foreach($data as $item)

    <tr>
        <td>{{$item->id}}</td>
        <td >{{$item->name}}</td>
        <td>{{$item->email}}</td>
        <td>{{$item->created_at}}</td>
        <td>{{$item->updated_at}}</td>
        <td><a href="user/{{$item->id}}"><button class="btn btn-success btn-sm">++</button></a></td>
        <form action="{{route ('user.destroy', $item->id)}}" method="POST">
            @csrf
            @method('DELETE')
            <td><button class="btn btn-danger btn-sm">--</button></td>

        </form>
    </tr>
    @endforeach

   
</div>

@endsection