<?php

use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\Authentication\LoginController;
use App\Http\Controllers\Authentication\LogoutController;
use App\Http\Controllers\Authentication\RegisterController;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application.
|
*/

// Routes for guests (non-authenticated users)
Route::middleware('guest')->group(function () {
    Route::get('/', fn () => redirect()->route('login'));

    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'authenticate'])->name('login.post');
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register'])->name('register.post');
});

// Email verification routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/email/verify', function () {
        return view('auth.verify-email');
    })->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();

        return redirect('/home'); // Redirect to a suitable route after verification
    })->middleware(['auth', 'signed'])->name('verification.verify');

    Route::post('/email/verify/resend', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();

        return back()->with('resent', true);
    })->middleware(['auth', 'throttle:6,1'])->name('verification.resend');
});

// Logout route
Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');

// Load administrator routes if the user is authenticated as an administrator
Route::middleware('auth:administrator')->group(function () {
    require_once __DIR__.'/administrator.php';
});

// Load officer routes if the user is authenticated as an officer
Route::middleware('auth:officer')->group(function () {
    require_once __DIR__.'/officer.php';
});

// Load student routes if the user is authenticated as a student
Route::middleware('auth:student')->group(function () {
    require_once __DIR__.'/student.php';
});
