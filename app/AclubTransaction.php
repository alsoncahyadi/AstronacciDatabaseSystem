<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AclubTransaction extends Model
{
    //
    protected $table = 'aclub_transactions';

    protected $primaryKey = 'transaction_id';

    protected $attributImport = ["user_id" => "user_id",
                                "payment_date" => "payment_date",
                                "kode" => "kode",
                                "status" => "status",
                                "nominal" => "nominal",
                                "start_date" => "start_date",
                                "expired_date" => "expired_date",
                                "masa_tenggang" => "masa_tenggang",
                                "yellow_zone" => "yellow_zone",
                                "red_zone" => "red_zone",
                                "sales_name" => "sales_name"];

    public function getAttributesImport() {
        return $this->attributImport;
    }

    public function getAllAttributes()
    {
        $columns = \Schema::getColumnListing($this->table);

        $attributes = $this->getAttributes();

        foreach ($columns as $column)
        {
            if (!array_key_exists($column, $attributes))
            {
                $attributes[$column] = null;
            }
        }
        return $attributes;
    }

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
