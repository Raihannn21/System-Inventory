<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Berita;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BeritaController extends Controller
{
    // Fungsi untuk menampilkan semua berita dan kategori
    public function index()
    {
        // Mengambil semua data berita beserta kategori terkait
        $beritas = Berita::with('kategori')->get();
        // Mengambil semua data kategori
        $kategoris = Kategori::all();
    
        // Menampilkan view 'administrator.berita.index' dengan data berita dan kategori
        return view('administrator.berita.index', compact('beritas', 'kategoris'));
    }

    // Fungsi untuk menyimpan berita baru
    public function store(Request $request)
    {
        // Validasi input dari form
        $request->validate([
            'judul' => 'required|string|max:255', // Judul berita harus diisi, berupa string, maksimal 255 karakter
            'isi' => 'required', // Isi berita harus diisi
            'penulis' => 'required|string|max:255', // Penulis berita harus diisi, berupa string, maksimal 255 karakter
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Gambar tidak wajib diisi, harus berupa file gambar dengan format tertentu, maksimal 2048 KB
            'kategori_id' => 'nullable|exists:kategoris,id' // Kategori berita tidak wajib diisi, harus ada di tabel kategoris
        ]);
        
        // Menyimpan gambar jika ada, dan mengambil path-nya
        $path = $request->file('gambar') ? $request->file('gambar')->store('public/gambar') : null;
        
        // Membuat berita baru dengan data yang sudah divalidasi
        Berita::create([
            'judul' => $request->judul,
            'isi' => $request->isi,
            'penulis' => $request->penulis,
            'gambar' => $path,
            'kategori_id' => $request->kategori_id,
        ]);
        
        // Mencatat aktivitas pembuatan berita baru
        Activity::createLog('add', 'menambahkan data berita');
    
        // Redirect ke halaman index berita dengan pesan sukses
        return redirect()->route('administrators.beritas.index')->with('success', 'Berita berhasil ditambahkan.');
    }
    
    // Fungsi untuk menampilkan form edit berita berdasarkan id
    public function edit($id)
    {
        // Mengambil berita berdasarkan id
        $berita = Berita::findOrFail($id);
        // Menampilkan view 'administrator.berita.edit' dengan data berita
        return view('administrator.berita.edit', compact('berita'));
    }
    
    // Fungsi untuk mengupdate berita berdasarkan id
    public function update(Request $request, $id)
    {
        // Mengambil berita berdasarkan id
        $berita = Berita::findOrFail($id);
    
        // Validasi input dari form
        $request->validate([
            'judul' => 'sometimes|required|string|max:255', // Judul berita kadang harus diisi, berupa string, maksimal 255 karakter
            'isi' => 'sometimes|required', // Isi berita kadang harus diisi
            'penulis' => 'sometimes|required|string|max:255', // Penulis berita kadang harus diisi, berupa string, maksimal 255 karakter
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Gambar tidak wajib diisi, harus berupa file gambar dengan format tertentu, maksimal 2048 KB
            'kategori_id' => 'nullable|exists:kategoris,id' // Kategori berita tidak wajib diisi, harus ada di tabel kategoris
        ]);
    
        // Jika ada file gambar yang di-upload
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($berita->gambar) {
                Storage::delete($berita->gambar);
            }
            // Menyimpan gambar baru dan mengambil path-nya
            $path = $request->file('gambar')->store('public/images');
            $berita->gambar = $path;
        }
    
        // Mengupdate berita dengan data yang sudah divalidasi
        $berita->update($request->only('judul', 'isi', 'penulis', 'kategori_id'));
        // Mencatat aktivitas pengupdatean berita
        Activity::createLog('update', 'mengupdate data berita');
    
        // Redirect ke halaman index berita dengan pesan sukses
        return redirect()->route('administrators.beritas.index')->with('success', 'Berita berhasil diperbarui.');
    }
    
    // Fungsi untuk menghapus berita berdasarkan id
    public function destroy($id)
    {
        // Mengambil berita berdasarkan id
        $berita = Berita::findOrFail($id);
    
        // Jika ada file gambar yang terkait dengan berita, hapus file tersebut
        if ($berita->gambar) {
            Storage::delete($berita->gambar);
        }
    
        // Menghapus berita dari database
        $berita->delete();
        // Mencatat aktivitas penghapusan berita
        Activity::createLog('delete', 'menghapus data berita');
    
        // Redirect ke halaman index berita dengan pesan sukses
        return redirect()->route('administrators.beritas.index')->with('success', 'Berita berhasil dihapus.');
    }
}
