<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;

class PostController extends Controller
{
    public function index()
    {
        $posts= Post::all();
        return response()-> json($posts);
    }

    public function store(Request $request)
    {
        $post= Post::create([
            'title'=> $request-> title,
            'description'=> $request-> description
        ]);
        return response()-> json($post);
    }

    public function update(Request $request, int $id)
    {
        $post= Post::findorFail($id);

        $post-> update([
            'title'=> $request->title,
            'description'=> $request->description
        ]);
        return response()-> json($post);
    }

    public function destroy( int $id)
    {
        Post::findorFail($id)-> delete();
        return response()-> json([
            'message'=> 'Post deleted'
        ]);
    }
}
