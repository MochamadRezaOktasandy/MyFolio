<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Experience;
use Illuminate\Http\Request;

class ExperienceController extends Controller
{
    public function index()
    {
        $experiences = Experience::orderBy('sort_order')
            ->orderByDesc('start_date')
            ->paginate(10);

        return view('admin.experiences.index', compact('experiences'));
    }

    public function create()
    {
        return view('admin.experiences.create');
    }

    public function store(Request $request)
    {
        $isCurrent = $request->has('is_current');

        $validated = $request->validate([
            'position' => 'required|string|max:150',
            'company' => 'required|string|max:150',
            'employment_type' => 'required|string|max:50',
            'location' => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => $isCurrent ? 'nullable|date' : 'required|date|after_or_equal:start_date',
            'sort_order' => 'nullable|integer',
        ], [
            'position.required' => 'Posisi / jabatan pekerjaan wajib diisi.',
            'company.required' => 'Nama perusahaan / organisasi wajib diisi.',
            'start_date.required' => 'Tanggal mulai kerja wajib diisi.',
            'end_date.required' => 'Tanggal selesai wajib diisi jika sudah tidak bekerja di sini.',
            'end_date.after_or_equal' => 'Tanggal selesai tidak boleh lebih lampau/awal dari tanggal mulai.',
        ]);

        $validated['is_current'] = $isCurrent;
        if ($isCurrent) {
            $validated['end_date'] = null;
        }
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        Experience::create($validated);

        return redirect()->route('admin.experiences.index')->with('success', 'Riwayat pengalaman kerja berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $experience = Experience::findOrFail($id);
        return view('admin.experiences.edit', compact('experience'));
    }

    public function update(Request $request, $id)
    {
        $experience = Experience::findOrFail($id);
        $isCurrent = $request->has('is_current');

        $validated = $request->validate([
            'position' => 'required|string|max:150',
            'company' => 'required|string|max:150',
            'employment_type' => 'required|string|max:50',
            'location' => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => $isCurrent ? 'nullable|date' : 'required|date|after_or_equal:start_date',
            'sort_order' => 'nullable|integer',
        ], [
            'position.required' => 'Posisi / jabatan pekerjaan wajib diisi.',
            'company.required' => 'Nama perusahaan / organisasi wajib diisi.',
            'start_date.required' => 'Tanggal mulai kerja wajib diisi.',
            'end_date.required' => 'Tanggal selesai wajib diisi jika sudah tidak bekerja di sini.',
            'end_date.after_or_equal' => 'Tanggal selesai tidak boleh lebih lampau/awal dari tanggal mulai.',
        ]);

        $validated['is_current'] = $isCurrent;
        if ($isCurrent) {
            $validated['end_date'] = null;
        }
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        $experience->update($validated);

        return redirect()->route('admin.experiences.index')->with('success', 'Riwayat pengalaman kerja berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $experience = Experience::findOrFail($id);
        $experience->delete();

        return redirect()->route('admin.experiences.index')->with('success', 'Riwayat pengalaman kerja berhasil dihapus.');
    }
}
