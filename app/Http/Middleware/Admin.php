<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Post;
use App\Type;
use App\Comment;
use App\User;
use App\Tag;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!Auth::check()) {
            return new Response(view('auth.login'));
        }
        elseif ((Auth::check() && Auth::user()->role != 'admin') && (Auth::check() && Auth::user()->role != 'editor')) {

            return new Response(view('unauthorized')->with('role', 'Authorized Users'));
        }
        else{

            $posts = Post::latest();
            $posts = $posts->get();

            $types = Type::latest();
            $types = $types->get();

            $comments = Comment::latest();
            $comments = $comments->get();

            $users = User::latest();
            $users = $users->get();

            $tags = Tag::all();

            $request->merge(compact('posts','types','tags','comments','users'));

            return $next($request);
        }     
    }
}
