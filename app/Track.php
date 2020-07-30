<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Track extends Model
{
    protected $guarded = ['id'];

    public function habit()
    {
        return $this->belongsTo(Habit::class);
    }
}
