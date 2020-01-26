<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $posts = Post::orderBy('id', 'desc')
                    ->get();

        return view('admin.posts.index', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //call the view admin.posts.create 
        return view('admin.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate the field
        $data = request()->validate([
            'title' => 'required|max:255',
            'image' => 'required|image',
            'post_content' => 'required'

        ]);

        //get the image from the form
        $fileNameWithTheExtension = request('image')->getClientOriginalName();

        //get the name of the file
        $fileName = pathinfo($fileNameWithTheExtension, PATHINFO_FILENAME);

        //get extension of the file
        $extension = request('image')->getClientOriginalExtension();

        //create a new name for the file using the timestamp
        $newFileName = $fileName . '_' . time() . '.' . $extension;

        //save the iamge onto a public directory into a separately folder
        $path = request('image')->storeAs('public/images/posts_images', $newFileName);

        // dd($extension);

        $user = auth()->user();
        $post = new Post();

        $post->title = request('title');
        $post->content = request('post_content');
        $post->image_url = $newFileName;
        $post->userId = $user->id;

        $post->save();

        return redirect('/posts');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //get the post with the id $post->idate
        $post = Post::find($post->id);

        // return view
        return view('admin/posts/edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //validate the field
        $data = request()->validate([
            'title' => 'required|max:255',
            'image' => 'required|image',
            'post_content' => 'required'

        ]);

        //get the image from the form
        $fileNameWithTheExtension = request('image')->getClientOriginalName();

        //get the name of the file
        $fileName = pathinfo($fileNameWithTheExtension, PATHINFO_FILENAME);

        //get extension of the file
        $extension = request('image')->getClientOriginalExtension();

        //create a new name for the file using the timestamp
        $newFileName = $fileName . '_' . time() . '.' . $extension;

        //save the iamge onto a public directory into a separately folder
        $path = request('image')->storeAs('public/images/posts_images', $newFileName);

        // dd($extension);

        $post = Post::findOrFail($post->id);

        $post->title = request('title');
        $post->content = request('post_content');
        $post->image_url = $newFileName;

        $post->save();

        return redirect('/posts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {

        //find the post
        $post = Post::find($request->post_id);

        $oldImage = public_path() . '/storage/images/posts_images/'. $post->image_url;

        if(file_exists($oldImage)){
            //delete the image
            unlink($oldImage);
        }

        //delete the post
        $post->delete();

        //redirect to posts
        return redirect('/posts');
    }
}
