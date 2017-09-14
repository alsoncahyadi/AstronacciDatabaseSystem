<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GreenProspectClient extends Model
{
    //
    protected $table = 'green_prospect_clients';

    public function progresses() {
        return $this->hasMany('App\GreenProspectProgress', 'green_id', 'green_id');
    }

    public function createdby() {
        return $this->belongsTo('App\User', 'created_by');
    }

    public function updatedby() {
        return $this->belongsTo('App\User', 'updated_by');
    }
}
