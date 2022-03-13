<?php

namespace Tests\Feature\app\Http\Controllers;

use App\Models\Room;
use App\Models\User;
use Database\Seeders\RoomSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class RoomControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    public function can_get_rooms()
    {
        $this->seed([RoomSeeder::class]);
        Sanctum::actingAs(User::factory()->create());

        $response = $this->json('get','/api/rooms');

        $response->assertOk();
        $roomsCount = Room::query()->count();
        $this->assertEquals(20, $roomsCount);
    }

    /** @test */
    public function can_add_room()
    {
        $params = [
            'name' => 'ROOM-'.$this->faker->firstName()
        ];
        Sanctum::actingAs(User::factory()->admin()->create());
        $response = $this->json('post', '/api/rooms', $params);
        $response->assertOk();
        $roomCount = Room::query()->count();
        $this->assertEquals(1, $roomCount);
    }

    /** @test */
    public function can_update_room()
    {
        $room = Room::factory()->create();
        Sanctum::actingAs(User::factory()->admin()->create());
        $nameUpdate = "ROOM_UPDATED";
        $response = $this->json('put', "/api/rooms/{$room->id}", ['name' => $nameUpdate]);
        $response->assertOk();
        $this->assertDatabaseHas('rooms', ['id' => $room->id, 'name' => $nameUpdate]);
    }

    /** @test */
    public function can_delete_room()
    {
        $room = Room::factory(2)->create();
        Sanctum::actingAs(User::factory()->admin()->create());
        $response = $this->json('delete', "/api/rooms/{$room->first()->id}");
        $response->assertOk();
        $roomCount = Room::query()->count();
        $this->assertEquals(1, $roomCount);
    }
}
