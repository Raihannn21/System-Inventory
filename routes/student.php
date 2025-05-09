<?php

use App\Http\Controllers\Administrator\CommodityController;
use App\Http\Controllers\Administrator\StudentController as AdministratorStudentController;
use App\Http\Controllers\BugreportController;
use App\Http\Controllers\Student\BorrowingController;
use App\Http\Controllers\Student\BorrowingHistoryController;
use App\Http\Controllers\Student\DashboardController;
use App\Http\Controllers\Student\ProfileSettingController;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:student')->name('students.')->prefix('student')->group(function () {
    Route::get('/dashboard', DashboardController::class)->name('dashboard');

    Route::resource('borrowings', BorrowingController::class)->except(
        'create',
        'show',
        'edit',
        'destroy'
    );
    Route::put('/borrowings/return/{borrowing}', [BorrowingController::class, 'returnBorrowing'])->name('borrowings.return');

    Route::get('/borrowings/history', BorrowingHistoryController::class)->name('borrowings-history.index');

    Route::controller(ProfileSettingController::class)->group(function () {
        Route::get('/profile/settings', 'index')->name('profile-settings.index');
        Route::put('/profile/settings', 'update')->name('profile-settings.update');
    });
    Route::get('stock-commodity', [CommodityController::class, 'stock']);
    Route::get('bug-report', [BugreportController::class, 'index']);
    Route::post('bug-report', [BugreportController::class, 'store']);
});

    // Route::get('/export', [AdministratorStudentController::class, 'StudentExport'])->name('exportStudent');
