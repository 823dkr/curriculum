<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Feed;

class Creature extends Model
{
    public function feed()
    {
        return $this->hasMany('App\Feed');
    }

    public function isFeedBy($user): bool
    {
        return Feed::where('user_id', $user->id)->where('creature_id', $this->id)->first() !== null;
    }
}
