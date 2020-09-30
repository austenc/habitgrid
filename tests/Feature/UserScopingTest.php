<?php

namespace Tests\Feature;

use App\Http\Livewire\DayGrid;
use App\Http\Livewire\Habits;
use App\Models\Habit;
use App\Models\Track;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class UserScopingTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->habit = Habit::factory()->create();
        $this->track = Track::factory()->create([
            'habit_id' => $this->habit->id,
            'tracked_on' => today(),
        ]);
        $this->otherUserTrack = Track::factory()->create(['tracked_on' => today()]);
        $this->component = Livewire::actingAs($this->habit->user)->test(DayGrid::class);
    }

    public function test_tracks_scoped_to_authenticated_user()
    {
        $habitsTrackedToday = $this->component->viewData('_instance')->totalsByDay->get(today()->format('Y-m-d'));
        $this->assertEquals(1, $habitsTrackedToday);
    }

    public function test_habits_scoped_to_authenticated_user()
    {
        $component = Livewire::actingAs($this->habit->user)->test(Habits::class);
        $this->assertEquals(1, $component->viewData('habits')->count());
    }
}
