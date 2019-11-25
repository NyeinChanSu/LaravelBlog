<?php

namespace App\Http\Controllers;
use App\Type;

use Illuminate\Http\Request;

class TypesController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function create()
    {
    	$types = Type::latest();
        $types = $types->get();
        return view('types.create',compact('types'));
    }

    public function store()
    {
    	$this->validate(request(),[
    		'typeName' => 'required|min:2'
    	]);

    	Type::create([
    		'name' => request('typeName')
    	]);

    	return back()->with('typeCreateMsg','New Category Created!');
    }

    public function showall()
    {
        $types = Type::latest();
        $types = $types->get();
        return view('types.showall',compact('types'));
    }

    public function edit()
    {
        $this->validate(request(),[
            'typename' => 'required|min:2'
        ]);

        $id = request('editid');
        $type = Type::find($id);
        $type->name = request('typename');

        $type->save();

        return back()->with('typeUpdateMsg','Category Updated Successfully!');
    }

    public function delete()
    {
        $id = request('deleteid');
        $type = Type::find($id);

        $type->delete();

        return back()->with('typeDeleteMsg','Category Deleted!');
    }
}
