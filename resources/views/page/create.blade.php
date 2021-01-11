@extends('layouts.admin')
@section('content')
<div class="d-flex justify-content-between mb-sm-4 pull-right">
        <h5>page</h5>
        <a href="{{route('page.index')}}"> <button class="btn btn-danger btn-sm">return back</button></a>

    </div>
<form action="{{route ('page.store')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <input type="text " name="title" placeholder="Title" class="form-control @error('title') is-invalid @enderror">
                @if($errors->has('title'))
                <p class="text-danger">{{$errors->first('title')}}</p>
                @endif
                
            </div>

        </div>

        <div class="col-md-4">
            <input type="text " name="subheading" placeholder="Sub heading" class="form-control">
        </div>

        <div class="col-md-4">
            <input type="text " name="metakey" placeholder="Metakey" class="form-control @error('metakey') is-invalid @enderror">
            @if($errors->has('metakey'))
            <p class="text-danger">{{$errors->first('metakey')}}</p>
            @endif
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <input type="text " name="shortdescription" placeholder="Short Description" class="form-control">
        </div>

        <div class="col-md-6">
            <input type="text " name="shortmeta" placeholder="Short meta" class="form-control"><br>
        </div>

    </div>

    <div class="row">
        <div class="col-md-12">
            <textarea name="content" id="" cols="60" rows="10" placeholder="Write page" class="form-control @error('content') is-invalid @enderror"></textarea><br>
            @if($errors->has('content'))
            <p class="text-danger">{{$errors->first('content')}}</p><br>
            @endif
        </div>

    </div>

    <input type="file" name="image" class="form-control"><br><br><br>

    <input type="hidden" name="user_id" value="{{$id}}">
    <input type="submit" class="btn btn-success"><br>
</form>
@endsection