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
}
