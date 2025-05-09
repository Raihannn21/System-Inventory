<?php

namespace Database\Seeders;

use App\Models\Officer;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class OfficerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create(); // Initialize Faker

        Officer::create([
            'name' => 'dosen',
            'email' => 'dosen@gmail.com',
            'password' => Hash::make('dosen'), // Hash the password
            'phone_number' => $faker->phoneNumber(), // Use Faker for phone number
        ]);

        // Create 100 additional officer records using factory
        $officers = Officer::factory(100)->make()->toArray();

        // Insert records in chunks to optimize performance
        foreach (array_chunk($officers, ceil(count($officers) / 2)) as $chunk) {
            Officer::insert($chunk);
        }
    }
}
