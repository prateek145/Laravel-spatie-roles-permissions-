@extends('layouts.admin')
@section('content')

<div class="d-flex justify-content-between mb-sm-4">
    <h5>Page</h5>
    <a href="{{route('page.index')}}"> <button class="btn btn-danger btn-sm">return back</button></a>

</div>

<form action="{{route ('page.update', $id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')



    <div class="row mb-sm-4">
        <div class="col-sm-4">
            <input type="text" name="title" placeholder="title" value="{{$data->title}}" class="form-control @error('title') is-invalid @enderror ">
            @if($errors->has('title'))
            <p class="text-danger " style="width: 300px;">{{$errors->first('title')}}</p>
            @endif
        </div>

        <div class="col-sm-4">
            <input type="text" name="subheading" value="{{$data->sub_heading}}" class="form-control">
        </div>

        <div class="col-sm-4">
            <input type="text " name="metakey" value="{{$data->meta_key}}" class="form-control @error('metakey') is-invalid @enderror ">
            @if($errors->has('metakey'))
            <p class="text-danger " style="width: 300px;">{{$errors->first('metakey')}}</p>
            @endif
        </div>

    </div>

    <div class="row">
        <div class="col-md-6">
            <input type="text" name="shortdescription" value="{{$data->short_description}}" class="form-control mb-sm-4 p-4">
        </div>

        <div class="col-md-6">
            <input type="text" name="metadescription" value="{{$data->meta_description}}" class="form-control mb-sm-4 p-4" rows="2">
        </div>



    </div>

    <div class="row col-md-12 mb-sm-4">
        <textarea name="page" id="" cols="60" rows="10" value="{{$data->content}}" class="form-control @error('page') is-invalid @enderror"></textarea><br>
        @if($errors->has('page'))
        <p class="text-danger " style="width: 300px;">{{$errors->first('page')}}</p>
        @endif

    </div>

    <div>
        <input type="file" name = "image" >      
    </div>

    <input type="hidden" name="id" value="{{$id}}">
    <input type="submit" class="btn btn-success mt-5">
</form>
@endsection