<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AuthenticateMember
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
        
        if (!Auth::guard('member')->check()) {
            return redirect('/member/login')->with('warnmsg',"You need to <a href='/member/login'>Login</a> member to leave a comment. If you are not member, Please <a href='/member/create'>Register</a> here.");
        }

        return $next($request);
    }
}
