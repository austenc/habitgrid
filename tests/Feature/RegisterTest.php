<?php

namespace Tests\Feature;

use App\Http\Livewire\Register;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_see_register_form()
    {
        $this->get(route('register'))->assertSeeLivewire('register');
    }

    public function test_can_register()
    {
        Livewire::test(Register::class)
            ->set('name', 'Me')
            ->set('email', 'me@example.com')
            ->set('password', 'password')
            ->set('password_confirmation', 'password')
            ->call('register')
            ->assertHasNoErrors(['name', 'email', 'password', 'password_confirmation'])
            ->assertRedirect('/');

        $this->assertDatabaseHas('users', [
            'name' => 'Me',
            'email' => 'me@example.com',
            // TODO: write a separate test for this
            // 'password' => Hash::check('test', 'someHashedValue'),
        ]);

        $this->assertAuthenticated();
    }

    public function test_name_is_required()
    {
        Livewire::test(Register::class)
            ->call('register')
            ->assertHasErrors(['name' => 'required']);
    }

    public function test_name_is_minimum_two_characters()
    {
        Livewire::test(Register::class)
            ->set('name', 'a')
            ->call('register')
            ->assertHasErrors(['name' => 'min']);
    }

    public function test_email_is_required()
    {
        Livewire::test(Register::class)
            ->call('register')
            ->assertHasErrors(['email' => 'required']);
    }

    public function test_email_must_be_unique()
    {
        $user = User::factory()->create(['email' => 'test@example.com']);
        $component = Livewire::test(Register::class)
            ->set('email', 'test@example.com')
            ->assertHasErrors(['email' => 'unique']);
    }

    public function test_email_is_valid_email()
    {
        Livewire::test(Register::class)
            ->set('email', 'Something')
            ->call('register')
            ->assertHasErrors(['email' => 'email']);
    }

    public function test_password_is_required()
    {
        Livewire::test(Register::class)
            ->call('register')
            ->assertHasErrors(['password' => 'required']);
    }

    public function test_password_is_minimum_eight_characters()
    {
        Livewire::test(Register::class)
            ->set('password', 'test')
            ->call('register')
            ->assertHasErrors(['password' => 'min']);
    }

    public function test_password_must_be_confirmed()
    {
        Livewire::test(Register::class)
            ->set('password', 'test')
            ->call('register')
            ->assertHasErrors(['password' => 'confirmed']);
    }

    public function test_password_confirmation_is_required()
    {
        Livewire::test(Register::class)
            ->call('register')
            ->assertHasErrors(['password_confirmation' => 'required']);
    }

    public function test_password_confirmation_matches_password()
    {
        Livewire::test(Register::class)
            ->set('password', 'test')
            ->set('password_confirmation', 'test2')
            ->call('register')
            ->assertHasErrors(['password_confirmation' => 'same']);
    }
}
