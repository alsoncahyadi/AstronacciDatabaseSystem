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
        'username', 'email', 'password', 'a_shop_auth', 'role', 'fullname', 'no_hp',
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

    public function createAclubInformations() {
        return $this->hasMany('App\AclubInformation', 'id', 'created_by');
    }

    public function updateAclubInformations() {
        return $this->hasMany('App\AclubInformation', 'id', 'updated_by');
    }

    public function createAclubMembers() {
        return $this->hasMany('App\AclubMember', 'id', 'created_by');
    }

    public function createAclubTransactions() {
        return $this->hasMany('App\AclubTransaction', 'id', 'created_by');
    }

    public function updateAclubMembers() {
        return $this->hasMany('App\AclubTransaction', 'id', 'updated_by');
    }

    public function createAshopTransactions() {
        return $this->hasMany('App\AshopTransaction', 'id', 'created_by');
    }

    public function updateAshopTransactions() {
        return $this->hasMany('App\AshopTransaction', 'id', 'updated_by');
    }

    public function createCats() {
        return $this->hasMany('App\Cat', 'id', 'created_by');
    }

    public function updateCats() {
        return $this->hasMany('App\Cat', 'id', 'updated_by');
    }

    public function createGreenProspectClients() {
        return $this->hasMany('App\GreenProspectClient', 'id', 'created_by');
    }

    public function updateGreenProspectClients() {
        return $this->hasMany('App\GreenProspectClient', 'id', 'updated_by');
    }

    public function createGreenProspectProgresses() {
        return $this->hasMany('App\GreenProspectProgress', 'id', 'created_by');
    }

    public function updateGreenProspectProgresses() {
        return $this->hasMany('App\GreenProspectProgress', 'id', 'updated_by');
    }

    public function createMasterClients() {
        return $this->hasMany('App\MasterClient', 'id', 'created_by');
    }

    public function updateMasterClients() {
        return $this->hasMany('App\MasterClient', 'id', 'updated_by');
    }

    public function createMrgs() {
        return $this->hasMany('App\Mrg', 'id', 'created_by');
    }

    public function updateMrgs() {
        return $this->hasMany('App\Mrg', 'id', 'updated_by');
    }

    public function createMrgAccounts() {
        return $this->hasMany('App\MrgAccount', 'id', 'created_by');
    }

    public function updateMrgAccounts() {
        return $this->hasMany('App\MrgAccount', 'id', 'updated_by');
    }

    public function createUobs() {
        return $this->hasMany('App\Uob', 'id', 'created_by');
    }

    public function updateUobs() {
        return $this->hasMany('App\Uob', 'id', 'updated_by');
    }
}
