<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionController extends Controller
{
    public function destroy()
    {
    	auth()->logout();
    	return redirect ('/login');
    }

    public function homeLogout()
    {
        auth()->logout();
        return redirect()->home();
    }

    public function memberLogout()
    {
    	Auth::guard('member')->logout();
    	return redirect()->home();
    }
}
