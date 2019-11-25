<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Type;
use App\Member;

class MembersController extends Controller
{

    use AuthenticatesUsers;


    protected $redirectTo = '/';


    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        
    }

    protected function guard() 
    {
       return Auth::guard('member');
    }

    public function showRegister()
    {
        $types = Type::get();

        return view('members.register',compact('types'));
    }

    public function register()
    {
 
    	$this->validate(request(),[
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
      ]);

        Member::create([
            'name' => request('name'),
            'email' => request('email'),
            'password' => Hash::make(request('password')),
        ]);

        return redirect()->back()->with('message', "Successfully registered a member. Please <a href='/member/login'> Login </a> here.");

    }

    public function showlogin()
    {
    	$types = Type::get();

        return view('members.login',compact('types'));
    }

    public function login()
    {

    	$this->validate(request(),[
            
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|max:255',
      ]);

      if(Auth::guard('member')->attempt(['email' => request('email'), 'password' => request('password')])){

      		// $details = Auth::guard('member')->user();
      		// $member = $details['original'];

      		return redirect()->home()->with('successmsg','Member Login Successfully!');

      }else{

      		return back()->with('errormsg','Something Went Wrong!..');
      }

    }
}
