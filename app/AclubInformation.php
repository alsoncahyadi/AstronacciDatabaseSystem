<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AclubInformation extends Model
{
    //
    protected $table = 'aclub_informations';

    public function master() {
        return $this->belongsTo('App\MasterClient', 'master_id', 'master_id');
    }
}
