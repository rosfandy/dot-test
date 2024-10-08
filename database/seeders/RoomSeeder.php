<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Room; // Import model Room
use Faker\Factory as Faker;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 10; $i++) {
            Room::create([
                'name' => $faker->unique()->numerify('Room ###'),
            ]);
        }
    }
}
