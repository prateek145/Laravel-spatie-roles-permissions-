@extends('layouts.admin')
@section('content')
<div class="d-flex justify-content-between mb-5">
    <h5>Assign permissions</h5>
    <a href="{{route('user.index')}}"><button class="btn btn-danger btn-sm px-5">return back </button></a>
</div>

<form action="{{route ('role.store')}}" method="POST" class="row">
    @csrf

    <div>
        <input type="text" name="name" placeholder="Name" class="col-md-4 form-control ml-5 @error('name') is-invalid @enderror">
        @error('name')
        <p class="text-danger ml-5" style="width: 250px;">{{$message}}</p>
        @enderror

        <h5 class="ml-5 mt-5">Permissions</h5>
        <div class="row ml-5" >
            
            @foreach($permission as $permissions)
            <input type="checkbox" name="first[]" value="{{$permissions->id}}" class="ml-4">
            <label for="first">{{$permissions->name}} </label>
            @endforeach
        </div>



    </div>
    <input class="btn btn-success  mt-5 ml-5" type="submit">

</form>


@endsection