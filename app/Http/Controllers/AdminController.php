<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Post;
use App\Type;
use App\Comment;
use App\User;
use App\Tag;

class AdminController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function admin(Request $request)
    {
    	$posts = $request->posts;
        $types = $request->types;
        $comments = $request->comments;
        $users = $request->users;
        $tags = $request->tags;

        return view('adminpanel.dashboard',compact('posts','types','tags','comments','users'))->with('adminMsg','Admin');
    }

    public function editor(Request $request)
    {
    	$posts = $request->posts;
        $types = $request->types;
        $comments = $request->comments;
        $users = $request->users;
        $tags = $request->tags;
        
    	return view('adminpanel.dashboard',compact('posts','types','tags','comments','users'))->with('editorMsg','Editor');
    }

}
