<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Models\Administrator;
use App\Models\Commodity;
use App\Models\Student;
use App\Repositories\BorrowingRepository;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // Konstruktor untuk menginisialisasi repository Borrowing
    public function __construct(
        private BorrowingRepository $repository
    ) {
    }

    /**
     * Menangani request yang masuk.
     */
    public function __invoke(Request $request)
    {
        // Menghitung jumlah total mahasiswa, administrator, dan komoditas
        $counts = [
            'student' => Student::select('id')->count(),
            'administrator' => Administrator::select('id')->count(),
            'commodity' => Commodity::select('id')->count(),
        ];

        // Mengambil tiga mahasiswa terbaru yang terdaftar
        $latestRegisteredStudents = Student::select('name', 'email')->latest()->take(3)->get();

        // Mengambil data komoditas yang dipinjam oleh mahasiswa dan belum dikembalikan
        $borrowingsNotReturned = $this->repository->getCommoditiesNotReturnedByStudent();

        // Menampilkan view 'administrator.dashboard' dengan data yang diperlukan
        return view('administrator.dashboard', compact('counts', 'latestRegisteredStudents', 'borrowingsNotReturned'));
    }
}
