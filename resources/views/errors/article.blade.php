@extends('layouts.admin')
@section('content')

<h3 class="middle" style="margin-top: 10%;">{{$error}}</h3>
@if(auth()->user()->can('create article'))
    <a href="{{route ('article.create')}}"><button class="btn btn-success" style="margin-left: 50%;">Create</button></a>

@endif


@endsection