@extends('admin.layouts.dashboard')

@section('content')

<h1>Create New Post</h1>

@if ($errors->any())
    <div class="alert alert-danger" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li> 
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="/posts" enctype="multipart/form-data">
    {{ csrf_field() }}
    
    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" name="title" class="form-control" id="title" placeholder="Title..." value="{{ old('title') }}">
    </div>
    <div class="form-group">
        <label for="image">Select Image</label>
        <input type="file" name="image" class="form-control-file" id="image">
    </div>
    <div class="form-group">
        <label for="content">Insert Content</label>
        <textarea name="post_content" id="content">{{ old('post_content') }}</textarea>
    </div>

    <div class="form-group pt-2">
        <input class="btn btn-primary" type="submit" value="Submit">
    </div>
</form>

<script>
    CKEDITOR.replace( 'post_content' );
</script>

@endsection