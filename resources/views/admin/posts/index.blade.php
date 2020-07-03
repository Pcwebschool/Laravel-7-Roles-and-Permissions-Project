@extends('admin.layouts.dashboard')

@section('content')

    <div class="row py-lg-2">
        <div class="col-md-6">
            <h2>This is Post List</h2>
        </div>
        @cannot('isManager')
            @can('create', App\Post::class)
            <div class="col-md-6">
                <a href="/posts/create" class="btn btn-primary btn-lg float-md-right" role="button" aria-pressed="true">Create New Post</a>
            </div>
            @endcan
        @endcannot
    </div>

    <!-- DataTables Example -->
    <div class="card mb-3">
        <div class="card-header">
            <i class="fas fa-table"></i>
            Data Table Example</div>
        <div class="card-body">
            <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Title</th>
                    <th>Content</th>
                    <th>Image</th>
                    <th>User</th>
                    <th>Tools</th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <th>Id</th>
                    <th>Title</th>
                    <th>Content</th>
                    <th>Image</th>
                    <th>User</th>
                    <th>Tools</th>
                </tr>
                </tfoot>
                <tbody>
                    @foreach ($posts as $post)
                        <tr>
                            <td>{{ $post['id'] }}</td>
                            <td>{{ $post['title'] }}</td>
                            <td>{!! getShorterString($post['content'], 50) !!}</td>
                            <td><img src="{{ asset('/storage/images/posts_images/'.$post['image_url']) }}" alt="{{ $post['image_url'] }}" width="100"></td>
                            <td>{{ $post->user['name'] }}</td>
                            <td>
                                <a href="/posts/{{ $post['id'] }}"><i class="fa fa-eye"></i></a>

                                @cannot('isManager')
                                    @can('edit', $post)
                                        <a href="/posts/{{ $post['id'] }}/edit"><i class="fa fa-edit"></i></a>
                                    @endcan
                                    @can('delete', $post)
                                        <a href="#"  data-toggle="modal" data-target="#deleteModal" data-postid="{{$post['id']}}"><i class="fas fa-trash-alt"></i></a>
                                    @endcan
                                @endcannot

                                @if ($post->published)                                     
                                    <span>
                                        <i class="fa fa-check-square" style="color:green"></i>                                                                                      
                                    </span>
                                @endif                                                       
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
        </div>
        <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
    </div>

    <!-- delete Modal-->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Are you shure you want to delete this?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            </div>
            <div class="modal-body">Select "delete" If you realy want to delete this post.</div>
            <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <form method="POST" action="/posts/">
                @method('DELETE')
                @csrf
                <input type="hidden" id="post_id" name="post_id" value="">
                <a class="btn btn-primary" onclick="$(this).closest('form').submit();">Delete</a>
            </form>
            </div>
        </div>
        </div>
    </div>

@endsection

@section('js_post_page')
    <script>
        $('#deleteModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) 
            var post_id = button.data('postid') 
            
            var modal = $(this)
            modal.find('.modal-footer #post_id').val(post_id);
            modal.find('form').attr('action','/posts/' + post_id);
        })
    </script>
@endsection