@extends('layouts.admin')
@section('content')

<h3 class="middle" style="margin-top: 10%;">{{$error}}</h3>
<a href="{{route ('article.create')}}"><button class="button" style="margin-left: 50%;">Create</button></a>

@endsection