<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Track extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function habit()
    {
        return $this->belongsTo(Habit::class);
    }

    public function scopeTotalHabitsInPastWeek()
    {
        return self::distinct('habit_id')
            ->whereDate('tracked_on', '>=', today()->subWeek())
            ->count('habit_id');
    }
}
