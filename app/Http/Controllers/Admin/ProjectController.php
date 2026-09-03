<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectCategory;
use App\Models\Technology;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::with(['category', 'technologies'])
            ->orderBy('sort_order')
            ->latest()
            ->paginate(10);

        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        $categories = ProjectCategory::all();
        $technologies = Technology::all();
        return view('admin.projects.create', compact('categories', 'technologies'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:200',
            'project_category_id' => 'required|exists:project_categories,id',
            'short_description' => 'required|string|max:500',
            'description' => 'required|string',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'client' => 'nullable|string|max:100',
            'role' => 'nullable|string|max:100',
            'status' => 'required|string|max:50',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date', // Validasi Anti-Human Error
            'github_url' => 'nullable|url|max:255',
            'live_url' => 'nullable|url|max:255',
            'is_featured' => 'nullable|boolean',
            'is_published' => 'nullable|boolean',
            'technologies' => 'nullable|array',
            'technologies.*' => 'exists:technologies,id',
        ], [
            'end_date.after_or_equal' => 'Tanggal selesai tidak boleh lebih lampau/awal dari tanggal mulai proyek.',
            'thumbnail.required' => 'Gambar thumbnail proyek wajib diunggah.',
            'project_category_id.required' => 'Kategori proyek wajib dipilih.',
        ]);

        // Generate Slug Unik
        $slug = Str::slug($request->title);
        $originalSlug = $slug;
        $count = 1;
        while (Project::where('slug', $slug)->exists()) {
            $slug = "{$originalSlug}-{$count}";
            $count++;
        }
        $validated['slug'] = $slug;

        // Upload Thumbnail
        if ($request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->store('projects', 'public');
            $validated['thumbnail'] = asset('storage/' . $path);
        }

        $validated['is_featured'] = $request->has('is_featured');
        $validated['is_published'] = $request->has('is_published');

        $project = Project::create($validated);

        if ($request->has('technologies')) {
            $project->technologies()->sync($request->technologies);
        }

        return redirect()->route('admin.projects.index')->with('success', 'Proyek baru berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $project = Project::with('technologies')->findOrFail($id);
        $categories = ProjectCategory::all();
        $technologies = Technology::all();

        return view('admin.projects.edit', compact('project', 'categories', 'technologies'));
    }

    public function update(Request $request, $id)
    {
        $project = Project::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:200',
            'project_category_id' => 'required|exists:project_categories,id',
            'short_description' => 'required|string|max:500',
            'description' => 'required|string',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'client' => 'nullable|string|max:100',
            'role' => 'nullable|string|max:100',
            'status' => 'required|string|max:50',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date', // Validasi Anti-Human Error
            'github_url' => 'nullable|url|max:255',
            'live_url' => 'nullable|url|max:255',
            'is_featured' => 'nullable|boolean',
            'is_published' => 'nullable|boolean',
            'technologies' => 'nullable|array',
            'technologies.*' => 'exists:technologies,id',
        ], [
            'end_date.after_or_equal' => 'Tanggal selesai tidak boleh lebih lampau/awal dari tanggal mulai proyek.',
            'project_category_id.required' => 'Kategori proyek wajib dipilih.',
        ]);

        // Jika judul diubah, sesuaikan slug
        if ($project->title !== $request->title) {
            $slug = Str::slug($request->title);
            $originalSlug = $slug;
            $count = 1;
            while (Project::where('slug', $slug)->where('id', '!=', $project->id)->exists()) {
                $slug = "{$originalSlug}-{$count}";
                $count++;
            }
            $validated['slug'] = $slug;
        }

        // Upload Thumbnail baru jika diganti
        if ($request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->store('projects', 'public');
            $validated['thumbnail'] = asset('storage/' . $path);
        }

        $validated['is_featured'] = $request->has('is_featured');
        $validated['is_published'] = $request->has('is_published');

        $project->update($validated);
        $project->technologies()->sync($request->technologies ?? []);

        return redirect()->route('admin.projects.index')->with('success', 'Proyek berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $project = Project::findOrFail($id);
        $project->technologies()->detach();
        $project->delete();

        return redirect()->route('admin.projects.index')->with('success', 'Proyek berhasil dihapus.');
    }

    // Quick Add Kategori Baru via AJAX
    public function quickStoreCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100|unique:project_categories,name',
        ], [
            'name.required' => 'Nama kategori wajib diisi.',
            'name.unique' => 'Kategori dengan nama ini sudah ada.',
        ]);

        $category = ProjectCategory::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);

        return response()->json([
            'success' => true,
            'category' => $category,
        ]);
    }

    // Quick Add Teknologi Baru via AJAX
    public function quickStoreTechnology(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100|unique:technologies,name',
        ], [
            'name.required' => 'Nama teknologi wajib diisi.',
            'name.unique' => 'Teknologi dengan nama ini sudah ada.',
        ]);

        $technology = Technology::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);

        return response()->json([
            'success' => true,
            'technology' => $technology,
        ]);
    }

    // Hapus Kategori dengan Proteksi Keamanan
    public function destroyCategory($id)
    {
        $category = ProjectCategory::withCount('projects')->findOrFail($id);

        // Cek apakah kategori masih dipakai oleh proyek aktif
        if ($category->projects_count > 0) {
            return response()->json([
                'success' => false,
                'message' => "Kategori '{$category->name}' tidak bisa dihapus karena masih digunakan oleh {$category->projects_count} proyek.",
            ], 422);
        }

        $category->delete();

        return response()->json([
            'success' => true,
            'message' => 'Kategori berhasil dihapus.',
            'id' => $id,
        ]);
    }

    // Hapus Teknologi
    public function destroyTechnology($id)
    {
        $technology = Technology::findOrFail($id);

        // Lepaskan relasi dari semua proyek lalu hapus
        $technology->projects()->detach();
        $technology->delete();

        return response()->json([
            'success' => true,
            'message' => 'Teknologi berhasil dihapus.',
            'id' => $id,
        ]);
    }
}
