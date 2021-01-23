@extends('home.main')

@section('content')
<div class="brand_color">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="titlepage">
                    <h2>Blog</h2>
                </div>
            </div>
        </div>
    </div>
</div>

@foreach ($data as $item)

<div class="box mt-5 mb-4">
    <a href="content/{{$item->id}}"><img src="{{asset('storage/images/' . $item->image)}}" alt=""></a>

</div>

<div class="box1">
    <h4>{{$item->title}}</h4>
    <h6>{{$item->sub_heading}}</h6>

</div>

@endforeach


@endsection