<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class BookRoomTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function test_can_see_my_bookings()
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
