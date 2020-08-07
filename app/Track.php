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

    public function scopeTotalHabitsInPastWeek()
    {
        return self::whereDate('tracked_on', '>=', today()->subWeek())
            ->groupBy('habit_id')
            ->count('habit_id');
    }
}
