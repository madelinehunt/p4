<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    public function studies()
    {
        return $this->belongsToMany('App\Study')->withTimestamps();
    }
}
