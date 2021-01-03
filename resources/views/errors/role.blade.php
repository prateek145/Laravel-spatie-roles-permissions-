@extends('layouts.admin')
@section('content')
<div class="middle" style="margin-top: 12%;" >
    <div >
    <h2 style="float: left;">{{$error}}</h2>
    <a href="{{route ('role.create')}}"><button class = "button">Create</button></a>
    </div>
    
</div>
@endsection