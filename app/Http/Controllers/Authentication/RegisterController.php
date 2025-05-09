<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use App\Http\Requests\Authentication\RegisterRequest;
use App\Models\ProgramStudy;
use App\Models\SchoolClass;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        $programStudies = ProgramStudy::all();
        $schoolClasses = SchoolClass::all();
        return view('authentication.register', compact('programStudies', 'schoolClasses'));
    }

    public function register(Request $request)
    {
        // $data = $request->validate([
        //     'name' => 'required|string|max:255',
        //     'identification_number' => 'required|string|max:255|unique:students',
        //     'email' => 'required|email|unique:students',
        //     'password' => 'required|string|min:8|confirmed',
        //     'program_study_id' => 'required|exists:program_studies,id',
        //     'school_class_id' => 'required|exists:school_classes,id',
        //     'phone_number' =>'required',
        // ]);

        $student = Student::create([
            'name' => $request->name,
            'identification_number' => $request->identification_number,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'program_study_id' => $request->program_study_id,
            'school_class_id' => $request->school_class_id,
            'phone_number' => $request->phone_number,
        ]);

        // Auth::guard('student')->login($student);
        $student->sendEmailVerificationNotification();
        // Pengguna telah memverifikasi email mereka, lakukan login
        Auth::login($student);
        return redirect()->route('login')->with('success', 'Registrasi berhasil! Harap verifikasi email Anda.');
    }
}
