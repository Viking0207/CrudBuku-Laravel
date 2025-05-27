<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ModelBuku;
use Illuminate\Database\Eloquent\Model;

class BukuController extends Controller
{
    public function index()
    {
        $bukus = ModelBuku::all();
        return view('buku.index', compact('bukus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul_buku' => 'required',
            'author' => 'required',
            'tahun' => 'required|digits:4|integer',
            'stok_buku' => 'nullable|integer',
            'kategori' => 'nullable|in:Fiksi,Nonfiksi,Komik,Pelajaran,Lainnya',
            'harga' => 'nullable|numeric',
        ]);

        $validated = $request->all();
        $validated['harga'] = $request->harga_hidden;


        ModelBuku::create($validated);

        return redirect('/buku')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        $buku = ModelBuku::findOrFail($id);
        return view('buku.edit', compact('buku'));
    }

    public function update(Request $request, $id)
    {
        $buku = ModelBuku::findOrFail($id);

        $request->validate([
            'judul_buku' => 'required',
            'author' => 'required',
            'tahun' => 'required|digits:4|integer',
            'stok_buku' => 'nullable|integer',
            'kategori' => 'nullable|in:Fiksi,Nonfiksi,Komik,Pelajaran,Lainnya',
            'harga' => 'nullable|numeric',
        ]);

        $validated = $request->all();
        $validated['harga'] = $request->harga_hidden;


        $buku->update($validated);

        return redirect('/buku')->with('success', 'Data berhasil diperbarui');
    }

    public function destroy($id)
    {
        ModelBuku::destroy($id);
        return redirect('/buku')->with('success', 'Data berhasil dihapus');
    }
}
