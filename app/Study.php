<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Study extends Model
{
    public function participants()
    {
        return $this->belongsToMany('App\Participant')->withTimestamps();
    }
}
