<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Education;
use Illuminate\Http\Request;

class EducationController extends Controller
{
    public function index()
    {
        $educations = Education::orderBy('sort_order')
            ->orderByDesc('start_date')
            ->paginate(10);

        return view('admin.educations.index', compact('educations'));
    }

    public function create()
    {
        return view('admin.educations.create');
    }

    public function store(Request $request)
    {
        $isCurrent = $request->has('is_current');

        $validated = $request->validate([
            'institution' => 'required|string|max:150',
            'degree' => 'required|string|max:150',
            'field_of_study' => 'required|string|max:150',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => $isCurrent ? 'nullable|date' : 'required|date|after_or_equal:start_date',
            'sort_order' => 'nullable|integer',
        ], [
            'institution.required' => 'Nama institusi / universitas wajib diisi.',
            'degree.required' => 'Jenjang gelar (Degree) wajib diisi.',
            'field_of_study.required' => 'Jurusan / bidang studi wajib diisi.',
            'start_date.required' => 'Tahun / tanggal mulai wajib diisi.',
            'end_date.required' => 'Tanggal kelulusan wajib diisi jika sudah lulus.',
            'end_date.after_or_equal' => 'Tanggal kelulusan tidak boleh sebelum tanggal mulai studi.',
        ]);

        $validated['is_current'] = $isCurrent;
        if ($isCurrent) {
            $validated['end_date'] = null;
        }
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        Education::create($validated);

        return redirect()->route('admin.educations.index')->with('success', 'Riwayat pendidikan berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $education = Education::findOrFail($id);
        return view('admin.educations.edit', compact('education'));
    }

    public function update(Request $request, $id)
    {
        $education = Education::findOrFail($id);
        $isCurrent = $request->has('is_current');

        $validated = $request->validate([
            'institution' => 'required|string|max:150',
            'degree' => 'required|string|max:150',
            'field_of_study' => 'required|string|max:150',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => $isCurrent ? 'nullable|date' : 'required|date|after_or_equal:start_date',
            'sort_order' => 'nullable|integer',
        ], [
            'institution.required' => 'Nama institusi / universitas wajib diisi.',
            'degree.required' => 'Jenjang gelar (Degree) wajib diisi.',
            'field_of_study.required' => 'Jurusan / bidang studi wajib diisi.',
            'start_date.required' => 'Tahun / tanggal mulai wajib diisi.',
            'end_date.required' => 'Tanggal kelulusan wajib diisi jika sudah lulus.',
            'end_date.after_or_equal' => 'Tanggal kelulusan tidak boleh sebelum tanggal mulai studi.',
        ]);

        $validated['is_current'] = $isCurrent;
        if ($isCurrent) {
            $validated['end_date'] = null;
        }
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        $education->update($validated);

        return redirect()->route('admin.educations.index')->with('success', 'Riwayat pendidikan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $education = Education::findOrFail($id);
        $education->delete();

        return redirect()->route('admin.educations.index')->with('success', 'Riwayat pendidikan berhasil dihapus.');
    }
}
