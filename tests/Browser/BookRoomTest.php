<?php

namespace Tests\Browser;

use App\Models\User;
use Database\Seeders\RoomSeeder;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class BookRoomTest extends DuskTestCase
{
    use DatabaseMigrations;


    public function test_can_book_a_room()
    {
        $user = User::factory()->create([
            'email' => 'raf@gmail.com',
        ]);
        $this->seed([RoomSeeder::class]);
        $today = now();
        $this->browse(function ($browser) use ($user, $today) {
            $browser->visit('/login')
                ->type('@email-input', $user->email)
                ->type('@password-input', 'password')
                ->click('@btn-login')
                ->waitForText('Book A Room')
                ->assertSee('Book A Room')
                ->click('@book-a-room')
                ->waitForText('BOOK A ROOM')
                ->assertSee('BOOK A ROOM')
                ->select('room_id')
                ->keys('#start_date', $today->day)
                ->keys('#start_date', $today->month)
                ->keys('#start_date', $today->year)
                ->select('#start_hour')
                ->select('#start_minute')
                ->keys('#end_date', $today->day)
                ->keys('#end_date', $today->month)
                ->keys('#end_date', $today->year)
                ->select('end_hour')
                ->select('end_minute')
                ->type('reason', 'reason')
                ->click('@btn-submit')
                ->waitForText('Book A Room')
                ->assertSee('Book A Room');
        });
    }
}
