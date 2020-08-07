<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Habit extends Model
{
    protected $guarded = ['id'];

    public function tracks()
    {
        return $this->hasMany(Track::class);
    }

    // Thanks Rel904 <3
    public function currentStreak()
    {
        $streaksByRow = DB::table('tracks')
            ->selectRaw('id, DATE_ADD(tracked_on, INTERVAL -ROW_NUMBER() OVER(
                PARTITION BY habit_id ORDER BY tracked_on
            ) DAY) AS startDate')
            ->where('habit_id', $this->getKey());

        return $this->hasOne(Track::class)
            ->selectRaw('MAX(tracked_on) AS last_tracked_on, count(streaks.id) AS length, streaks.startDate')
            ->leftJoinSub($streaksByRow, 'streaks', function ($join) {
                $join->on('streaks.id', '=', 'tracks.id')->where('habit_id', $this->getKey());
            })
            ->groupByRaw('streaks.startDate')
            ->havingRaw('(last_tracked_on >= DATE_SUB(CURDATE(), INTERVAL 1 DAY))')
            ->withDefault();
    }
}
