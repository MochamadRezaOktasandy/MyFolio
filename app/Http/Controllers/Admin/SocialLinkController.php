<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SocialLink;
use Illuminate\Http\Request;

class SocialLinkController extends Controller
{
    public function index()
    {
        $socialLinks = SocialLink::orderBy('sort_order')->get();
        return view('admin.social-links.index', compact('socialLinks'));
    }

    public function create()
    {
        return view('admin.social-links.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'platform' => 'required|string|max:50',
            'label' => 'required|string|max:100',
            'url' => 'required|url|max:255',
            'sort_order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ], [
            'platform.required' => 'Nama platform (misal: GitHub, LinkedIn) wajib diisi.',
            'label.required' => 'Label tampilan wajib diisi.',
            'url.required' => 'Tautan URL profil wajib diisi.',
            'url.url' => 'Format tautan URL tidak valid (harus diawali https://).',
        ]);

        $validated['is_active'] = $request->has('is_active');
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        SocialLink::create($validated);

        return redirect()->route('admin.social-links.index')->with('success', 'Tautan media sosial berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $socialLink = SocialLink::findOrFail($id);
        return view('admin.social-links.edit', compact('socialLink'));
    }

    public function update(Request $request, $id)
    {
        $socialLink = SocialLink::findOrFail($id);

        $validated = $request->validate([
            'platform' => 'required|string|max:50',
            'label' => 'required|string|max:100',
            'url' => 'required|url|max:255',
            'sort_order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ], [
            'platform.required' => 'Nama platform wajib diisi.',
            'label.required' => 'Label tampilan wajib diisi.',
            'url.required' => 'Tautan URL profil wajib diisi.',
            'url.url' => 'Format tautan URL tidak valid (harus diawali https://).',
        ]);

        $validated['is_active'] = $request->has('is_active');
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        $socialLink->update($validated);

        return redirect()->route('admin.social-links.index')->with('success', 'Tautan media sosial berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $socialLink = SocialLink::findOrFail($id);
        $socialLink->delete();

        return redirect()->route('admin.social-links.index')->with('success', 'Tautan media sosial berhasil dihapus.');
    }
}
