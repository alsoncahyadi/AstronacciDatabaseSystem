<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mrg extends Model
{
    //
    protected $table = 'mrgs';

    public function master() {
        return $this->belongsTo('App\MasterClient', 'master_id', 'master_id');
    }

    public function accounts() {
        return $this->hasMany('App\MrgAccount', 'master_id', 'master_id');
    }

    public function createdBy() {
        return $this->belongsTo('App\User', 'created_by');
    }

    public function updatedBy() {
        return $this->belongsTo('App\User', 'updated_by');
    }
}
