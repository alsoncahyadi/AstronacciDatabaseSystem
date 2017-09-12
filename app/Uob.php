<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Uob extends Model
{
    //
    protected $table = 'uobs';

    public function master() {
        $this->belongsTo('App\Uob', 'master_id', 'master_id');
    }

    public function createdby() {
        return $this->belongsTo('App\User', 'created_by');
    }

    public function updatedby() {
        return $this->belongsTo('App\User', 'updated_by');
    }
}
