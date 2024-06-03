<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Post;


class PostController extends Controller
{

    public function index()
    {
        $posts = DB::table('posts')->paginate(2);
        return response()->json($posts, 200);
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required | max:255',
            'body' => 'required'
        ]);
        $post = Post::create($request->all());
        return response()->json($post, 201);
    }

    public function show($id)
    {
        $post = Post::find($id);
        return response()->json($post);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
        ]);
        $post = Post::find($id);
        $post->update($request->all());
        return response()->json(200);
    }


    public function destory($id)
    {
        $post = Post::find($id);
        $post->delete();
        return response()->json(200);
    }

}
