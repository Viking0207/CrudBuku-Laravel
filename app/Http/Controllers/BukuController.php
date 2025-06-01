<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ModelBuku;
use Illuminate\Support\Facades\Storage;

class BukuController extends Controller
{
    public function index()
    {
        $bukus = ModelBuku::all();
        return view('buku.index', compact('bukus'));
    }

    public function admin()
    {
        $bukus = ModelBuku::all();
        return view('admin.buku.index', compact('bukus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul_buku' => 'required',
            'author' => 'required',
            'tahun' => 'required|digits:4|integer',
            'stok_buku' => 'nullable|integer',
            'kategori' => 'nullable|in:Fiksi,Nonfiksi,Komik,Pelajaran,Lainnya',
            'harga_hidden' => 'nullable|numeric',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // validasi gambar
        ]);

        $validated = $request->all();

        // Format harga dari hidden input
        $validated['harga'] = $request->harga_hidden;

        // Jika ada gambar, simpan ke folder dan masukkan nama file ke database
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $namaFile = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('gambar_buku'), $namaFile);
            $validated['gambar'] = $namaFile;
        }

        ModelBuku::create($validated);

        return redirect('/admin/buku')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        $buku = ModelBuku::findOrFail($id);
        return view('admin.buku.edit', compact('buku'));
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
            'harga_hidden' => 'nullable|numeric',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $validated = $request->all();
        $validated['harga'] = $request->harga_hidden;

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $namaFile = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('gambar_buku'), $namaFile);
            $validated['gambar'] = $namaFile;

            // (Opsional) Hapus gambar lama kalau mau
            if ($buku->gambar && file_exists(public_path('gambar_buku/' . $buku->gambar))) {
                unlink(public_path('gambar_buku/' . $buku->gambar));
            }
        }

        $buku->update($validated);

        return redirect('/admin/buku')->with('success', 'Data berhasil diperbarui');
    }

    public function destroy($id)
    {
        $buku = ModelBuku::findOrFail($id);

        if ($buku->gambar && Storage::disk('public')->exists($buku->gambar)) {
            Storage::disk('public')->delete($buku->gambar);
        }

        $buku->delete();

        return redirect('/admin/buku')->with('success', 'Data berhasil dihapus');
    }
}
