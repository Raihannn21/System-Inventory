<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Models\Borrowing;

class BorrowingReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Membuat query dasar untuk model Borrowing
        $query = Borrowing::query();

        // Menambahkan filter berdasarkan rentang tanggal jika parameter 'start_date' dan 'end_date' ada dalam request
        $query->when(request()->has('start_date') && request()->has('end_date'), function ($q) {
            return $q->whereBetween('date', [request('start_date'), request('end_date')]);
        });

        // Menjalankan query dengan relasi dan memilih kolom tertentu
        $borrowings = $query->with('commodity:id,name', 'student:id,identification_number,name', 'officer:id,name')
            ->select('id', 'commodity_id', 'student_id', 'officer_id', 'date', 'time_start', 'time_end')
            ->orderBy('date', 'DESC')
            ->get();

        // Menampilkan view 'administrator.borrowing.report.index' dengan data borrowings
        return view('administrator.borrowing.report.index', compact('borrowings'));
    }
}
