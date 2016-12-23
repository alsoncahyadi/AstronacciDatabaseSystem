<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
	
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password', 'a_shop_auth', 'role', 'fullname',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
	
	public function hasAnyRole($roles){
        if (is_array($roles)) {
            foreach ($roles as $role) {
                if ($this->hasRole($this->username, $role)) {
                    return true;
                }
            }
        }
        else {
            if ($this->hasRole($this->username, $role)) {
                return true;
            }
        }
        return false;
    }

    public function hasRole($user, $role) {
        if ($this->where('username', $user)->where('role', $role)->first()) {
            return true;
        }
        return false;
    }
	
	public function hasAShop($user) {
		if ($this->where('username', $user)->where('a_shop_auth', '1')->first()) {
			return true;
		}
		return false;
	}
}
