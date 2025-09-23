<?php

namespace App\Http\Controllers;

use App\Models\OrganizationProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class OrganizationProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $profiles = OrganizationProfile::active()->ordered()->get();

        return view('backend.organization-profile.index', compact('profiles'));
    }

    /**
     * Show the specified resource by slug.
     */
    public function show($slug)
    {
        $profile = OrganizationProfile::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        return view('backend.organization-profile.show', compact('profile'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $profile = OrganizationProfile::findOrFail($id);

        return view('backend.organization-profile.edit', compact('profile'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $profile = OrganizationProfile::findOrFail($id);

        $request->validate([
            // Hapus validasi title karena tidak bisa diubah
            'content' => 'nullable|string',
            'description' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'sort_order' => 'nullable|integer',
            'is_active' => 'boolean'
        ]);

        $data = $request->except(['title', 'slug']); // Exclude title dan slug dari update

        // Handle image upload
        if ($request->hasFile('image')) {
            if ($profile->image && file_exists(storage_path('app/public/' . $profile->image))) {
                unlink(storage_path('app/public/' . $profile->image));
            }

            $imagePath = $request->file('image')->store('organization-profile-images', 'public');
            $data['image'] = $imagePath;
        }

        $profile->update($data);

        return redirect()->route('backend.organization-profile.admin.index')
            ->with('success', 'Profil organisasi berhasil diupdate.');
    }

    /**
     * Admin index page to manage all profiles
     */
    public function adminIndex()
    {
        $profiles = OrganizationProfile::ordered()->get();

        return view('backend.organization-profile.index', compact('profiles'));
    }

    /**
     * Show specific profile pages
     */
    public function tentang()
    {
        $profile = OrganizationProfile::where('slug', 'tentang')
            ->where('is_active', true)
            ->firstOrFail();

        return view('backend.organization-profile.tentang', compact('profile'));
    }

    public function tugasFungsi()
    {
        $profile = OrganizationProfile::where('slug', 'tugas-fungsi')
            ->where('is_active', true)
            ->firstOrFail();

        return view('backend.organization-profile.tugas-fungsi', compact('profile'));
    }

    public function strukturOrganisasi()
    {
        $profile = OrganizationProfile::where('slug', 'struktur-organisasi')
            ->where('is_active', true)
            ->firstOrFail();

        return view('backend.organization-profile.struktur-organisasi', compact('profile'));
    }

    public function profilReformer()
    {
        $profile = OrganizationProfile::where('slug', 'profil-reformer')
            ->where('is_active', true)
            ->firstOrFail();

        return view('backend.organization-profile.profil-reformer', compact('profile'));
    }
}
