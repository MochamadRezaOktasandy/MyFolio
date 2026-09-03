<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use App\Models\SkillCategory;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    public function index()
    {
        $skills = Skill::with('category')
            ->orderBy('skill_category_id')
            ->orderBy('sort_order')
            ->paginate(15);

        return view('admin.skills.index', compact('skills'));
    }

    public function create()
    {
        $categories = SkillCategory::orderBy('sort_order')->get();
        return view('admin.skills.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'skill_category_id' => 'required|exists:skill_categories,id',
            'percentage' => 'required|integer|min:10|max:100',
            'experience_level' => 'required|string|max:50',
            'description' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer',
            'is_featured' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',
        ], [
            'name.required' => 'Nama skill wajib diisi.',
            'skill_category_id.required' => 'Kategori skill wajib dipilih.',
            'percentage.min' => 'Persentase minimal 10%.',
            'percentage.max' => 'Persentase maksimal 100%.',
        ]);

        $validated['is_featured'] = $request->has('is_featured');
        $validated['is_active'] = $request->has('is_active');
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        Skill::create($validated);

        return redirect()->route('admin.skills.index')->with('success', 'Keahlian baru berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $skill = Skill::findOrFail($id);
        $categories = SkillCategory::orderBy('sort_order')->get();

        return view('admin.skills.edit', compact('skill', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $skill = Skill::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'skill_category_id' => 'required|exists:skill_categories,id',
            'percentage' => 'required|integer|min:10|max:100',
            'experience_level' => 'required|string|max:50',
            'description' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer',
            'is_featured' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['is_featured'] = $request->has('is_featured');
        $validated['is_active'] = $request->has('is_active');
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        $skill->update($validated);

        return redirect()->route('admin.skills.index')->with('success', 'Keahlian berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $skill = Skill::findOrFail($id);
        $skill->delete();

        return redirect()->route('admin.skills.index')->with('success', 'Keahlian berhasil dihapus.');
    }
}
