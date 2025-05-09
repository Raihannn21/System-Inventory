<?php

namespace App\Http\Controllers\Administrator;

use App\Exports\CommodityExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Administrator\StoreCommodityRequest;
use App\Http\Requests\Administrator\UpdateCommodityRequest;
use App\Http\Requests\ImportExcelRequest;
use App\Models\Activity;
use App\Models\Commodity;
use App\Services\ImportService;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class CommodityController extends Controller
{
    // Properti untuk menyimpan instance ImportService
    private ImportService $importService;

    // Konstruktor untuk menginisialisasi ImportService dengan model Commodity
    public function __construct()
    {
        $this->importService = new ImportService(new Commodity());
    }

    /**
     * Menampilkan daftar resource.
     */
    public function index()
    {
        // Mengambil data komoditas terbaru
        $commodities = Commodity::select('id', 'name', 'commodity_code')->latest()->get();

        // Menampilkan view 'administrator.commodity.index' dengan data komoditas
        return view('administrator.commodity.index', compact('commodities'));
    }

    /**
     * Mengekspor data komoditas ke file Excel.
     */
    public function CommodityExport()
    {
        // Membuat log aktivitas ekspor data
        Activity::createLog('export', 'mengekspor data barang');

        // Mengekspor data ke file commodity.xlsx
        return Excel::download(new CommodityExport, 'commodity.xlsx');
    }

    /**
     * Menyimpan resource yang baru dibuat ke dalam penyimpanan.
     */
    public function store(Request $request)
    {
        // Validasi data input
        $request->validate([
            'commodity_code' => 'required|string|min:3|max:255',
            'name' => 'required|string|max:255',
            'stock' => 'required|numeric',
        ]);

        // Menambahkan data komoditas baru ke database
        Commodity::create([
            'commodity_code' => $request->commodity_code,
            'name' => $request->name,
            'quantity' => $request->stock,
        ]);

        // Membuat log aktivitas penambahan data
        Activity::createLog('add', 'menambahkan data barang');

        // Mengarahkan kembali dengan pesan sukses
        return redirect()->route('administrators.commodities.store')->with('success', 'Data berhasil ditambahkan!');
    }

    /**
     * Memperbarui resource yang ditentukan dalam penyimpanan.
     */
    public function update(UpdateCommodityRequest $request, Commodity $commodity)
    {
        // Memperbarui data komoditas yang ada dengan data yang divalidasi
        $commodity->update($request->validated());

        // Membuat log aktivitas pembaruan data
        Activity::createLog('update', 'mengupdate data barang');

        // Mengarahkan kembali dengan pesan sukses
        return redirect()->route('administrators.commodities.index')->with('success', 'Data berhasil diubah!');
    }

    /**
     * Menghapus resource yang ditentukan dari penyimpanan.
     */
    public function destroy(Commodity $commodity)
    {
        // Menghapus data komoditas dari database
        $commodity->delete();

        // Membuat log aktivitas penghapusan data
        Activity::createLog('delete', 'menghapus data barang');

        // Mengarahkan kembali dengan pesan sukses
        return redirect()->route('administrators.commodities.index')->with('success', 'Data berhasil dihapus!');
    }

    /**
     * Mengimpor daftar resource.
     */
    public function import(ImportExcelRequest $request)
    {
        // Mengimpor data dari file Excel menggunakan ImportService
        $counts = $this->importService->importExcel($request->validated('import'), ['name'], 'name', 0);

        // Membuat pesan hasil impor
        $message = "Total {$counts['imported']} berhasil diimpor, {$counts['ignored']} dihiraukan!";

        // Mengarahkan kembali dengan pesan sukses
        return redirect()->route('administrators.commodities.index')->with('success', $message);
    }

    /**
     * Menampilkan stok komoditas.
     */
    public function stock()
    {
        // Mengambil data stok komoditas terbaru
        $commodities = Commodity::select('id', 'name', 'commodity_code', 'quantity')->latest()->get();

        // Menampilkan view 'administrator.commoditystock.index' dengan data stok komoditas
        return view('administrator.commoditystock.index')->with('commoditystock', $commodities);
    }
}
