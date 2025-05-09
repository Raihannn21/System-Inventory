<?php

namespace App\Http\Controllers\Administrator;

use App\Exports\StudentExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Administrator\StoreStudentRequest;
use App\Http\Requests\Administrator\UpdateStudentRequest;
use App\Models\Activity;
use App\Models\ProgramStudy;
use App\Models\SchoolClass;
use App\Models\Student;
use Maatwebsite\Excel\Facades\Excel;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = Student::query();

        $query->when(request()->filled('program_study_id'), function ($q) {
            return $q->where('program_study_id', request('program_study_id'));
        });

        $query->when(request()->filled('school_class_id'), function ($q) {
            return $q->where('school_class_id', request('school_class_id'));
        });

        $students = $query->with('programStudy:id,name', 'schoolClass:id,name')->select(
            'id',
            'program_study_id',
            'school_class_id',
            'identification_number',
            'name',
        )->get();

        $programStudies = ProgramStudy::select('id', 'name')->get();
        $schoolClasses = SchoolClass::select('id', 'name')->get();

        return view('administrator.student.index', compact('students', 'programStudies', 'schoolClasses'));
    }

    /**
     * Store a newly created resource in storage.
     */

     public function StudentExport(){
        Activity::createLog('export', 'mengekspor data mahasiswa');
        return Excel::download(new StudentExport, 'Student.xlsx');
    }
    
    public function store(StoreStudentRequest $request)
    {
        $validated = $request->validated();

        Student::create([
            'program_study_id' => $validated['program_study_id'],
            'school_class_id' => $validated['school_class_id'],
            'identification_number' => $validated['identification_number'],
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'phone_number' => $validated['phone_number'],
        ]);
Activity::createLog('add', 'menambahkan data mahasiswa');
        return redirect()->route('administrators.students.index')->with('success', 'Data berhasil ditambahkan!');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStudentRequest $request, Student $student)
    {
        $validated = $request->validated();

        $student->update([
            'program_study_id' => $validated['program_study_id'],
            'school_class_id' => $validated['school_class_id'],
            'identification_number' => $validated['identification_number'],
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => ! is_null($validated['password']) ? bcrypt($validated['password']) : $student->password,
            'phone_number' => $validated['phone_number'],
        ]);
Activity::createLog('update', 'mengubah data mahasiswa');
        return redirect()->route('administrators.students.index')->with('success', 'Data berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        $student->delete();
Activity::createLog('delete', 'menghapus data mahasiswa');
        return redirect()->route('administrators.students.index')->with('success', 'Data berhasil dihapus!');
    }
}
