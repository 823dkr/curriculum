<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Feed;
use Carbon\Carbon;
use App\Image;

class Creature extends Model
{
    public function image()
    {
        return $this->hasMany('App\Image');
    }

    public function feed()
    {
        return $this->hasMany('App\Feed');
    }

    public function isFeedBy($user): bool
    {
        $today = Carbon::today();
        return Feed::where('user_id', $user->id)->where('creature_id', $this->id)->whereDate('created_at', $today)->first() !== null;
    }
    public function newImage($user)
    {
        return Image::where('user_id', $user->id)->where('creature_id', $this->id)->latest('created_at')->first();
    }
}
