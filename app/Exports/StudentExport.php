<?php

namespace App\Exports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class StudentExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Student::select(
            ['program_study_id','school_class_id','identification_number','name','email','phone_number',]
        )->get();
    }

    public function headings(): array
    {
        return [
            'program_study_id',
            'school_class_id',
            'identification_number',
            'name',
            'email',
            'phone_number'
        ];
    }

    public function map($student): array
    {
        return [
            $student->programStudy ? $student->programStudy->name : 'N/A',
            $student->schoolClass ? $student->schoolClass->name : 'N/A',       
            $student->identification_number,       
            $student->name,
            $student->email,
            $student->phone_number,
            
        ];
    }
}
