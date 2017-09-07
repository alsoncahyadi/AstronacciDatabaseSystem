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
}
