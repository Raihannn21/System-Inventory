<?php

namespace Database\Seeders;

use App\Models\Subject;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Subject::create([
            'code' => 'BSD001',
            'name' => 'Basis Data',
        ]);
        Subject::create([
            'code' => 'PBL002',
            'name' => 'Project Based Learning',
        ]);
        Subject::create([
            'code' => 'PBL003',
            'name' => 'Pemograman Framework',
        ]);
        Subject::create([
            'code' => 'PBL004',
            'name' => 'Rekayasa Kebutuhan Perangkat Lunak',
        ]);
    }
}
