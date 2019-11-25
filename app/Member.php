<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Member extends Authenticatable
{
    
	use Notifiable;

	protected $table = 'members';

	protected $guard = 'member';

    protected $fillable = ['name','email','password'];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function comments()
    {
    	return $this->hasMany(Comment::class);
    }
}
