<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash; // Import Hash facade
use Faker\Factory as Faker; // Import Faker

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Inisialisasi Faker
        $faker = Faker::create();

        // Membuat satu data mahasiswa secara manual
        Student::create([
            'program_study_id' => 1,
            'school_class_id' => 1,
            'identification_number' => '123456',
            'name' => 'Mahasiswa',
            'email' => 'mahasiswa@gmail.com',
            'password' => Hash::make('mahasiswa'), // Hash the password
            'phone_number' => $faker->phoneNumber(), // Use Faker for phone number
        ]);

        // Membuat data mahasiswa menggunakan factory
        $students = Student::factory(10)->make()->toArray();

        // Memasukkan data ke dalam array untuk diinsert
        $recordsToInsert = [];
        foreach ($students as $student) {
            $createdAt = now();
            $student['created_at'] = $createdAt;
            $student['updated_at'] = $createdAt;
            $recordsToInsert[] = $student;
        }

        // Mengelompokkan data dan memasukkan ke database
        foreach (array_chunk($recordsToInsert, count($recordsToInsert) / 2) as $chunk) {
            Student::insert($chunk);
        }
    }
}
