<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ModelPembeli extends Model
{
      use HasFactory;

    protected $table = 'tb_pembeli';

    protected $fillable = [
        'nama',
        'email',
        'buku_id',
        'kategori',
        'tanggal_pembelian',
    ];

    protected $casts = [
        'tanggal_pembelian' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Relasi ke buku
    public function buku()
    {
        return $this->belongsTo(ModelBuku::class, 'buku_id');
    }
}
