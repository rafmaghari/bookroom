<?php

namespace Tests\Feature\app\Http\Controllers;

use App\Models\Room;
use App\Models\RoomBooking;
use App\Models\User;
use Database\Seeders\RoomSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class RoomBookingControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = Sanctum::actingAs(User::factory()->create());
    }

    /** @test */
    public function can_validate_booking_of_room()
    {
        $response = $this->json('post','/api/room-bookings');
        $response->assertStatus(422)->assertJson([
            "message" => "The given data was invalid.",
            "errors" => [
                "room_id" => ["The room id field is required."],
                "start" => ["The start field is required."],
                "end" => ["The end field is required."],
                "reason" => ["The reason field is required."],
            ]
        ]);

    }

    /** @test */
    public function can_book_a_room()
    {
        $this->seed([RoomSeeder::class]);
        $roomId = Room::first()->id;
        $params = [
            'room_id' => $roomId,
            'start' => now()->format('Y-m-d H:i:s'),
            'end' => now()->addHour()->format('Y-m-d H:i:s'),
            'reason' => $this->faker->word()
        ];
        $response = $this->json('post','/api/room-bookings', $params);
        $response->assertOk();
        $roomBookingCount = RoomBooking::query()->count();
        $this->assertEquals(1, $roomBookingCount);
        $this->assertDatabaseHas('room_bookings', ['user_id' => $this->user->id, 'room_id' => $roomId]);
    }

    /** @test */
    public function can_update_booking()
    {
        $this->seed([RoomSeeder::class]);
        $roomBooking = RoomBooking::factory()->create([
            'user_id' => $this->user->id
        ]);
        $lastRoom = Room::query()->latest()->first()->id;
        $reason = 'UPDATE REASON';
        $params = [
            'room_id' => $lastRoom,
            'start' => now()->format('Y-m-d H:i:s'),
            'end' => now()->addHour()->format('Y-m-d H:i:s'),
            'reason' => $reason
        ];
        $response = $this->json('put',"/api/room-bookings/$roomBooking->id", $params);
        $response->assertOk();
        $this->assertDatabaseHas('room_bookings', ['id' => $roomBooking->id, 'reason' => $reason]);

    }

    /** @test */
    public function can_get_my_bookings()
    {
        $this->seed([RoomSeeder::class]);
        RoomBooking::factory(10)->create([
            'user_id' => $this->user->id
        ]);
        $response = $this->json('get',"/api/my-bookings");
        $response->assertOk();
        $roomBookingCount = RoomBooking::query()->count();
        $this->assertEquals(10, $roomBookingCount);
    }
}

