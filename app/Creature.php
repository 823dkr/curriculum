<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Creature extends Model
{
    public function feed()
    {
        return $this->hasMany('App\Feed');
    }
}
