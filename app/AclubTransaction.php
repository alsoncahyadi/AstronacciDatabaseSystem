<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AclubTransaction extends Model
{
    //
    protected $table = 'aclub_transactions';

    public function aclub_member() {
        return $this->hasMany('App\AclubTransaction', 'master_id', 'master_id');
    }
}
