<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HabitTest extends TestCase
{
    use RefreshDatabase;

    public function test_see_create_form()
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

    public function test_create()
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
}
