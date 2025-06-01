<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ModelPembeli extends Model
{
    use HasFactory;

    protected $table = 'tb_pembeli';

    protected $fillable = [
        'user_id',
        'nama',
        'buku_id',
        'judul_buku',
        'kategori',
        'stok_buku',
        'harga',
        'tanggal_pembelian',
    ];

    public $timestamps = true;

    public function buku()
    {
        return $this->belongsTo(ModelBuku::class, 'buku_id');
    }
    
    public function user()
    {
        return $this->belongsTo(ModelUser::class, 'user_id');
    }
}
