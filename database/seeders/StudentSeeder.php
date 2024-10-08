<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student; // Import model Student
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 50; $i++) {
            Student::create([
                'name'    => $faker->name,
                'email'   => $faker->unique()->safeEmail,
                'password'   => Hash::make('student123'),
                'room_id' => rand(1, 10),
            ]);
        }
    }
}
