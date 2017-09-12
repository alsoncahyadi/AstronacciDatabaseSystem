<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mrg extends Model
{
    //
    protected $table = 'mrgs';

    public function master() {
        $this->belongsTo('App\MasterClient', 'master_id', 'master_id');
    }

    public function accounts() {
        $this->hasMany('App\MrgAccount', 'master_id', 'master_id');
    }

    public function createdby() {
        return $this->belongsTo('App\User', 'created_by');
    }

    public function updatedby() {
        return $this->belongsTo('App\User', 'updated_by');
    }
}
