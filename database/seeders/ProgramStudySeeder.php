<?php

namespace Database\Seeders;

use App\Models\ProgramStudy;
use Illuminate\Database\Seeder;

class ProgramStudySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $programStudies = [
            'Teknologi Rekayasa Perangkat Lunak', 'Teknik Komputer',
            'Manajemen Informatika', 'Animasi', ' Sistem Informasi'
        ];

        foreach ($programStudies as $programStudy) {
            ProgramStudy::create([
                'name' => $programStudy,
            ]);
        }
    }
}
