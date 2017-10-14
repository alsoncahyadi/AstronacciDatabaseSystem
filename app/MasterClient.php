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

    public function ashopTransactions() {
        return $this->hasMany('App\AshopTransaction', 'master_id', 'master_id');
    }

    public function aclubInformation() {
        return $this->hasOne('App\AclubInformation', 'master_id', 'master_id');
    }

    public function aclubMembers() {
        return $this->hasMany('App\AclubMember', 'master_id', 'master_id');
    }

    public function createdBy() {
        return $this->belongsTo('App\User', 'created_by');
    }

    public function updatedBy() {
        return $this->belongsTo('App\User', 'updated_by');
    }
}
