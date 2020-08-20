<?php

namespace Tests\Feature;

use App\Http\Livewire\Login;
use App\Http\Livewire\Logout;
use App\User;
use Livewire;
use Tests\TestCase;

class LoginTest extends TestCase
{
    public function test_can_see_login_form()
    {
        $this->get('/login')->assertSeeLivewire('login');
    }

    public function test_existing_user_can_log_in()
    {
        $user = factory(User::class)->create();

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

    public function test_authenticated_user_can_see_logout_button()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user)->get('/dashboard')->assertSeeLivewire('logout');
    }

    public function test_authenticated_user_can_logout()
    {
        $user = factory(User::class)->create();

        Livewire::actingAs($user)
            ->test(Logout::class)
            ->call('logout')
            ->assertRedirect('/');

        $this->assertGuest();
    }
}
