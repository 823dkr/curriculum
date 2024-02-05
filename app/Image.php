<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = [
        'name',
        'path',
    ];

    public function type()
    {
        return $this->belongsTo('App\Type');
    }
    public function creature()
    {
        return $this->hasOne('App\Creature');
    }
}
