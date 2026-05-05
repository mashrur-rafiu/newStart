<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        Post::create([
            'title' => $request->title,
            'description' => $request->description
        ]);
        return redirect('/posts');
    }


    public function edit( int $id)
    {
        $post = Post::findorFail($id);
        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, int $id)
    {
        $post = Post::findorFail($id);

        $post->update([
            'title' => $request->title,
            'description' => $request->description,
        ]);
        return redirect('/posts');
    }

    public function destroy( int $id)
    {
        Post::destroy($id);
        return redirect('/posts');
    }
}
