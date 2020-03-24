@extends('layouts.app')

@section('content')

  <!-- Page Header -->
  <header class="masthead" style="background-image: url('/img/home-bg.jpg')">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="site-heading">
            <h1>Clean Blog</h1>
            <span class="subheading">A Blog Theme by Start Bootstrap</span>
          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- Main Content -->
  <div class="container">
    <div class="col-lg-8 col-md-10 mx-auto">
      <div class="row">

          @foreach ($posts as $post)
          <div class="col-md-4">
            <img class="img-thumbnail mt-4" width="100%" src="{{ asset('/storage/images/posts_images/'.$post['image_url']) }}" alt="post_image">
          </div>
          <div class="col-lg-8">
              <div class="post-preview">
                <a href="/home/{{$post['id']}}">
                  <h2 class="post-title">
                    {{$post['title']}}
                  </h2>
                  <h3 class="post-subtitle">
                    {!! getShorterString($post['content'], 100) !!}
                  </h3>
                </a>
                <p class="post-meta">Posted by
                  <a href="#">{{$post->user['name']}}</a>
                  on {{$post['created_at']}}</p>
              </div>          
          </div>
          <hr>
          @endforeach

      </div>

      <!-- Pager -->
      {{ $posts->links() }}


    </div>
  </div>

  <hr>

@endsection

