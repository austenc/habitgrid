<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Track extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected static function booted()
    {
        static::addGlobalScope('byUser', function (Builder $builder) {
            $builder->when(auth()->check(), function ($query) {
                return $query->whereHas('user', function ($q) {
                    $q->where('users.id', auth()->id());
                });
            });
        });
    }

    public function habit()
    {
        return $this->belongsTo(Habit::class);
    }

    public function user()
    {
        return $this->hasOneThrough(User::class, Habit::class, 'habits.id', 'users.id', 'habit_id', 'user_id');
    }
}
