<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected $guarded = [];

    public function comuna() 
    {
        return $this->hasMany(Comuna::class);
    }
}
