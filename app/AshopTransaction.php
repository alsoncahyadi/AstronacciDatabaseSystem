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
