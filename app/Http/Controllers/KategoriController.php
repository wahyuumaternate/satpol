<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
     * Menampilkan semua kategori.
     */
    public function index()
    {
        $kategoris = Kategori::all(); // Mengambil semua kategori
        return view('kategoris.index', compact('kategoris')); // Menampilkan kategori ke view
    }

    /**
     * Menampilkan form untuk membuat kategori baru.
     */
    public function create()
    {
        return view('kategoris.create');
    }

    /**
     * Menyimpan kategori baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255', // Validasi input
        ]);

        Kategori::create($request->all()); // Menyimpan kategori

        return redirect()->route('kategoris.index')->with('success', 'Kategori berhasil dibuat.');
    }

    /**
     * Menampilkan kategori berdasarkan ID.
     */
    public function show($id)
    {
        $kategori = Kategori::findOrFail($id); // Mencari kategori berdasarkan ID
        return view('kategoris.show', compact('kategori'));
    }

    /**
     * Menampilkan form untuk mengedit kategori.
     */
    public function edit($id)
    {
        $kategori = Kategori::findOrFail($id); // Mencari kategori berdasarkan ID
        return view('kategoris.edit', compact('kategori'));
    }

    /**
     * Memperbarui kategori.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255', // Validasi input
        ]);

        $kategori = Kategori::findOrFail($id);
        $kategori->update($request->all()); // Memperbarui kategori

        return redirect()->route('kategoris.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    /**
     * Menghapus kategori.
     */
    public function destroy($id)
    {
        $kategori = Kategori::findOrFail($id);
        $kategori->delete(); // Menghapus kategori

        return redirect()->route('kategoris.index')->with('success', 'Kategori berhasil dihapus.');
    }
}
