<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;
use App\Models\Administrator;
use App\Models\Officer;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileSettingController extends Controller
{
    /**
     * Display the profile settings based on the user's role.
     */
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'administrator') {
            $myInformation = Administrator::find($user->id);
            return view('administrator.profile_setting.index', compact('myInformation'));
        } elseif ($user->role === 'officer') {
            $myInformation = Officer::find($user->id);
            return view('officer.profile_setting.index', compact('myInformation'));
        } elseif ($user->role === 'student') {
            $myInformation = Student::find($user->id);
            return view('student.profile_setting.index', compact('myInformation'));
        }

        // Handle other roles or unexpected scenarios here
        abort(403, 'Unauthorized access.');
    }

    /**
     * Update the profile settings based on the user's role.
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        if ($user->role === 'administrator') {
            $model = Administrator::find($user->id);
        } elseif ($user->role === 'officer') {
            $model = Officer::find($user->id);
        } elseif ($user->role === 'student') {
            $model = Student::find($user->id);
        } else {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'phone_number' => 'nullable|string|max:20',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $model->name = $validated['name'];
        $model->email = $validated['email'];
        $model->phone_number = $validated['phone_number'];

        if (!empty($validated['password'])) {
            $model->password = Hash::make($validated['password']);
        }

        $model->save();
        Activity::createLog('update', 'mengupdate data profile');
        return redirect()->route($user->role . '.profile-settings.index')->with('success', 'Profile updated successfully.');
    }
}
