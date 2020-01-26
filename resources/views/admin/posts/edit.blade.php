@extends('admin.layouts.dashboard')

@section('content')

<h1>Update the Post</h1>

@if ($errors->any())
    <div class="alert alert-danger" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li> 
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="/posts/{{ $post->id }}" enctype="multipart/form-data">
    @method('PATCH')
    @csrf()
    
    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" name="title" class="form-control" id="title" placeholder="Title..." value="{{ $post->title }}">
    </div>
    <label for="image">Select Image</label>
    <input type="file" name="image" class="form-control-file" id="image" value="{{$post->image}}">
    <div class="row">
        <img src="{{ asset('/storage/images/posts_images/'.$post->image_url) }}" class="img-thumbnail mx-auto" alt="{{$post->image_url}}" width="250" >
    </div>
    <div class="form-group">
        <label for="content">Insert Content</label>
        <textarea name="post_content" id="content">{{ $post->content }}</textarea>
    </div>

    <div class="form-group pt-2">
        <input class="btn btn-primary" type="submit" value="Submit">
    </div>
</form>

<script>
    CKEDITOR.replace( 'post_content' );
</script>

@endsection