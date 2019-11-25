<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Post;
use App\Type;
use App\Tag;
use App\Comment;
use App\User;

class PostsController extends Controller
{
    
    public function __construct()
    {
      $this->middleware('auth')->except(['index','show','news','authors','tags']);
    }

    public function index(Request $request)
    {

      // $fashion = Type::where('name','=','fashion')->get();
      // $topnews = Post::whereIn('type_id',$fashion)->latest()->take(1);
      // $topnews = $topnews->get();//get post with descending sort


      $lifestyle = Type::where('name','=','lifestyle')->get();
      $rtopnews = Post::whereIn('type_id',$lifestyle)->latest()->take(1);
      $rtopnews = $rtopnews->get();//get post with descending sort

      $topnews = Post::whereHas('tags', function ($q) {$q->where('name', 'top news');})->latest()->take(1)->get();

      $trendnews = Post::whereHas('tags', function ($q) {$q->where('name', 'trend news');})->latest()->take(2)->get();

      $popnews = Post::whereHas('tags', function ($q) {$q->where('name', 'popular news');})->latest()->take(2)->get();


      $postQuery = Post::query();
      $postQuery->latest();

      if($user = request('user')){
        $postQuery->where('user_id',$user);
      }

      if ($type = request('type')) {
        $postQuery->where('type_id',$type);
      }

      $posts = $postQuery->paginate(4);

      $types = Type::get();

      $tags = Tag::get();

      $comments =Comment::latest()->take(5)->get();

      $latests = Post::latest();
      $latests = $latests->take(5);
      $latests = $latests->get();


      return view('posts.index',compact('posts','types','tags','topnews','rtopnews','trendnews','popnews','latests','comments'));
    }

   	public function show(Post $post)
   	{
      $types = Type::get();

      $tags = Tag::get();

      $comments =Comment::latest()->take(5)->get();

      $latests = Post::latest();
      $latests = $latests->take(5);
      $latests = $latests->get();

      return view('posts.show',compact('post','types','tags','latests','comments'));
   	}

   	public function news()
   	{
   		
      $postQuery = Post::query();

      if ($type = request('type')) {
        $postQuery->where('type_id',$type);
      }

      $typeid = request('type');
      $typeQuery = Type::query();
      $typeQuery->where('id',$typeid);
      $typerow = $typeQuery->get();


      $posts = $postQuery->latest()->paginate(4)->withPath('news?type='.$typeid);

      $types = Type::get();

      $tags = Tag::get();

      $comments =Comment::latest()->take(5)->get();

      $latests = Post::latest();
      $latests = $latests->take(5);
      $latests = $latests->get();

      return view('news',compact('posts','types','tags','latests','typerow','comments'));
   	}

    public function authors()
    {
      $postQuery = Post::query();

      if($user = request('user')){
        $postQuery->where('user_id',$user);
      }

      $authorid = request('user');
      $userQuery = User::query();
      $userQuery->where('id',$authorid);
      $authorrow = $userQuery->get();


      $posts = $postQuery->latest()->paginate(4)->withPath('authors?user='.$authorid);

      $types = Type::get();

      $tags = Tag::get();

      $comments =Comment::latest()->take(5)->get();

      $latests = Post::latest();
      $latests = $latests->take(5);
      $latests = $latests->get();

      return view('authors',compact('posts','types','tags','latests','authorrow','comments'));
    }

    public function tags(Tag $tag)
    {
      
      $tagid = request('tag');
      $tagQuery = Tag::query();
      $tagQuery->where('id',$tagid);
      $tagrow = $tagQuery->get();


      $posts = Post::whereHas('tags', function ($q) use ($tagid) 
      {
          $q->whereHas('posts', function($q) use ($tagid) 
          {     
             $q->where('tag_id', '=', $tagid);
          });
      })->paginate(4)->withPath('tags?tag='.$tagid);


      $types = Type::get();

      $tags = Tag::get();

      $comments =Comment::latest()->take(5)->get();

      $latests = Post::latest();
      $latests = $latests->take(5);
      $latests = $latests->get();

      return view('tags',compact('posts','types','tags','latests','tagrow','comments'));
    }


    public function create()
    {
      if(Auth::check() && Auth::user()->role != 'customer'){
        $types = Type::latest();
        $types = $types->get();

        $tags = Tag::latest();
        $tags = $tags->get();

        return view('posts.create',compact('types','tags'));
      }else{
        return view('unauthorized')->with('role', 'Authorized Users');
      }
    }

    public function showall()
    {
      
      if(Auth::check() && Auth::user()->role != 'customer'){
        $posts = Post::latest();
        $posts = $posts->get();
        return view('posts.showall',compact('posts'));
      }else{
        return view('unauthorized')->with('role', 'Authorized Users');
      }
    }

    public function store()
    {
      
      $this->validate(request(),[
        'title' => 'required|min:5',
        'type' => 'required',
        'body' => 'required|min:10',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
      ]);

      $imageName = time().'.'.request()->image->getClientOriginalExtension();
      request()->image->move(public_path('images'),$imageName);

      $fullImage = '/images/'.$imageName;

      $post = Post::create([
        'title'=> request('title'),
        'type_id' => request('type'),
        'body' => request('body'),
        'user_id' => auth()->id(),
        'image' => $fullImage
      ]);

      $post->tags()->sync(request('tags'),false);

      return back()->with('postCreateMsg','New Post Created Successfully!');
    }


    //For Posts Edit

    public function edit(Post $post)
    {
        $types = Type::all();
        $tags = Tag::all();
        return view('posts.edit',compact('post','types','tags'));
    }

    public function update(Request $request)
    {
        $this->validate(request(),[
            'title' => 'required|min:5',
            'type' => 'required',
            'body' => 'required|min:10',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            
        ]);

        $id = request('editid');
        $post = Post::find($id);
        $post->title = request('title');
        $post->type_id = request('type');
        $post->body = request('body');
        

        if ($request->hasFile('image')) { 

          $file = $request->file('image');

          $imageName = time().'.'.request()->image->getClientOriginalExtension();
          $post->image = $imageName;
          $file->move(public_path('images'),$imageName);

          $fullImg = '/images/'.$imageName;

          $post->image = $fullImg;
                                                                                          
        }

        $post->save();

        if(!empty(request('tags'))){
          $post->tags()->sync(request('tags'));
        }else{
          $post->tags()->sync(array());
        }
       
        return back()->with('postUpdMsg','Post Updated Successfully!');
    }

    // public function destroy($id)
    // {
    //     $post = Post::find($id);
    //     $post = Post::whereSlug($id)->firstOrFail();
    //     $post->delete();
    //     return redirect()->home()->with('status', 'The post '.$id.' has been deleted!');
    // }

    public function destroy()
    {
        $id = request('deleteid');
        $post = Post::find($id);

        $post->tags()->detach();

        $post->delete();

        return redirect('/post/showall')->with('postDelMsg','Post Deleted!');
    }
}
