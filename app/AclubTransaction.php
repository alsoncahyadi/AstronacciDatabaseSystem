<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AclubTransaction extends Model
{
    //
    protected $table = 'aclub_transactions';

    public function aclubMember() {
        return $this->hasMany('App\AclubMember', 'master_id', 'master_id');
    }

    public function createdBy() {
        return $this->belongsTo('App\User', 'created_by');
    }

    public function updatedBy() {
        return $this->belongsTo('App\User', 'updated_by');
    }
}
