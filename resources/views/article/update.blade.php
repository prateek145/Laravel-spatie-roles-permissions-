@extends('layouts.admin')
@section('content')

<div class="d-flex justify-content-between mb-sm-4">
        <h5>Article</h5>
        <a href="{{route('article.index')}}"> <button class="btn btn-danger btn-sm">return back</button></a>

</div>

<form action="{{route ('article.update', $id) }}" method="POST" class="middle">
    @csrf
    @method('PUT')

   

    <div class="row mb-sm-4">
        <div class="col-sm-4">
            <input type="text" name="title" placeholder="Title" class="form-control">
        </div>

        <div class="col-sm-4">
            <input type="text" name="subheading" placeholder="Sub heading" class="form-control">
        </div>
        
        <div class="col-sm-4">
            <input type="text " name="metakey" placeholder="Meta key" class="form-control">
        </div>
        
    </div>

    <div class="row">
        <div class="col-md-6">
            <input type="text" name="shortdescription" placeholder="Short description" class="form-control mb-sm-4 p-4">
        </div>

        <div class="col-md-6">
            <input type="text" name="metadescription" placeholder="Meta description" class="form-control mb-sm-4 p-4" rows="2">
        </div>
        
        

    </div>

    <div class="row col-md-12 mb-sm-4">
    @if($errors->has('article'))
    <p class="alert alert-danger form-control" style="width: 300px;">{{$errors->first('article')}}</p>
    @endif 
    <textarea name="article" id="" cols="60" rows="10" placeholder="Update Article" class="form-control"></textarea><br>

    </div>
    
    <input type="hidden" name="id" value="{{$id}}">
    <input type="submit" class="btn btn-success">
</form>
@endsection