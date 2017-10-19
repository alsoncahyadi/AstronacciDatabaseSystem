<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AclubTransaction extends Model
{
    //
    protected $table = 'aclub_transactions';

    public function aclubMember() {
        return $this->hasMany('App\AclubMember', 'user_id', 'user_id');
    }

    public function createdBy() {
        return $this->belongsTo('App\User', 'created_by');
    }

    public function updatedBy() {
        return $this->belongsTo('App\User', 'updated_by');
    }
}
