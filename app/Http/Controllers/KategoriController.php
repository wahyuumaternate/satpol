<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class KategoriController extends Controller
{
    /**
     * Menampilkan semua kategori.
     */
    public function index()
    {
        $categories = Kategori::orderBy('created_at', 'desc')->get();
        return view('backend.kategori.index', compact('categories'));
    }

    /**
     * Menampilkan form untuk membuat kategori baru.
     */
    public function create()
    {
        return view('backend.kategori.create');
    }

    /**
     * Menyimpan kategori baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255|unique:kategori,nama',
            'deskripsi' => 'nullable|string',
            'is_active' => 'boolean'
        ], [
            'nama.required' => 'Nama kategori wajib diisi.',
            'nama.unique' => 'Nama kategori sudah ada.',
            'nama.max' => 'Nama kategori maksimal 255 karakter.'
        ]);

        $kategori = new Kategori();
        $kategori->nama = $request->nama;
        $kategori->slug = Str::slug($request->nama);
        $kategori->deskripsi = $request->deskripsi;
        $kategori->is_active = $request->has('is_active') ? true : false;
        $kategori->save();

        return redirect()->route('backend.kategori.index')
            ->with('success', 'Kategori berhasil dibuat.');
    }

    /**
     * Menampilkan kategori berdasarkan ID.
     */
    public function show($id)
    {
        try {
            $kategori = Kategori::findOrFail($id);

            // Debug: Pastikan kategori ditemukan
            if (!$kategori) {
                abort(404, 'Kategori tidak ditemukan');
            }

            return view('backend.kategori.show', compact('kategori'));
        } catch (\Exception $e) {
            return redirect()->route('backend.kategori.index')
                ->with('error', 'Kategori tidak ditemukan.');
        }
    }

    /**
     * Menampilkan form untuk mengedit kategori.
     */
    public function edit($id)
    {
        try {
            $kategori = Kategori::findOrFail($id);

            // Debug: Pastikan kategori ditemukan
            if (!$kategori) {
                abort(404, 'Kategori tidak ditemukan');
            }

            return view('backend.kategori.edit', compact('kategori'));
        } catch (\Exception $e) {
            return redirect()->route('backend.kategori.index')
                ->with('error', 'Kategori tidak ditemukan.');
        }
    }

    /**
     * Memperbarui kategori.
     */
    public function update(Request $request, $id)
    {
        try {
            $kategori = Kategori::findOrFail($id);

            $request->validate([
                'nama' => 'required|string|max:255|unique:kategori,nama,' . $id,
                'deskripsi' => 'nullable|string',
                'is_active' => 'boolean'
            ], [
                'nama.required' => 'Nama kategori wajib diisi.',
                'nama.unique' => 'Nama kategori sudah ada.',
                'nama.max' => 'Nama kategori maksimal 255 karakter.'
            ]);

            $kategori->nama = $request->nama;
            $kategori->slug = Str::slug($request->nama);
            $kategori->deskripsi = $request->deskripsi;
            $kategori->is_active = $request->has('is_active') ? true : false;
            $kategori->save();

            return redirect()->route('backend.kategori.index')
                ->with('success', 'Kategori berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->route('backend.kategori.index')
                ->with('error', 'Gagal memperbarui kategori.');
        }
    }

    /**
     * Menghapus kategori.
     */
    public function destroy($id)
    {
        try {
            $kategori = Kategori::findOrFail($id);
            $nama = $kategori->nama; // Simpan nama sebelum dihapus
            $kategori->delete();

            return redirect()->route('backend.kategori.index')
                ->with('success', "Kategori '{$nama}' berhasil dihapus.");
        } catch (\Exception $e) {
            return redirect()->route('backend.kategori.index')
                ->with('error', 'Gagal menghapus kategori. Mungkin masih digunakan di data lain.');
        }
    }

    /**
     * Toggle status aktif kategori
     */
    public function toggleStatus($id)
    {
        try {
            $kategori = Kategori::findOrFail($id);
            $kategori->is_active = !$kategori->is_active;
            $kategori->save();

            $status = $kategori->is_active ? 'diaktifkan' : 'dinonaktifkan';
            return redirect()->route('backend.kategori.index')
                ->with('success', "Kategori '{$kategori->nama}' berhasil {$status}.");
        } catch (\Exception $e) {
            return redirect()->route('backend.kategori.index')
                ->with('error', 'Gagal mengubah status kategori.');
        }
    }
}
