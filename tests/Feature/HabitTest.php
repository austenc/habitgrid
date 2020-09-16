<?php

namespace Tests\Feature;

use App\Http\Livewire\HabitForm;
use App\Http\Livewire\Habits;
use App\Models\Habit;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class HabitTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
    }

    public function test_guest_redirected_to_login_from_index()
    {
        $response = $this->get(route('habits.index'));
        $response->assertRedirect(route('login'));
    }

    public function test_can_see_create_form()
    {
        $response = $this->actingAs($this->user)->get(route('habits.index'));
        $response->assertSuccessful();
        $response->assertSee('Habit Name');
        $response->assertSeeLivewire('habit-form');
    }

    // TODO: write authorization tests

    public function test_name_required_when_saving()
    {
        Livewire::test(HabitForm::class)
            ->call('save')
            ->assertHasErrors(['habit.name' => 'required']);
    }

    public function test_can_create()
    {
        Livewire::actingAs($this->user)->test(HabitForm::class)
            ->set('habit.name', 'Drink Water')
            ->set('habit.goal', 2)
            ->set('habit.unit', 'gallons')
            ->call('save')
            ->assertEmitted('saved');

        // see that the data was stored in the databse
        $this->assertDatabaseHas('habits', [
            'name' => 'Drink Water',
            'goal' => 2,
            'unit' => 'gallons',
            'user_id' => $this->user->id,
        ]);
    }

    public function test_can_see_edit_form()
    {
        $habit = Habit::factory()->create();
        $response = $this->actingAs($habit->user)->get(route('habits.edit', $habit));
        $response->assertSuccessful();
        $response->assertSeeLivewire('habit-form');
    }

    public function test_can_update()
    {
        // make habit
        $habit = Habit::factory()->create(['user_id' => $this->user->id]);

        Livewire::actingAs($this->user)->test(HabitForm::class, ['habit' => $habit])
            ->set('habit.name', 'Drink Water')
            ->set('habit.goal', 2)
            ->set('habit.unit', 'gallons')
            ->call('save')
            ->assertEmitted('saved');

        // see that the data was stored in the databse
        $this->assertDatabaseHas('habits', [
            'name' => 'Drink Water',
            'goal' => 2,
            'unit' => 'gallons',
            'user_id' => $this->user->id,
        ]);

        // see that it persisted in the database
        $this->assertDatabaseHas('habits', [
            'id' => $habit->id,
            'name' => 'Drink Water',
            'goal' => 2,
            'unit' => 'gallons',
            'user_id' => $this->user->id,
        ]);
    }

    public function test_user_only_sees_own_habits()
    {
        $habitOfOtherUser = Habit::factory()->create();
        $habit = Habit::factory()->create(['user_id' => $this->user->id]);
        $component = Livewire::actingAs($this->user)->test(Habits::class);
        $this->assertTrue($component->viewData('habits')->contains($habit));
        $this->assertFalse($component->viewData('habits')->contains($habitOfOtherUser));
    }
}
