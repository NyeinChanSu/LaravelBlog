<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post;

class PostsController extends Controller
{
    public function index()
    {
    	return Post::all();
    }

    public function show(Post $post)
    {
    	return $post;
    }

    public function store(Request $request)
    {
    	$post = Post::create($request->all());

    	return response()->json($post,201);
    }

    public function update(Request $request, Post $post)
    {
    	$post->update($request->all());

    	return response()->json($post,200);
    }

    public function delete(Post $post)
    {
    	$post->delete();

    	return response()->json(null,204);
    }


}
