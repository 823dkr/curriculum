<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Feed extends Model
{
    public function user()
    {   //usersテーブルとのリレーションを定義するuserメソッド
        return $this->belongsTo('App\User');
    }

    public function creature()
    {
        return $this->belongsTo('App\Creature');
    }
}
