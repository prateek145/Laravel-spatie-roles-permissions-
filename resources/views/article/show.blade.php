@extends('layouts.admin')
@section('content')
<h5>Aticle</h5><br>

<div style="width:50%; margin-left:30%; border:solid #e0e0d1 0.5px" class="p-5 ">
    Title : {{$data->title}}<br>
    Sub Heading : {{$data->sub_heading}}<br>
    Meta Key : {{$data->meta_key}}<br>
    Short Description : {{$data->short_description}}<br>
    Meta Description : {{$data->meta_description}}<br>
    Content : {{$data->content}}<br>
</div>
@endsection