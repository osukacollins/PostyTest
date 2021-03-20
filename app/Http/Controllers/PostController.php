<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __costruct()
    {
        $this->middleware(['auth'])->only(['store', 'destroy']);
    }

    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->with('user', 'likes')->paginate(20); //to reduce queries
        return view('posts.index', [
            'posts' => $posts
        ]);
    }
    public function show(Post $post)
    {

        return view('posts.show', [
            'post' => $post
        ]);
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'body' => 'required'
        ]);
        $request->user()->posts()->create($request->only('body'));

        return back();
    }
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);

        $post->delete();
        return back();
    }
}
