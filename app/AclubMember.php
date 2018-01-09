<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AclubMember extends Model
{
    //
    protected $table = 'aclub_members';

    protected $primaryKey = 'user_id';

    public function master() {
        return $this->belongsTo('App\MasterClient', 'master_id', 'master_id');
    }

    public function aclubInformation() {
        return $this->belongsTo('App\AclubInformation', 'master_id', 'master_id');
    }

    public function aclubTransactions() {
        return $this->hasMany('App\AclubTransaction', 'user_id', 'user_id');
    }

    public function createdBy() {
        return $this->belongsTo('App\User', 'created_by');
    }

    public function updatedBy() {
        return $this->belongsTo('App\User', 'updated_by');
    }
}
