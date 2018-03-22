<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MrgAccount extends Model
{
    //
    protected $table = 'mrg_accounts';

    protected $primaryKey = 'accounts_number';

    protected $attributImport = [ "accounts_number" => "account_number",
                                    "master_id" => "master_id",
                                    "account_type" => "account_type",
                                    "sales_name" => "sales_name"];

    public function getAttributesImport() {
        return $this->attributImport;
    }

    public function mrg() {
        return $this->belongsTo('App\Mrg', 'master_id', 'master_id');
    }

    public function createdBy() {
        return $this->belongsTo('App\User', 'created_by');
    }

    public function updatedBy() {
        return $this->belongsTo('App\User', 'updated_by');
    }
}
