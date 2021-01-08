@extends('layouts.admin')
@section('content')


<div class="d-flex justify-content-between" style="margin-bottom: 3%;">
    <h5>Articles</h5>

    <div class="btn btn-primary btn-sm ">
        <a href="{{route ('article.create')}}"><button class="btn btn-sm" style="color: white; font-weight:700; ">Create</button></a>
    </div>

</div>

<thead>
    <tr>
        <th style="width: 1%;">#</th>
        <th style="width: 10%;">Title</th>
        <th style="width: 60%;">Description</th>
        <th style="width: 10%;">Date Created</th>
        <th>Actions</th>
    </tr>
</thead>
@foreach($data as $item)
<tr>
    <td>{{$item->id}}</td>
    <td>
        <h6>{{$item->title}}</h6>
    </td>
    <td>
        <h6>{{$item->short_description}}</h6>
    </td>
    <td>
        <h6>{{$item->created_at}}</h6>
    </td>

    <td>
        <div class="d-flex justify-content-between">

            <a href="article/{{$item->id}}/edit"><button class="btn btn-success btn-sm ">Edit</button></a>

            <a href="article/{{$item->id}}"><button class="btn btn-primary btn-sm">show</button></a>

            <form action="{{route('article.destroy', $item->id)}}" method="POST">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger btn-sm">Delete</button>

            </form>

        </div>

    </td>
</tr>


@endforeach

<span>
{{$data->links()}}
</span>


@endsection