<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Post;
use App\Comment;

class CommentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('memberStore');
        $this->middleware('memberauth')->only('memberStore');
       
    }

    public function memberStore(Post $post)
    {
        
        if(Auth::guard('member')->user()){

        $this->validate(request(),[
            'comment' => 'required|min:2'
        ]);

        Comment::create([
            'body' => request('comment'),
            'user_id' => 0,
            'member_id' => Auth::guard('member')->user()->id,
            'post_id' => $post->id
        ]);

        }

        return back();
    }


    public function store(Post $post)
    {

        if(Auth::check() && Auth::user()){

        $this->validate(request(),[
    		'comment' => 'required|min:2'
    	]);

        Comment::create([
            'body' => request('comment'),
            'user_id' => Auth::user()->id,
            'member_id' => 0,
            'post_id' => $post->id
        ]);

        }

    	return back();
    }

    public function showall()
    {

        $comments = Comment::latest();
        $comments = $comments->get();

        return view('comments.showall',compact('comments'));

    }


    public function edit(Comment $comment)
    {
        return view('comments.edit',compact('comment'));
    }


    public function update()
    {
        $this->validate(request(),[

            'commentbody' => 'required|min:10'
        ]);

        $id = request('comeditid');
        $comment = Comment::find($id);
        $comment->body = request('commentbody');

        $comment->save();

        return redirect('/comment/showall')->with('commentUpdMsg','Comment Updated Successfully!');
    }

    public function delete()
    {
        $id = request('deleteid');
        $comment = Comment::find($id);

        $comment->delete();

        return redirect('/comment/showall')->with('commentDelMsg','Comment Deleted!');
    }
}
