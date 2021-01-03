@extends('layouts.app')

@section('content')
<h3 class="middle">Admin home</h3>

<div class="middle" style="margin-top: 200px;">
    <a href="{{route ('user.index')}}"><button class="button">User</button></a>
    <a href="{{route ('article.index')}}"><button class="button">Article</button></a>
    <a href="{{route ('role.index')}}"><button class="button">Role</button></a>

</div>
@endsection
