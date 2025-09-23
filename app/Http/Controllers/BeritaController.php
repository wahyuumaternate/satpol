<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class BeritaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Berita::with('kategori');

        // Filter berdasarkan status
        if ($request->has('status') && $request->status !== '') {
            $query->where('status', $request->status);
        }

        // Filter berdasarkan kategori
        if ($request->has('kategori_id') && $request->kategori_id !== '') {
            $query->where('kategori_id', $request->kategori_id);
        }

        // Search
        if ($request->has('search') && $request->search !== '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('konten', 'like', "%{$search}%")
                  ->orWhere('penulis', 'like', "%{$search}%");
            });
        }

        $berita = $query->orderBy('created_at', 'desc')->paginate(10);
        $kategoris = Kategori::all();

        return view('admin.berita.index', compact('berita', 'kategoris'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategoris = Kategori::all();
        return view('admin.berita.create', compact('kategoris'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'slug' => 'nullable|string|unique:berita,slug',
            'konten' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'penulis' => 'required|string|max:255',
            'status' => 'required|in:draft,published',
            'tanggal_publish' => 'nullable|date',
            'kategori_id' => 'nullable|exists:kategoris,id',
            'excerpt' => 'nullable|string',
            'tags' => 'nullable|string'
        ]);

        // Handle image upload
        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('berita', 'public');
        }

        // Generate slug if not provided
        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['judul']);
        }

        // Handle tags
        if (!empty($validated['tags'])) {
            $validated['tags'] = array_map('trim', explode(',', $validated['tags']));
        }

        // Set tanggal_publish if status is published
        if ($validated['status'] === 'published' && empty($validated['tanggal_publish'])) {
            $validated['tanggal_publish'] = now();
        }

        Berita::create($validated);

        return redirect()->route('berita.index')
                        ->with('success', 'Berita berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Berita $berita)
    {
        $berita->load('kategori');
        $berita->incrementViews();
        
        return view('admin.berita.show', compact('berita'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Berita $berita)
    {
        $kategoris = Kategori::all();
        return view('admin.berita.edit', compact('berita', 'kategoris'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Berita $berita)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'slug' => ['nullable', 'string', Rule::unique('berita')->ignore($berita->id)],
            'konten' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'penulis' => 'required|string|max:255',
            'status' => 'required|in:draft,published',
            'tanggal_publish' => 'nullable|date',
            'kategori_id' => 'nullable|exists:kategoris,id',
            'excerpt' => 'nullable|string',
            'tags' => 'nullable|string'
        ]);

        // Handle image upload
        if ($request->hasFile('gambar')) {
            // Delete old image
            if ($berita->gambar) {
                Storage::disk('public')->delete($berita->gambar);
            }
            $validated['gambar'] = $request->file('gambar')->store('berita', 'public');
        }

        // Generate slug if not provided
        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['judul']);
        }

        // Handle tags
        if (!empty($validated['tags'])) {
            $validated['tags'] = array_map('trim', explode(',', $validated['tags']));
        } else {
            $validated['tags'] = null;
        }

        // Set tanggal_publish if status changed to published
        if ($validated['status'] === 'published' && $berita->status === 'draft' && empty($validated['tanggal_publish'])) {
            $validated['tanggal_publish'] = now();
        }

        $berita->update($validated);

        return redirect()->route('berita.index')
                        ->with('success', 'Berita berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Berita $berita)
    {
        // Delete image if exists
        if ($berita->gambar) {
            Storage::disk('public')->delete($berita->gambar);
        }

        $berita->delete();

        return redirect()->route('berita.index')
                        ->with('success', 'Berita berhasil dihapus.');
    }

    /**
     * Publish berita
     */
    public function publish(Berita $berita)
    {
        $berita->publish();

        return redirect()->back()
                        ->with('success', 'Berita berhasil dipublikasi.');
    }

    /**
     * Unpublish berita
     */
    public function unpublish(Berita $berita)
    {
        $berita->unpublish();

        return redirect()->back()
                        ->with('success', 'Berita berhasil di-unpublish.');
    }

    /**
     * Show published berita for public
     */
    public function showPublic($slug)
    {
        $berita = Berita::published()
                       ->with('kategori')
                       ->where('slug', $slug)
                       ->firstOrFail();

        $berita->incrementViews();

        $relatedBerita = Berita::published()
                              ->where('id', '!=', $berita->id)
                              ->where('kategori_id', $berita->kategori_id)
                              ->limit(3)
                              ->get();

        return view('public.berita.show', compact('berita', 'relatedBerita'));
    }

    /**
     * List published berita for public
     */
    public function indexPublic(Request $request)
    {
        $query = Berita::published()->with('kategori');

        // Filter by category
        if ($request->has('kategori') && $request->kategori !== '') {
            $query->whereHas('kategori', function($q) use ($request) {
                $q->where('slug', $request->kategori);
            });
        }

        // Search
        if ($request->has('search') && $request->search !== '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('konten', 'like', "%{$search}%");
            });
        }

        $berita = $query->orderBy('tanggal_publish', 'desc')->paginate(12);
        $kategoris = Kategori::all();

        return view('public.berita.index', compact('berita', 'kategoris'));
    }
}