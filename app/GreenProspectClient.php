<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GreenProspectClient extends Model
{
    //
    protected $table = 'green_prospect_clients';

    protected $primaryKey = 'green_id';

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
