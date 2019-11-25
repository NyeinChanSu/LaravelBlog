<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function create()
    {
        return view('users.create');
    }

    public function store()
    {
        $this->validate(request(),[
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required|in:admin,editor,customer', //validate role input
      ]);

        User::create([
            'name' => request('name'),
            'email' => request('email'),
            'password' => Hash::make(request('password')),
            'role' => request('role'),
        ]);

        return redirect('/user/showall')->with('userCreateMsg','New User Created Successfully!');

    }

    public function showall()
    {
    	$users = User::latest();
    	$users = $users->get();
    	return view('users.showall',compact('users'));
    }

    public function edit(User $user)
    {
        return view('users.edit',compact('user'));
    }

    public function update()
    {
        $this->validate(request(),[

            'name' => 'required|string|max:255',
            'email'=> 'required|string|email|max:255',
            'password' => 'confirmed'
            
        ]);

        $id = request('userid');
        $user = User::find($id);
        $user->name = request('name');
        $user->email = request('email');

        if(!empty(request('password'))){
            $user->password = Hash::make(request('password'));
        }
        
        $user->save();

        return back()->with('userUpdMsg','Profile Updated Successfully!');
    }

    public function delete()
    {
    	$id = request('deleteid');
    	$user = User::find($id);
    	$user->delete();

    	return back()->with('userDeleteMsg','User Deleted!');
    }
}
