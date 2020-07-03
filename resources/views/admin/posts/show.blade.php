@extends('admin.layouts.dashboard')

@section('content')

<div class="container">

    <div class="row">
        <div class="header">
            <h2>{{$post->title}}</h2>
        </div>
    </div>
    <div class="row">
        <div class="content" style="margin-top:30px">
            <img src="{{ asset('/storage/images/posts_images/'.$post->image_url)}}" width="200" alt="" style="float:left; margin-right:20px;">
            <p>{!!$post->content!!}</p>
        </div>
    </div>
    <div class="row pull-right mt-3">
            <a href="{{ url()->previous() }}" class="btn btn-primary btn-lg float-md-right" role="button" aria-pressed="true">Go Back...</a>
    </div>
    
    
</div>

@endsection