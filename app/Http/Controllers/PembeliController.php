<?php

namespace App\Http\Controllers;

use App\Models\ModelPembeli;
use App\Models\ModelBuku;
use App\Models\ModelUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PembeliController extends Controller
{
    public function index()
    {
        $pembelis = ModelPembeli::with('buku')->latest()->get();
        $bukus = ModelBuku::all();  
        $users = ModelUser::all();

        // Hitung stok tersedia untuk setiap buku
        foreach ($bukus as $buku) {
            $jumlah_terjual = DB::table('tb_pembeli')
                ->where('buku_id', $buku->id)
                ->sum('stok_buku');

            $buku->stok_tersedia = $buku->stok_buku - $jumlah_terjual;
        }

        return view('pembeli.index', compact('pembelis', 'bukus', 'users'));
    }

    public function create()
    {
        $bukus = ModelBuku::all();
        $users = ModelUser::all();

        foreach ($bukus as $buku) {
            $jumlah_terjual = DB::table('tb_pembeli')
                ->where('buku_id', $buku->id)
                ->sum('stok_buku');

            $buku->stok_tersedia = $buku->stok_buku - $jumlah_terjual;
        }

        return view('pembeli.create', compact('bukus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'buku_id' => 'required|exists:tb_buku,id',
            'jumlah' => 'required|integer|min:1',
            'tanggal_pembelian' => 'required|date',
        ]);

        $buku = ModelBuku::findOrFail($request->buku_id);

        if ($request->jumlah > $buku->stok_buku) {
            return back()->withErrors(['jumlah' => 'Jumlah melebihi stok yang tersedia!'])->withInput();
        }

        $total_harga = $buku->harga * $request->jumlah;

        ModelPembeli::create([
            'user_id' => Auth::id(),
            'nama' => $request->nama,
            'buku_id' => $buku->id,
            'judul_buku' => $buku->judul_buku,
            'kategori' => $buku->kategori,
            'stok_buku' => $request->jumlah,
            'harga' => $total_harga,
            'tanggal_pembelian' => $request->tanggal_pembelian,
        ]);

        // Kurangi stok buku di tb_buku
        $buku->stok_buku -= $request->jumlah;
        $buku->save();

        return redirect('/pembeli')->with('success', 'Data pembeli berhasil ditambahkan');
    }

    public function edit($id)
    {
        $pembeli = ModelPembeli::findOrFail($id);
        $bukus = ModelBuku::all();
        $users = ModelUser::all();

        foreach ($bukus as $buku) {
            $jumlah_terjual = DB::table('tb_pembeli')
                ->where('buku_id', $buku->id)
                ->where('id', '!=', $pembeli->id) // abaikan pembelian saat ini
                ->sum('stok_buku');

            $buku->stok_tersedia = $buku->stok_buku - $jumlah_terjual;
        }

        return view('pembeli.edit', compact('pembeli', 'bukus'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'buku_id' => 'required|exists:tb_buku,id',
            'jumlah' => 'required|integer|min:1',
            'tanggal_pembelian' => 'required|date',
        ]);

        $pembeli = ModelPembeli::findOrFail($id);
        $buku = ModelBuku::findOrFail($request->buku_id);

        // Tambahkan dulu stok lama kembali (rollback)
        $buku->stok_buku += $pembeli->stok_buku;

        // Cek apakah stok mencukupi untuk permintaan baru
        if ($request->jumlah > $buku->stok_buku) {
            return back()->withErrors(['jumlah' => 'Jumlah melebihi stok yang tersedia!'])->withInput();
        }

        $total_harga = $buku->harga * $request->jumlah;

        // Update data pembeli
        $pembeli->update([
            'user_id' => Auth::id(),
            'nama' => $request->nama,
            'buku_id' => $buku->id,
            'judul_buku' => $buku->judul_buku,
            'kategori' => $buku->kategori,
            'stok_buku' => $request->jumlah,
            'harga' => $total_harga,
            'tanggal_pembelian' => $request->tanggal_pembelian,
        ]);

        // Kurangi stok dengan jumlah baru
        $buku->stok_buku -= $request->jumlah;
        $buku->save();

        return redirect('/pembeli')->with('success', 'Data pembeli berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $pembeli = ModelPembeli::findOrFail($id);
        $buku = ModelBuku::findOrFail($pembeli->buku_id);

        // Tambahkan kembali stok buku
        $buku->stok_buku += $pembeli->stok_buku;
        $buku->save();

        $pembeli->delete();

        return redirect('/pembeli')->with('success', 'Data pembeli berhasil dihapus');
    }
}
