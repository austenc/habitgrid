<?php

namespace Tests\Feature;

use App\Http\Livewire\Login;
use App\Http\Livewire\Logout;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_see_login_form()
    {
        $this->get('/login')->assertSeeLivewire('login');
    }

    public function test_existing_user_can_log_in()
    {
        $user = User::factory()->create();

        Livewire::test(Login::class)
            ->set('email', $user->email)
            ->set('password', 'password')
            ->call('login')
            ->assertRedirect('/dashboard');

        $this->assertAuthenticated();
    }

    public function test_email_is_required()
    {
        Livewire::test(Login::class)
            ->call('login')
            ->assertHasErrors(['email' => 'required']);
    }

    public function test_email_is_valid_email()
    {
        Livewire::test(Login::class)
            ->set('email', 'Something')
            ->call('login')
            ->assertHasErrors(['email' => 'email']);
    }

    public function test_password_is_required()
    {
        Livewire::test(Login::class)
            ->call('login')
            ->assertHasErrors(['password' => 'required']);
    }

    public function test_password_is_minimum_eight_characters()
    {
        Livewire::test(Login::class)
            ->set('password', 'test')
            ->call('login')
            ->assertHasErrors(['password' => 'min']);
    }

    public function test_bad_credentials_show_error_on_login()
    {
        $component = Livewire::test(Login::class)
            ->set('email', 'example@example.com')
            ->set('password', 'wrongpassword')
            ->call('login')
            ->assertHasErrors('password');
    }

    public function test_authenticated_user_can_see_logout_button()
    {
        $user = User::factory()->create();
        $this->actingAs($user)->get('/dashboard')->assertSeeLivewire('logout');
    }

    public function test_authenticated_user_can_logout()
    {
        $user = User::factory()->create();
        Livewire::actingAs($user)
            ->test(Logout::class)
            ->call('logout')
            ->assertRedirect('/');

        $this->assertGuest();
    }

    public function test_remember_field_exists_in_login_component()
    {
        Livewire::test(Login::class)->assertSeeHtml('wire:model.defer="remember"');
    }

    public function test_user_can_be_remembered()
    {
        $user = User::factory()->create(['remember_token' => null]);
        Livewire::actingAs($user)
            ->test(Login::class)
            ->set('email', $user->email)
            ->set('password', 'password')
            ->set('remember', true)
            ->call('login')
            ->assertHasNoErrors();

        $this->assertAuthenticated();
        $this->assertDatabaseMissing('users', [
            'id' => $user->id,
            'remember_token' => null,
        ]);
    }
}
