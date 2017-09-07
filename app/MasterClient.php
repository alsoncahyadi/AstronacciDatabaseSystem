<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MasterClient extends Model
{
    //
    protected $table = 'master_clients';

    public function mrg() {
        return $this->hasOne('App\Mrg', 'master_id', 'master_id');
    }

    public function uob() {
        return $this->hasOne('App\Uob', 'master_id', 'master_id');
    }

    public function cat() {
        return $this->hasOne('App\Cat', 'master_id', 'master_id');
    }

    public function ashop_transactions() {
        return $this->hasMany('App\AshopTransaction', 'master_id', 'master_id');
    }

    public function aclub_information() {
        return $this->hasOne('App\AclubTransaction', 'master_id', 'master_id');
    }

    public function aclub_members() {
        return $this->hasMany('App\AclubMember', 'master_id', 'master_id');
    }
}
