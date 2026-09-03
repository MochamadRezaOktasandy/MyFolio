<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CertificateController extends Controller
{
    public function index()
    {
        $certificates = Certificate::orderBy('sort_order')
            ->orderByDesc('issue_date')
            ->paginate(10);

        return view('admin.certificates.index', compact('certificates'));
    }

    public function create()
    {
        return view('admin.certificates.create');
    }

    public function store(Request $request)
    {
        $hasExpiration = $request->has('has_expiration');

        $validated = $request->validate([
            'title' => 'required|string|max:200',
            'issuer' => 'required|string|max:150',
            'credential_id' => 'nullable|string|max:150',
            'credential_url' => 'nullable|url|max:255',
            'issue_date' => 'required|date',
            'expiration_date' => $hasExpiration ? 'required|date|after_or_equal:issue_date' : 'nullable|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3072',
            'description' => 'nullable|string',
            'sort_order' => 'nullable|integer',
            'is_featured' => 'nullable|boolean',
        ], [
            'title.required' => 'Nama sertifikat / lisensi wajib diisi.',
            'issuer.required' => 'Nama organisasi / instansi penerbit wajib diisi.',
            'issue_date.required' => 'Tanggal penerbitan wajib diisi.',
            'expiration_date.required' => 'Tanggal kedaluwarsa wajib diisi jika dicentang.',
            'expiration_date.after_or_equal' => 'Tanggal kedaluwarsa tidak boleh sebelum tanggal penerbitan.',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('certificates', 'public');
            $validated['image'] = $path;
        }

        if (!$hasExpiration) {
            $validated['expiration_date'] = null;
        }

        $validated['is_featured'] = $request->has('is_featured');
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        Certificate::create($validated);

        return redirect()->route('admin.certificates.index')->with('success', 'Sertifikat baru berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $certificate = Certificate::findOrFail($id);
        return view('admin.certificates.edit', compact('certificate'));
    }

    public function update(Request $request, $id)
    {
        $certificate = Certificate::findOrFail($id);
        $hasExpiration = $request->has('has_expiration');

        $validated = $request->validate([
            'title' => 'required|string|max:200',
            'issuer' => 'required|string|max:150',
            'credential_id' => 'nullable|string|max:150',
            'credential_url' => 'nullable|url|max:255',
            'issue_date' => 'required|date',
            'expiration_date' => $hasExpiration ? 'required|date|after_or_equal:issue_date' : 'nullable|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3072',
            'description' => 'nullable|string',
            'sort_order' => 'nullable|integer',
            'is_featured' => 'nullable|boolean',
        ], [
            'title.required' => 'Nama sertifikat / lisensi wajib diisi.',
            'issuer.required' => 'Nama organisasi / instansi penerbit wajib diisi.',
            'issue_date.required' => 'Tanggal penerbitan wajib diisi.',
            'expiration_date.required' => 'Tanggal kedaluwarsa wajib diisi jika dicentang.',
            'expiration_date.after_or_equal' => 'Tanggal kedaluwarsa tidak boleh sebelum tanggal penerbitan.',
        ]);

        if ($request->hasFile('image')) {
            if ($certificate->image && Storage::disk('public')->exists($certificate->image)) {
                Storage::disk('public')->delete($certificate->image);
            }
            $path = $request->file('image')->store('certificates', 'public');
            $validated['image'] = $path;
        }

        if (!$hasExpiration) {
            $validated['expiration_date'] = null;
        }

        $validated['is_featured'] = $request->has('is_featured');
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        $certificate->update($validated);

        return redirect()->route('admin.certificates.index')->with('success', 'Sertifikat berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $certificate = Certificate::findOrFail($id);

        if ($certificate->image && Storage::disk('public')->exists($certificate->image)) {
            Storage::disk('public')->delete($certificate->image);
        }

        $certificate->delete();

        return redirect()->route('admin.certificates.index')->with('success', 'Sertifikat berhasil dihapus.');
    }
}
