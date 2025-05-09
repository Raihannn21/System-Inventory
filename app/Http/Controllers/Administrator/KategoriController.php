<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        $kategoris = Kategori::all(); // Ambil semua data kategori
        return view('administrator.kategori.index', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|unique:kategoris|max:255', // Contoh validasi, sesuaikan sesuai kebutuhan
        ]);

        Kategori::create([
            'nama' => $request->nama,
        ]);
        Activity::createLog('add', 'menambahkan data kategori');
        return redirect()->route('administrators.kategoris.index')
                         ->with('success', 'Kategori berita berhasil ditambahkan.');
    }

    public function update(Request $request, Kategori $kategori)
    {
        $request->validate([
            'nama' => 'required|unique:kategoris,nama,'.$kategori->id.'|max:255',
        ]);
    
        $kategori->update($request->only('nama'));
        Activity::createLog('update', 'mengupdate data kategori');
        return redirect()->route('administrators.kategoris.index')
                         ->with('success', 'Kategori berita berhasil diperbarui.');
    }

    public function destroy(Kategori $kategori)
    {
        $kategori->delete();
        Activity::createLog('delete', 'menghapus data kategori');
        return redirect()->route('administrators.kategoris.index')
                         ->with('success', 'Kategori berita berhasil dihapus.');
    }
}
