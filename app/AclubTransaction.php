<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AclubTransaction extends Model
{
    //
    protected $table = 'aclub_transactions';

    protected $primaryKey = 'transaction_id';

    protected $dates = [
        'created_at',
        'updated_at',
        'payment_date',
        'start_date',
        'expired_date',
        'masa_tenggang',
        'yellow_zone',
        'red_zone'
    ];

    public function aclubMember() {
        return $this->belongsTo('App\AclubMember', 'user_id', 'user_id');
    }

    public function createdBy() {
        return $this->belongsTo('App\User', 'created_by');
    }

    public function updatedBy() {
        return $this->belongsTo('App\User', 'updated_by');
    }
}
