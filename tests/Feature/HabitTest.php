<?php

namespace Tests\Feature;

use App\Habit;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HabitTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_see_create_form()
    {
        $response = $this->get(route('habits.index'));
        $response->assertSuccessful();
        $response->assertSee('Habit Name');
        $response->assertSee('action="'.route('habits.store').'"', false);
    }

    public function test_name_required_when_creating()
    {
        $response = $this->post(route('habits.store'));
        $response->assertSessionHasErrors(['name' => 'The name field is required.']);
    }

    public function test_can_create()
    {
        // post data to the "store" route
        $response = $this->post(route('habits.store'), [
            'name' => 'Drink Water',
            'goal' => 2,
            'unit' => 'gallons',
        ]);

        // see successful response
        $response->assertRedirect(route('habits.index'));

        // see that the data was stored in the databse
        $this->assertDatabaseHas('habits', [
            'name' => 'Drink Water',
            'goal' => 2,
            'unit' => 'gallons',
        ]);
    }

    public function test_can_see_edit_form()
    {
        $habit = factory(Habit::class)->create();
        $response = $this->get(route('habits.edit', $habit));
        $response->assertSuccessful();
        $response->assertViewHas('habit', $habit);
        $response->assertSee(route('habits.update', $habit));
    }

    public function test_name_required_when_updating()
    {
        $habit = factory(Habit::class)->create();

        $response = $this->put(route('habits.update', $habit), [
            'goal' => 2,
            'unit' => 'gallons',
        ]);

        $response->assertSessionHasErrors(['name' => 'The name field is required.']);
    }

    public function test_can_update()
    {
        // make habit
        $habit = factory(Habit::class)->create();

        // post some data to the habit update route
        $response = $this->put(route('habits.update', $habit), [
            'name' => 'Drink Water',
            'goal' => 2,
            'unit' => 'gallons',
        ]);

        // see redirected back to habit form
        $response->assertRedirect(route('habits.edit', $habit));

        // see message is flashed to the session
        $response->assertSessionHas(['message' => 'Habit updated successfully.']);

        // see that it persisted in the database
        $this->assertDatabaseHas('habits', [
            'id' => $habit->id,
            'name' => 'Drink Water',
            'goal' => 2,
            'unit' => 'gallons',
        ]);
    }
}
