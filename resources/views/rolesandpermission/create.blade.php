@extends('layouts.admin')
@section('content')
<div class="d-flex justify-content-between mb-5">
    <h5>Assign permissions</h5>
    <a href="{{route('user.index')}}"><button class="btn btn-danger btn-sm px-5">return back </button></a>
</div>

<form action="{{route ('role.store')}}" method="POST" class="row">
    @csrf

    <div class="row">
        <input type="text" name="name" placeholder="Name" class="col-md-4 form-control ml-5"><br><br>
        @error('name')
        <p class="alert alert-danger" style="width: 250px;">{{$message}}</p>
        @enderror

        
        @foreach($permission as $permissions)
        <input type="checkbox" name="first[]" value="{{$permissions->id}}" class="ml-4">
        <label for="first">{{$permissions->name}} </label>
       @endforeach


    </div>
    <input class="btn btn-success btn-sm mt-5 ml-5" type="submit">

</form>


@endsection