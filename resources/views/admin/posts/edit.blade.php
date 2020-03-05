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
    <input type="file" name="image" class="form-control-file" id="profile-img" value="{{$post->image}}">
    <div class="row">
        <img src="{{ asset('/storage/images/posts_images/'.$post->image_url) }}" id="profile-img-tag" class="img-thumbnail mx-auto" alt="{{$post->image_url}}" width="250" >
    </div>
    <div class="form-group">
        <label for="content">Insert Content</label>
        <textarea name="post_content" id="content">{{ $post->content }}</textarea>
    </div>

    <div class="form-group pt-2">
        <input class="btn btn-primary" type="submit" value="Submit">
    </div>
</form>

@section('js_post_page')

    <script>
        
        CKEDITOR.replace( 'post_content' );

        $(function() {

            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    
                    reader.onload = function (e) {
                        $('#profile-img-tag').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }
            
            $("#profile-img").change(function(){
                readURL(this);
            });

        });

    </script>
    
@endsection

@endsection