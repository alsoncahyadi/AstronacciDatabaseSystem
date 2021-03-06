<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AshopTransaction extends Model
{
    //
    protected $table = 'ashop_transactions';

    protected $primaryKey = 'transaction_id';

    protected $appends = [  'name',
                            'email'];

    protected $attributImport = [ "transaction_id" => "transaction_id",
                                    "master_id" => "master_id",
                                    "product_type" => "product_type",
                                    "product_name" => "product_name",
                                    "nominal" => "nominal",
                                    ];

    public function getAttributesImport() {
        return $this->attributImport;
    }                        

    public function master() {
        return $this->belongsTo('App\MasterClient', 'master_id', 'master_id');
    }

    public function createdBy() {
        return $this->belongsTo('App\User', 'created_by');
    }

    public function updatedBy() {
        return $this->belongsTo('App\User', 'updated_by');
    }

    public function getNameAttribute()
    {
        return $this->master->name;
    }

    public function getEmailAttribute()
    {
        return $this->master->email;
    }
}
