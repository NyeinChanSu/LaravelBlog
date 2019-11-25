<?php

namespace App\Http\Controllers;
use App\Post;
use App\Type;


use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index()
    {
        
        return view('posts.search');
    }

    public function search()
    {
    	$types = Type::get();

        $latests = Post::latest();
        $latests = $latests->take(5);
        $latests = $latests->get();

        $search =$_GET['search'];

        $articles = Post::query()->where('title','like','%'.$search.'%')->paginate(5)->withPath('?search='.$search);
   
        return view('posts.search',compact('articles','types','latests'));
    }
}
