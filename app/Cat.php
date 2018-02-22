<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cat extends Model
{
    //
    protected $table = 'cats';

    protected $primaryKey = 'user_id';

    protected $attributImport = [ "user_id" => "user_id",
                                    "nomor_induk" => "nomor_induk",
                                    "master_id" => "master_id",
                                    "batch" => "batch",
                                    "sales_name" => "sales",
                                    "sumber_data" => "sumber_data",
                                    "DP_date" => "dp_date",
                                    "DP_nominal" => "dp_nominal",
                                    "payment_date" => "payment_date",
                                    "payment_nominal" => "payment_nominal",
                                    "tanggal_opening_class" => "tanggal_opening_class",
                                    "tanggal_end_class" => "tanggal_end_class",
                                    "tanggal_ujian" => "tanggal_ujian",
                                    "status" => "status",
                                    "keterangan" => "keterangan"
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
}
