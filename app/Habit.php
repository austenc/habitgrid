<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Habit extends Model
{
    protected $guarded = ['id'];

    public function tracks()
    {
        return $this->hasMany(Track::class);
    }
}
