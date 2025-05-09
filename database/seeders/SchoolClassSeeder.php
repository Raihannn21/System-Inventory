<?php

namespace Database\Seeders;

use App\Models\SchoolClass;
use Illuminate\Database\Seeder;

class SchoolClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create TRPL classes
        for ($i = 1; $i <= 4; $i++) {
            foreach (range('A', 'D') as $char) {
                $className = 'TRPL '.$i.$char;

                SchoolClass::create([
                    'name' => $className,
                ]);
            }
        }

        // Create TK classes
        for ($i = 1; $i <= 4; $i++) {
            foreach (range('A', 'B') as $char) {
                $className = 'TK '.$i.$char;

                SchoolClass::create([
                    'name' => $className,
                ]);
            }
        }

        // Create MI classes
        for ($i = 1; $i <= 3; $i++) {
            foreach (range('A', 'C') as $char) {
                $className = 'MI '.$i.$char;

                SchoolClass::create([
                    'name' => $className,
                ]);
            }
        }

        // Create SI classes
        for ($i = 1; $i <= 3; $i++) {
            foreach (range('A', 'C') as $char) {
                $className = 'SI '.$i.$char;

                SchoolClass::create([
                    'name' => $className,
                ]);
            }
        }

        // Create ANM class
        $className = 'ANM 1A';
        SchoolClass::create([
            'name' => $className,
        ]);
    }
}
