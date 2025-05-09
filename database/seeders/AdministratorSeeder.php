<?php

namespace Database\Seeders;

use App\Models\Administrator;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash; // Import Hash facade
use Faker\Factory as Faker; // Import Faker

class AdministratorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create(); // Initialize Faker

        Administrator::create([
            'name' => 'Administrator',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('Raihan'), // Hash the password
            'phone_number' => $faker->phoneNumber(), // Use Faker for phone number
        ]);

        // Create 10 additional administrator records using factory
        $administrators = Administrator::factory(10)->make()->toArray();

        // Insert records in chunks to optimize performance
        foreach (array_chunk($administrators, ceil(count($administrators) / 2)) as $chunk) {
            Administrator::insert($chunk);
        }
    }
}
