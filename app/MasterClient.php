<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MasterClient extends Model
{
    //
    protected $table = 'master_clients';

    protected $primaryKey = 'master_id';

    protected $appends = ['month_birthdate'];

    protected $attributImport = ["redclub_user_id" => "user_id_redclub",
                                    "redclub_password" => "password_redclub",
                                    "name" => "nama",
                                    "telephone_number" => "telephone", 
                                    "email" => "email",
                                    "birthdate" => "tanggal_lahir",
                                    "address" => "alamat",
                                    "city" => "kota",
                                    "province" => "provinsi",
                                    "gender" => "gender",
                                    "line_id" => "line_id",
                                    "bbm" => "bbm",
                                    "whatsapp" => "whatsapp",
                                    "facebook" => "facebook"];

    public function getAttributesImport() {
        return $this->attributImport;
    }

    public function mrg() {
        return $this->hasOne('App\Mrg', 'master_id', 'master_id');
    }

    public function uob() {
        return $this->hasOne('App\Uob', 'master_id', 'master_id');
    }

    public function cat() {
        return $this->hasOne('App\Cat', 'master_id', 'master_id');
    }

    public function ashopTransactions() {
        return $this->hasMany('App\AshopTransaction', 'master_id', 'master_id');
    }

    public function aclubInformation() {
        return $this->hasOne('App\AclubInformation', 'master_id', 'master_id');
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

    public function getMonthBirthdateAttribute()
    {
        return date('F', strtotime($this->birthdate));
    }
}
