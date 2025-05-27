<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ModelBuku extends Model
{
    protected $table = 'tb_buku';

    protected $fillable = [
        'judul_buku',
        'author',
        'tahun',
        'stok_buku',
        'kategori',
        'harga',
    ];

    // Timestamps default true, gak perlu ditulis kalau gak diubah
    public $timestamps = true;
}
