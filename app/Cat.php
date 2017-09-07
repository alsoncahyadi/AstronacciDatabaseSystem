<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cat extends Model
{
    //
    protected $table = 'cats';

    public function master() {
        $this->belongsTo('App\MasterClient', 'master_id', 'master_id');
    }
}
