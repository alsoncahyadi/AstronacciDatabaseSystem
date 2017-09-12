<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MrgAccount extends Model
{
    //
    protected $table = 'mrg_accounts';

    public function mrg() {
        $this->belongsTo('App\Mrg', 'master_id', 'master_id');
    }

    public function createdby() {
        return $this->belongsTo('App\User', 'created_by');
    }

    public function updatedby() {
        return $this->belongsTo('App\User', 'updated_by');
    }
}
