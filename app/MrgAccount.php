<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MrgAccount extends Model
{
    //
    protected $table = 'mrg_accounts';

    protected $primaryKey = 'accounts_number';

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
