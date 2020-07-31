<?php

namespace Tests\Feature;

use App\Habit;
use App\Http\Livewire\DayGrid;
use App\Track;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire;
use Tests\TestCase;

class DayGridTest extends TestCase
{
    use RefreshDatabase;

    public $component;
    public $habit;

    public function setUp(): void
    {
        parent::setUp();

        $this->component = Livewire::test(DayGrid::class);
        $this->habit = factory(Habit::class)->create();
    }

    public function test_dashboard_shows_grid_component()
    {
        $this->get('/')->assertSeeLivewire('day-grid');
    }

    public function test_can_select_new_day()
    {
        $this->component->assertSet('selected', $this->component->selected)
            ->call('toggleDay', today()->subDay()->serialize())
            ->assertSet('selected', today()->subDay()->serialize());
    }

    public function test_can_unselect_current_day()
    {
        $this->component->call('toggleDay', $this->component->selected)
            ->assertSet('selected', null);
    }

    public function test_can_add_track_for_habit()
    {
        $this->component->call('addTrack', $this->habit->id);

        // Habit has a track for this day (in the component data)
        $this->assertContains(
            $this->component->selected,
            $this->component->viewData('_instance')->habits->keyBy('id')->get($this->habit->id)->refresh()->tracks->pluck('tracked_on')
        );

        $this->assertDatabaseHas('tracks', [
            'habit_id' => $this->habit->id,
            'tracked_on' => $this->component->selected,
        ]);
    }

    public function test_can_remove_track_for_habit()
    {
        $this->component->call('removeTrack', $this->habit->id);

        $trackOnOtherDay = factory(Track::class)->create([
            'habit_id' => $this->habit->id,
            'tracked_on' => today()->subDay(3)->startOfDay(),
        ]);

        // Habit missing the track for day we removed
        $this->assertNotContains(
            $this->component->selected,
            $this->component->viewData('_instance')->habits->keyBy('id')->get($this->habit->id)->refresh()->tracks->pluck('tracked_on')
        );
        $this->assertDatabaseMissing('tracks', [
            'habit_id' => $this->habit->id,
            'tracked_on' => $this->component->selected,
        ]);

        // Habit has a track for other day (in the component data)
        $this->assertContains(
            $trackOnOtherDay->tracked_on->format('Y-m-d H:i:s'),
            $this->component->viewData('_instance')->habits->keyBy('id')->get($this->habit->id)->refresh()->tracks->pluck('tracked_on')
        );
        $this->assertDatabaseHas('tracks', [
            'id' => $trackOnOtherDay->id,
            'habit_id' => $this->habit->id,
        ]);
    }
}
