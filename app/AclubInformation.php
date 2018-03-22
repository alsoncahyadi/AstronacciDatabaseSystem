<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AclubInformation extends Model
{
    //
    protected $table = 'aclub_informations';

    protected $primaryKey = 'master_id';

    protected $attributImport = [ "master_id" => "master_id",
                                    "sumber_data" => "sumber_data",
                                    "keterangan" => "keterangan"];

    public function getAttributesImport() {
        return $this->attributImport;
    }

    public function master() {
        return $this->belongsTo('App\MasterClient', 'master_id', 'master_id');
    }

    public function aclubMembers() {
        return $this->hasMany('App\AclubMember', 'master_id', 'master_id');
    }

    public function createdBy() {
        return $this->belongsTo('App\User', 'created_by');
    }

    public function updatedBy() {
        return $this->belongsTo('App\User', 'updated_by');
    }
}
