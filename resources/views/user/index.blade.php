@extends('layouts.admin')
@section('content')



<div class="d-flex justify-content-between mb-5">
    <h5>Users</h5>
    <a href="{{route('user.create')}}"><button class="btn btn-primary btn-sm px-5">Create </button></a>
</div>


<div class="middle" style="margin-right: 30%;">

    <thead>
        <tr>
            <th style="width: 1%;">#</th>
            <th style="width: 4%;">Name</th>
            <th>Email</th>
            <th style="width: 15%;">Date Created</th>
            <th style="width: 15%;">Updated Created</th>
            <th style="width: 20%;">Actions</th>

        </tr>
    </thead>

    @foreach($data as $item)

    <tr>
        <td>{{$item->id}}</td>
        <td>{{$item->name}}</td>
        <td>{{$item->email}}</td>
        <td>{{$item->created_at}}</td>
        <td>{{$item->updated_at}}</td>
        <div class = "row">
            <td class=" row justify-content-between ml-1 mr-1">
                <a href="user/{{$item->id}}/edit"><button class="btn btn-success btn-sm">update</button></a>
                <form action="{{route ('user.destroy', $item->id)}}" method="POST">
                    @csrf
                    @method('DELETE')
                <button class="btn btn-danger btn-sm">delete</button>

            </form>

            </td>
        </div>

    </tr>
    @endforeach
    <span>
    {{$data->links()}}
    </span>
 

</div>

@endsection