@extends('layouts.admin')
@section('content')
@if(session()->has('success'))
<p class="alert alert-success"> {{session()->get('success')}}</p>
@endif

<div class="d-flex justify-content-between" style="margin-bottom: 3%;">
    <h5>Articles</h5>

    @can('write article')
    <div class="btn btn-primary btn-sm px-5">
        <a href="{{route ('article.create')}}"><button class="btn btn-sm" style="color: white; font-weight:700; ">Create</button></a>
    </div>

    @endcan

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
@foreach($data as $data)
<tr>
    <td>{{$data->id}}</td>
    <td>
        <h6>{{$data->title}}</h6>
    </td>
    <td>
        <h6>{{$data->short_description}}</h6>
    </td>
    <td>
        <h6>{{$data->created_at}}</h6>
    </td>

    <td>
        <div class="d-flex justify-content-between">
            @can('update article')
            <a href="article/{{$data->id}}"><button class="btn btn-success btn-sm">Update</button></a>
            @endcan

            <a href=""><button class="btn btn-primary btn-sm">show</button></a>

            <form action="{{route('article.destroy', $data->id)}}" method="POST">
                @csrf
                @can('delete article')
                @method('DELETE')
                <button class="btn btn-danger btn-sm">Delete</button>

                @endcan
            </form>

        </div>

    </td>
</tr>


@endforeach


@endsection