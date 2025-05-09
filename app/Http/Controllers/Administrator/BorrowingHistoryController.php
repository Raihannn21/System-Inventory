<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Models\Borrowing;
use App\Models\Commodity;
use App\Models\Officer;
use App\Models\Student;
use Illuminate\Contracts\View\View;

class BorrowingHistoryController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(): View
    {
        // Membuat query dasar untuk model Borrowing
        $query = Borrowing::query();

        // Menambahkan filter berdasarkan tanggal jika parameter 'date' diisi dalam request
        $query->when(request()->filled('date'), function ($q) {
            return $q->whereDate('date', request('date'));
        });

        // Menambahkan filter berdasarkan status jika parameter 'status' diisi dalam request
        $query->when(request()->filled('status'), function ($q) {
            if (request('status') === '1') {
                // Jika status = 1, pilih data yang 'time_end' tidak null
                return $q->whereNotNull('time_end');
            }

            // Jika status bukan 1, pilih data yang 'time_end' null
            return $q->whereNull('time_end');
        });

        // Menambahkan filter berdasarkan student_id jika parameter 'student_id' diisi dalam request
        $query->when(request()->filled('student_id'), function ($q) {
            return $q->where('student_id', request('student_id'));
        });

        // Menambahkan filter berdasarkan validate jika parameter 'validate' diisi dalam request
        $query->when(request()->filled('validate'), function ($q) {
            if (request('validate') === '1') {
                // Jika validate = 1, pilih data yang 'officer_id' tidak null
                return $q->whereNotNull('officer_id');
            }

            // Jika validate bukan 1, pilih data yang 'officer_id' null
            return $q->whereNull('officer_id');
        });

        // Menambahkan filter berdasarkan commodity_id jika parameter 'commodity_id' diisi dalam request
        $query->when(request()->filled('commodity_id'), function ($q) {
            return $q->where('commodity_id', request('commodity_id'));
        });

        // Menjalankan query dengan relasi dan memilih kolom tertentu
        $borrowings = $query->with('commodity:id,name', 'student:id,identification_number,name', 'officer:id,name')
            ->select('id', 'commodity_id', 'student_id', 'officer_id', 'date', 'time_start', 'time_end')
            ->orderBy('date', 'DESC')
            ->get();

        // Mengambil data semua mahasiswa
        $students = Student::select('id', 'identification_number', 'name')->orderBy('identification_number')->get();

        // Mengambil data semua petugas
        $officers = Officer::select('id', 'name')->orderBy('name')->get();

        // Mengambil data semua komoditas
        $commodities = Commodity::select('id', 'name')->orderBy('name')->get();

        // Menampilkan view 'administrator.borrowing.history.index' dengan data borrowings, students, officers, dan commodities
        return view('administrator.borrowing.history.index', compact('borrowings', 'students', 'officers', 'commodities'));
    }
}
