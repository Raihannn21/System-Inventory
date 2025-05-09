<?php

use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\Administrator\BeritaController;
use App\Http\Controllers\Administrator\StudentController as AdministratorStudentController;
use App\Http\Controllers\Administrator\CommodityController as AdministratorCommoditytController;
use App\Http\Controllers\Administrator\BorrowingController;
use App\Http\Controllers\Administrator\BorrowingHistoryController;
use App\Http\Controllers\Administrator\BorrowingReportController;
use App\Http\Controllers\Administrator\CommodityController;
use App\Http\Controllers\Administrator\DashboardController;
use App\Http\Controllers\Administrator\KategoriController;
use App\Http\Controllers\Administrator\ProfileSettingController;
use App\Http\Controllers\Administrator\ProgramStudyController;
use App\Http\Controllers\Administrator\SchoolClassController;
use App\Http\Controllers\Administrator\StudentController;
use App\Http\Controllers\Administrator\SubjectController;
use App\Http\Controllers\Administrator\UserController;
use App\Http\Controllers\BugreportController;
use App\Http\Controllers\Exports\BorrowingReportExport;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:administrator')->name('administrators.')->prefix('administrator')->group(function () {
    Route::get('/dashboard', DashboardController::class)->name('dashboard');

    Route::resource('commodities', CommodityController::class)->except(
        'create',
        'show',
        'edit'
    );
    Route::post('/commodities/import', [CommodityController::class, 'import'])->name('commodities.import');

    Route::resource('program-studies', ProgramStudyController::class)->except(
        'create',
        'show',
        'edit'
    );
    Route::post('/program-studies/import', [ProgramStudyController::class, 'import'])->name('program-studies.import');

    Route::resource('school-classes', SchoolClassController::class)->except(
        'create',
        'show',
        'edit'
    );
    Route::post('/school-classes/import', [SchoolClassController::class, 'import'])->name('school-classes.import');

    Route::resource('subjects', SubjectController::class)->except(
        'create',
        'show',
        'edit'
    );
    Route::post('/subjects/import', [SubjectController::class, 'import'])->name('subjects.import');

    Route::resource('students', StudentController::class)->except(
        'create',
        'show',
        'edit'
    );

    Route::resource('users', UserController::class)->except(
        'create',
        'show',
        'edit'
    );

    Route::get('/borrowings', [BorrowingController::class, 'index'])->name('borrowings.index');
    Route::get('/borrowings/report', [BorrowingReportController::class, 'index'])->name('borrowings-report.index');

    Route::get('/borrowings/history', BorrowingHistoryController::class)->name('borrowings-history.index');

    Route::get('/borrowings/report/export/{start_date}/{end_date}', [BorrowingReportExport::class, 'export'])->name('borrowings-report.export');

    Route::get('/export', [AdministratorStudentController::class, 'StudentExport'])->name('exportStudent');
    Route::get('/export2', [AdministratorCommoditytController::class, 'CommodityExport'])->name('exportCommodity');

    //Route untuk kategori

    Route::resource('kategoris', KategoriController::class)->except(
        'create',
        'edit'
    );

    //Route untuk Berita
    Route::resource('beritas', BeritaController::class)->except(
        'create',
        'edit'
    );
Route::get('activity',[ActivityLogController::class, 'index' ]);
Route::get('stock-commodity', [CommodityController::class, 'stock']);
Route::get('bug-report', [BugreportController::class, 'viewAdmin']);

});
