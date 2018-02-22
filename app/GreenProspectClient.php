<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GreenProspectClient extends Model
{
    //
    protected $table = 'green_prospect_clients';

    protected $primaryKey = 'green_id';

    protected $attributImport = ["green_id" => "green_id",
                                "date" => "date",
                                "name" => "name",
                                "phone" => "phone",
                                "email" => "email",
                                "interest" => "interest",
                                "pemberi" => "pemberi",
                                "sumber_data" => "sumber_data",
                                "keterangan_perintah" => "keterangan_perintah"];

    public function getAttributesImport() {
        return $this->attributImport;
    }

    public function progresses() {
        return $this->hasMany('App\GreenProspectProgress', 'green_id', 'green_id');
    }

    public function createdBy() {
        return $this->belongsTo('App\User', 'created_by');
    }

    public function updatedBy() {
        return $this->belongsTo('App\User', 'updated_by');
    }
}
