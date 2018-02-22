<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mrg extends Model
{
    //
    protected $table = 'mrgs';

    protected $primaryKey = 'master_id';

    protected $attributImport = [ "master_id" => "master_id",
                                    "sumber_data" => "sumber_data",
                                    "join_date" => "join_date"];

    public function getAttributesImport() {
        return $this->attributImport;
    }

    public function master() {
        return $this->belongsTo('App\MasterClient', 'master_id', 'master_id');
    }

    public function accounts() {
        return $this->hasMany('App\MrgAccount', 'master_id', 'master_id');
    }

    public function createdBy() {
        return $this->belongsTo('App\User', 'created_by');
    }

    public function updatedBy() {
        return $this->belongsTo('App\User', 'updated_by');
    }
}
