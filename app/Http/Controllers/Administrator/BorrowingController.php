<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Models\Borrowing;
use Illuminate\Contracts\View\View;

class BorrowingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        // Mengambil data peminjaman dengan relasi ke tabel student, commodity, dan officer
        $borrowings = Borrowing::with('student:id,identification_number,name', 'commodity:id,name', 'officer:id,name')
            // Memilih kolom yang akan diambil dari tabel borrowings
            ->select('id', 'commodity_id', 'student_id', 'officer_id', 'date', 'time_start', 'time_end')
            // Menyaring data berdasarkan tanggal hari ini
            ->whereDate('date', now())
            // Mengurutkan data berdasarkan tanggal secara descending
            ->orderBy('date', 'DESC')
            // Mendapatkan hasil query
            ->get();

        // Menampilkan view 'administrator.borrowing.main.index' dengan data borrowings
        return view('administrator.borrowing.main.index', compact('borrowings'));
    }
}
