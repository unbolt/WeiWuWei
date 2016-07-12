<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sign extends Model
{
    protected $table;

    protected $guarded = ['id'];

    // Relationships
    public function raid()
    {
        return $this->hasOne('App\Models\Raid');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\Access\User\User');
    }
}
