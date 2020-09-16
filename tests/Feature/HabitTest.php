<?php

namespace Tests\Feature;

use App\Models\Habit;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HabitTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
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
        $response->assertSee('action="'.route('habits.store').'"', false);
    }

    public function test_name_required_when_creating()
    {
        $response = $this->actingAs($this->user)->post(route('habits.store'));
        $response->assertSessionHasErrors(['name' => 'The name field is required.']);
    }

    public function test_can_create()
    {
        // post data to the "store" route
        $response = $this->actingAs($this->user)->post(route('habits.store'), [
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
            'user_id' => $this->user->id,
        ]);
    }

    public function test_can_see_edit_form()
    {
        $habit = factory(Habit::class)->create();
        $response = $this->actingAs($habit->user)->get(route('habits.edit', $habit));
        $response->assertSuccessful();
        $response->assertViewHas('habit', $habit);
        $response->assertSee(route('habits.update', $habit));
    }

    public function test_name_required_when_updating()
    {
        $habit = factory(Habit::class)->create();

        $response = $this->actingAs($habit->user)->put(route('habits.update', $habit), [
            'goal' => 2,
            'unit' => 'gallons',
        ]);

        $response->assertSessionHasErrors(['name' => 'The name field is required.']);
    }

    public function test_can_update()
    {
        // make habit
        $habit = factory(Habit::class)->create(['user_id' => $this->user->id]);

        // post some data to the habit update route
        $response = $this->actingAs($this->user)->put(route('habits.update', $habit), [
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
            'user_id' => $this->user->id,
        ]);
    }

    public function test_user_only_sees_own_habits()
    {
        $habitOfOtherUser = factory(Habit::class)->create();
        $habit = factory(Habit::class)->create(['user_id' => $this->user->id]);
        $response = $this->actingAs($this->user)->get(route('habits.index'));
        $habitsInView = $response->viewData('habits');
        $this->assertTrue($habitsInView->contains($habit));
        $this->assertFalse($habitsInView->contains($habitOfOtherUser));
    }
}
