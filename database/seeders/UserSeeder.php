<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public $now = Carbon::DEFAULT_TO_STRING_FORMAT;

    public function run(): void
    {
        $faker = Factory::create();

        for($i=0;$i<5;$i++){
            User::create([
               'first_name' => $faker->firstName(),
                'last_name' => $faker->lastName(),
                'email' => $faker->email(),
                'password' => Hash::make('test123'),
                'role_id' => rand(1,2)
            ]);
        }
    }
}
