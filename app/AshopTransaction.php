<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AshopTransaction extends Model
{
    //
    protected $table = 'ashop_transactions';

    public function master() {
        return $this->belongsTo('App\MasterClient', 'master_id', 'master_id');
    }
}
