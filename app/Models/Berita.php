<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasFactory;
    protected $fillable = ['judul', 'isi', 'penulis', 'gambar', 'kategori_id'];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class,'kategori_id');
    }
}
