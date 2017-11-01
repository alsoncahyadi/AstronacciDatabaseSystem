<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AclubInformation extends Model
{
    //
    protected $table = 'aclub_informations';

    protected $primaryKey = 'master_id';

    public function master() {
        return $this->belongsTo('App\MasterClient', 'master_id', 'master_id');
    }

    public function createdBy() {
        return $this->belongsTo('App\User', 'created_by');
    }

    public function updatedBy() {
        return $this->belongsTo('App\User', 'updated_by');
    }
}
