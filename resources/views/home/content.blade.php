@extends('home.main')
@section('content')
<div class="brand_color">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="titlepage">
                    <h2>Blog content</h2>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="box mt-5 mb-4">
    <a href="{{route('blog')}}"><img src="{{asset('storage/images/' . $data->image)}}" alt=""></a>

</div>
<div class="box1">
    {{$data->title}}<br>
    {{$data->sub_heading}}<br>
    {{$data->short_description}}<br>
    {{$data->meta_key}}<br>
    {{$data->meta_desctiption}}<br>
    {{$data->content}}<br>
</div>
    
@endsection