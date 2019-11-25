<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;

class TagsController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function index()
    {
    	$tags = Tag::latest();
        $tags = $tags->get();
        return view('tags.index',compact('tags'));
    }

    public function store()
    {
    	$this->validate(request(),[
    		'tagName' => 'required|min:2'
    	]);

    	Tag::create([
    		'name' => request('tagName')
    	]);

    	return back()->with('tagCreateMsg','New Tag was successfully created!');
    }

    public function showall()
    {
        $tags = Tag::latest();
        $tags = $tags->get();
        return view('tags.showall',compact('tags'));
    }


    public function edit()
    {
        $this->validate(request(),[
            'tagName' => 'required|min:2'
        ]);

        $id = request('editid');
        $tag = Tag::find($id);
        $tag->name = request('tagName');

        $tag->save();

        return back()->with('tagUpdateMsg','Tag Updated Successfully!');
    }

    public function delete()
    {
        $id = request('deleteid');
        $tag = Tag::find($id);

        $tag->posts()->detach();

        $tag->delete();

        return back()->with('tagDeleteMsg','Tag Deleted!');
    }
}
