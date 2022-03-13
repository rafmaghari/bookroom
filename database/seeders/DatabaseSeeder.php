<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         User::factory()->admin()->create([
             'email' => 'admin@gmail.com',
             'password' => bcrypt('admin123'), // admin123
         ]);
        $this->call([
            RoomSeeder::class
        ]);
    }
}
