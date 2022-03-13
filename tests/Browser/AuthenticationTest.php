<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class AuthenticationTest extends DuskTestCase
{
    use DatabaseMigrations, WithFaker;

    public function testRegister()
    {
        $this->browse(function ($browser) {
            $browser->visit('/register')
                ->type('name', $this->faker->firstName())
                ->type('email', $this->faker->safeEmail())
                ->type('password', 'password')
                ->type('password_confirmation', 'password')
                ->click('button[type="button"]')
                ->waitForText('Login')
                ->assertSee('Login');
        });
    }

    public function testLogin()
    {
        $user = User::factory()->create([
            'email' => 'raf@gmail.com',
        ]);

        $this->browse(function ($browser) use ($user) {
            $browser->visit('/login')
                ->type('@email-input', $user->email)
                ->type('@password-input', 'password')
                ->click('@btn-login')
                ->waitForText('MY BOOKINGS')
                ->assertSee('MY BOOKINGS');
        });
    }
}
