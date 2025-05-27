<?php

namespace App\Http\Controllers;

use App\Models\ModelPembeli;
use App\Models\ModelBuku;
use Illuminate\Http\Request;

class PembeliController extends Controller
{
     public function index()
    {
        $pembelis = ModelPembeli::with('buku')->latest()->paginate(10);
        return view('pembelis.index', compact('pembelis'));
    }

    public function create()
    {
        $bukuList = ModelBuku::all();
        return view('pembelis.create', compact('bukuList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'email' => 'nullable|email|max:100',
            'buku_id' => 'required|exists:tb_buku,id',
            'kategori' => 'required|in:Fiksi,Nonfiksi,Komik,Pelajaran,Lainnya',
            'tanggal_pembelian' => 'required|date',
        ]);

        ModelPembeli::create($request->all());

        return redirect()->route('pembelis.index')->with('success', 'Data pembeli berhasil disimpan.');
    }

    public function show(ModelPembeli $pembeli)
    {
        return view('pembelis.show', compact('pembeli'));
    }

    public function edit(ModelPembeli $pembeli)
    {
        $bukuList = ModelBuku::all();
        return view('pembelis.edit', compact('pembeli', 'bukuList'));
    }

    public function update(Request $request, ModelPembeli $pembeli)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'email' => 'nullable|email|max:100',
            'buku_id' => 'required|exists:tb_buku,id',
            'kategori' => 'required|in:Fiksi,Nonfiksi,Komik,Pelajaran,Lainnya',
            'tanggal_pembelian' => 'required|date',
        ]);

        $pembeli->update($request->all());

        return redirect()->route('pembelis.index')->with('success', 'Data pembeli berhasil diperbarui.');
    }

    public function destroy(ModelPembeli $pembeli)
    {
        $pembeli->delete();
        return redirect()->route('pembelis.index')->with('success', 'Data pembeli berhasil dihapus.');
    }
}
