<?php

namespace Database\Factories;

use App\Models\Room;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class RoomBookingFactory extends Factory
{
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'room_id' => Room::factory(),
            'start' => now(),
            'end' => now()->addHour(),
            'reason' => $this->faker->word()
        ];
    }
}
