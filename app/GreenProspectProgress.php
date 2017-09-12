<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GreenProspectProgress extends Model
{
    //
    protected $table = 'green_prospect_progresses';

    public function client() {
        return $this->belongsTo('App\GreenProspectClient', 'green_id', 'green_id');
    }

    public function createdby() {
        return $this->belongsTo('App\User', 'created_by');
    }

    public function updatedby() {
        return $this->belongsTo('App\User', 'updated_by');
    }
}
