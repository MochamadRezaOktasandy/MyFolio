@extends('layouts.admin')

@section('title', 'Tambah Proyek Baru')
@section('page_title', 'Tambah Proyek')

@section('content')
<div class="max-w-4xl" x-data="projectFormManager()">
  <a href="{{ route('admin.projects.index') }}"
    class="inline-flex items-center gap-2 text-xs font-semibold text-brand-500 hover:underline mb-6">
    &larr; Kembali ke Daftar Proyek
  </a>

  <!-- Alert Validasi Error -->
  @if ($errors->any())
  <div
    class="mb-6 p-4 rounded-xl bg-rose-50 border border-rose-300 text-rose-800 dark:bg-rose-950/60 dark:border-rose-700 dark:text-rose-300 text-xs">
    <p class="font-bold mb-1">Mohon perbaiki data berikut:</p>
    <ul class="list-disc list-inside space-y-0.5">
      @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
  @endif

  <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
    @csrf

    <!-- Informasi Utama -->
    <div
      class="p-6 sm:p-8 bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-sm space-y-6">
      <h2
        class="text-base font-bold text-slate-900 dark:text-white border-b border-slate-100 dark:border-slate-800 pb-3">
        Informasi Utama Proyek
      </h2>

      <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
        <div>
          <label
            class="block text-xs font-semibold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">Judul
            Proyek</label>
          <input type="text" name="title" value="{{ old('title') }}" required placeholder="cth: SIGMA 2.0 Web System"
            class="w-full rounded-xl border border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 px-4 py-2.5 text-sm focus:ring-2 focus:ring-brand-500 focus:outline-none dark:text-white">
          @error('title') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
        </div>

        <!-- Bagian Dropdown Kategori + Tombol Kelola -->
        <div>
          <div class="flex items-center justify-between mb-2">
            <label
              class="block text-xs font-semibold uppercase tracking-wider text-slate-700 dark:text-slate-300">Kategori
              Proyek</label>
            <button type="button" @click="modalCategory = true"
              class="text-xs font-semibold text-emerald-500 hover:text-emerald-600 transition flex items-center gap-1">
              ⚙️ Kelola / Tambah Kategori
            </button>
          </div>
          <select name="project_category_id" x-ref="categorySelect" required
            class="w-full rounded-xl border border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 px-4 py-2.5 text-sm focus:ring-2 focus:ring-brand-500 focus:outline-none dark:text-white">
            <option value="">-- Pilih Kategori --</option>
            <template x-for="cat in categories" :key="cat.id">
              <option :value="cat.id" x-text="cat.name"></option>
            </template>
          </select>
          @error('project_category_id') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
        </div>
      </div>

      <div>
        <label
          class="block text-xs font-semibold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">Deskripsi
          Singkat (Muncul di Kartu Portofolio)</label>
        <textarea name="short_description" rows="2" required placeholder="Ringkasan 1-2 kalimat tentang proyek ini..."
          class="w-full rounded-xl border border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 px-4 py-2.5 text-sm focus:ring-2 focus:ring-brand-500 focus:outline-none dark:text-white">{{ old('short_description') }}</textarea>
        @error('short_description') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
      </div>

      <div>
        <label
          class="block text-xs font-semibold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">Studi
          Kasus Lengkap & Deskripsi Mendalam</label>
        <textarea name="description" rows="6" required
          placeholder="Jelaskan latar belakang masalah, solusi teknis yang Anda buat, serta arsitekturnya..."
          class="w-full rounded-xl border border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 px-4 py-2.5 text-sm focus:ring-2 focus:ring-brand-500 focus:outline-none dark:text-white">{{ old('description') }}</textarea>
        @error('description') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
      </div>

      <div>
        <label
          class="block text-xs font-semibold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">Gambar
          Thumbnail (JPG/PNG/WEBP, Max 2MB)</label>
        <input type="file" name="thumbnail" accept="image/*" required
          class="w-full text-xs text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-slate-100 dark:file:bg-slate-800 file:text-slate-700 dark:file:text-slate-300 hover:file:bg-slate-200 cursor-pointer">
        @error('thumbnail') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
      </div>
    </div>

    <!-- Tech Stack & Metadata -->
    <div
      class="p-6 sm:p-8 bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-sm space-y-6">
      <h2
        class="text-base font-bold text-slate-900 dark:text-white border-b border-slate-100 dark:border-slate-800 pb-3">
        Teknologi & Tautan Proyek
      </h2>

      <!-- Checklist Teknologi + Tombol Kelola -->
      <div>
        <div class="flex items-center justify-between mb-3">
          <label
            class="block text-xs font-semibold uppercase tracking-wider text-slate-700 dark:text-slate-300">Teknologi
            yang Digunakan</label>
          <button type="button" @click="modalTech = true"
            class="text-xs font-semibold text-emerald-500 hover:text-emerald-600 transition flex items-center gap-1">
            ⚙️ Kelola / Tambah Teknologi
          </button>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
          <template x-for="tech in technologies" :key="tech.id">
            <label
              class="flex items-center gap-2 p-3 rounded-xl border border-slate-200 dark:border-slate-800 hover:bg-slate-50 dark:hover:bg-slate-800/50 cursor-pointer text-xs font-medium text-slate-700 dark:text-slate-300">
              <input type="checkbox" name="technologies[]" :value="tech.id"
                class="rounded border-slate-300 text-brand-500 focus:ring-brand-500">
              <span x-text="tech.name"></span>
            </label>
          </template>
        </div>
      </div>

      <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 pt-4 border-t border-slate-100 dark:border-slate-800">
        <div>
          <label
            class="block text-xs font-semibold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">Peran
            Anda (Role)</label>
          <input type="text" name="role" value="{{ old('role', 'Lead Developer') }}"
            class="w-full rounded-xl border border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 px-4 py-2.5 text-sm focus:ring-2 focus:ring-brand-500 focus:outline-none dark:text-white">
        </div>
        <div>
          <label
            class="block text-xs font-semibold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">Klien /
            Institusi</label>
          <input type="text" name="client" value="{{ old('client') }}" placeholder="cth: Universitas / Klien Pribadi"
            class="w-full rounded-xl border border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 px-4 py-2.5 text-sm focus:ring-2 focus:ring-brand-500 focus:outline-none dark:text-white">
        </div>
      </div>

      <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
        <div>
          <label
            class="block text-xs font-semibold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">GitHub
            Repository URL</label>
          <input type="url" name="github_url" value="{{ old('github_url') }}" placeholder="https://github.com/..."
            class="w-full rounded-xl border border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 px-4 py-2.5 text-sm focus:ring-2 focus:ring-brand-500 focus:outline-none dark:text-white">
        </div>
        <div>
          <label
            class="block text-xs font-semibold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">Live
            Demo URL</label>
          <input type="url" name="live_url" value="{{ old('live_url') }}" placeholder="https://demo.example.com"
            class="w-full rounded-xl border border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 px-4 py-2.5 text-sm focus:ring-2 focus:ring-brand-500 focus:outline-none dark:text-white">
        </div>
      </div>

      <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 pt-4 border-t border-slate-100 dark:border-slate-800">
        <div>
          <label
            class="block text-xs font-semibold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">Status
            Proyek</label>
          <select name="status"
            class="w-full rounded-xl border border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 px-4 py-2.5 text-sm focus:ring-2 focus:ring-brand-500 focus:outline-none dark:text-white">
            <option value="Completed" selected>Completed</option>
            <option value="In Progress">In Progress</option>
            <option value="Maintenance">Maintenance</option>
          </select>
        </div>
        <div>
          <label
            class="block text-xs font-semibold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">Tanggal
            Mulai</label>
          <input type="date" name="start_date" value="{{ old('start_date') }}"
            class="w-full rounded-xl border border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 px-4 py-2.5 text-sm focus:ring-2 focus:ring-brand-500 focus:outline-none dark:text-white">
        </div>
        <div>
          <label
            class="block text-xs font-semibold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">Tanggal
            Selesai</label>
          <input type="date" name="end_date" value="{{ old('end_date') }}"
            class="w-full rounded-xl border border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 px-4 py-2.5 text-sm focus:ring-2 focus:ring-brand-500 focus:outline-none dark:text-white">
          @error('end_date') <span class="text-red-500 text-xs mt-1 block font-semibold">{{ $message }}</span> @enderror
        </div>
      </div>

      <!-- Toggles -->
      <div class="flex flex-wrap items-center gap-8 pt-4 border-t border-slate-100 dark:border-slate-800">
        <label class="flex items-center gap-2 cursor-pointer text-sm font-semibold text-slate-800 dark:text-slate-200">
          <input type="checkbox" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}
            class="rounded border-slate-300 text-brand-500 focus:ring-brand-500">
          <span>Jadikan Proyek Unggulan (Featured)</span>
        </label>

        <label class="flex items-center gap-2 cursor-pointer text-sm font-semibold text-slate-800 dark:text-slate-200">
          <input type="checkbox" name="is_published" value="1" checked
            class="rounded border-slate-300 text-brand-500 focus:ring-brand-500">
          <span>Publikasikan Sekarang</span>
        </label>
      </div>
    </div>

    <button type="submit"
      class="px-6 py-3.5 rounded-xl bg-slate-900 hover:bg-slate-800 dark:bg-brand-600 dark:hover:bg-brand-700 text-white font-semibold text-sm transition shadow-lg">
      Simpan & Terbitkan Proyek
    </button>
  </form>

  <!-- MODAL POPUP: KELOLA & HAPUS KATEGORI -->
  <div x-show="modalCategory"
    class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm"
    style="display: none;" x-transition>
    <div @click.away="modalCategory = false"
      class="bg-white dark:bg-slate-900 rounded-2xl max-w-md w-full p-6 border border-slate-200 dark:border-slate-800 shadow-2xl space-y-5">
      <div class="flex items-center justify-between border-b border-slate-100 dark:border-slate-800 pb-3">
        <h3 class="font-bold text-base text-slate-900 dark:text-white">Kelola Kategori Proyek</h3>
        <button type="button" @click="modalCategory = false"
          class="text-slate-400 hover:text-slate-600 font-bold text-sm">✕</button>
      </div>

      <!-- Form Tambah Baru -->
      <div>
        <label
          class="block text-xs font-semibold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-1.5">Tambah
          Kategori Baru</label>
        <div class="flex gap-2">
          <input type="text" x-model="newCategoryName" placeholder="cth: Mobile App"
            class="w-full rounded-xl border border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 px-3 py-2 text-xs focus:ring-2 focus:ring-emerald-500 dark:text-white">
          <button type="button" @click="saveCategory()" :disabled="loadingCategory"
            class="px-4 py-2 text-xs font-bold bg-emerald-500 hover:bg-emerald-600 text-slate-950 rounded-xl transition shadow flex-shrink-0">
            Tambah
          </button>
        </div>
        <span x-show="categoryError" x-text="categoryError" class="text-rose-500 text-xs mt-1 block"></span>
      </div>

      <!-- Daftar Kategori dengan Tombol Hapus -->
      <div class="pt-3 border-t border-slate-100 dark:border-slate-800">
        <h4 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Daftar Kategori Saat Ini</h4>
        <div class="max-h-48 overflow-y-auto space-y-1.5 pr-1">
          <template x-for="cat in categories" :key="cat.id">
            <div
              class="flex items-center justify-between p-2 rounded-xl bg-slate-50 dark:bg-slate-800/70 border border-slate-100 dark:border-slate-700/50 text-xs">
              <span class="font-medium text-slate-800 dark:text-slate-200" x-text="cat.name"></span>
              <button type="button" @click="deleteCategory(cat.id, cat.name)"
                class="p-1 text-slate-400 hover:text-rose-500 rounded transition" title="Hapus Kategori">
                🗑️
              </button>
            </div>
          </template>
        </div>
      </div>
    </div>
  </div>

  <!-- MODAL POPUP: KELOLA & HAPUS TEKNOLOGI -->
  <div x-show="modalTech"
    class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm"
    style="display: none;" x-transition>
    <div @click.away="modalTech = false"
      class="bg-white dark:bg-slate-900 rounded-2xl max-w-md w-full p-6 border border-slate-200 dark:border-slate-800 shadow-2xl space-y-5">
      <div class="flex items-center justify-between border-b border-slate-100 dark:border-slate-800 pb-3">
        <h3 class="font-bold text-base text-slate-900 dark:text-white">Kelola Teknologi / Tools</h3>
        <button type="button" @click="modalTech = false"
          class="text-slate-400 hover:text-slate-600 font-bold text-sm">✕</button>
      </div>

      <!-- Form Tambah Baru -->
      <div>
        <label
          class="block text-xs font-semibold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-1.5">Tambah
          Teknologi Baru</label>
        <div class="flex gap-2">
          <input type="text" x-model="newTechName" placeholder="cth: React, Flutter, Python"
            class="w-full rounded-xl border border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 px-3 py-2 text-xs focus:ring-2 focus:ring-emerald-500 dark:text-white">
          <button type="button" @click="saveTech()" :disabled="loadingTech"
            class="px-4 py-2 text-xs font-bold bg-emerald-500 hover:bg-emerald-600 text-slate-950 rounded-xl transition shadow flex-shrink-0">
            Tambah
          </button>
        </div>
        <span x-show="techError" x-text="techError" class="text-rose-500 text-xs mt-1 block"></span>
      </div>

      <!-- Daftar Teknologi dengan Tombol Hapus -->
      <div class="pt-3 border-t border-slate-100 dark:border-slate-800">
        <h4 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Daftar Teknologi Saat Ini</h4>
        <div class="max-h-48 overflow-y-auto space-y-1.5 pr-1">
          <template x-for="tech in technologies" :key="tech.id">
            <div
              class="flex items-center justify-between p-2 rounded-xl bg-slate-50 dark:bg-slate-800/70 border border-slate-100 dark:border-slate-700/50 text-xs">
              <span class="font-medium text-slate-800 dark:text-slate-200" x-text="tech.name"></span>
              <button type="button" @click="deleteTechnology(tech.id, tech.name)"
                class="p-1 text-slate-400 hover:text-rose-500 rounded transition" title="Hapus Teknologi">
                🗑️
              </button>
            </div>
          </template>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Script Alpine.js Handler -->
<script>
  function projectFormManager() {
    return {
        categories: @json($categories),
        technologies: @json($technologies),

        modalCategory: false,
        newCategoryName: '',
        loadingCategory: false,
        categoryError: '',

        modalTech: false,
        newTechName: '',
        loadingTech: false,
        techError: '',

        async saveCategory() {
            if (!this.newCategoryName.trim()) {
                this.categoryError = 'Nama kategori tidak boleh kosong.';
                return;
            }
            this.loadingCategory = true;
            this.categoryError = '';

            try {
                const res = await fetch("{{ route('admin.project-categories.quick') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "Accept": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({ name: this.newCategoryName })
                });
                const data = await res.json();
                if (!res.ok) {
                    this.categoryError = data.message || 'Gagal menyimpan kategori.';
                } else {
                    this.categories.push(data.category);
                    this.newCategoryName = '';
                    this.$nextTick(() => {
                        this.$refs.categorySelect.value = data.category.id;
                    });
                }
            } catch (e) {
                this.categoryError = 'Terjadi kesalahan koneksi.';
            } finally {
                this.loadingCategory = false;
            }
        },

        async deleteCategory(id, name) {
            if (!confirm(`Hapus kategori '${name}'?`)) return;

            this.categoryError = '';
            try {
                const res = await fetch(`/admin/project-categories/${id}`, {
                    method: "DELETE",
                    headers: {
                        "Accept": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    }
                });
                const data = await res.json();
                if (!res.ok) {
                    alert(data.message || 'Gagal menghapus kategori.');
                } else {
                    this.categories = this.categories.filter(c => c.id !== id);
                }
            } catch (e) {
                alert('Terjadi kesalahan koneksi saat menghapus kategori.');
            }
        },

        async saveTech() {
            if (!this.newTechName.trim()) {
                this.techError = 'Nama teknologi tidak boleh kosong.';
                return;
            }
            this.loadingTech = true;
            this.techError = '';

            try {
                const res = await fetch("{{ route('admin.technologies.quick') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "Accept": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({ name: this.newTechName })
                });
                const data = await res.json();
                if (!res.ok) {
                    this.techError = data.message || 'Gagal menyimpan teknologi.';
                } else {
                    this.technologies.push(data.technology);
                    this.newTechName = '';
                }
            } catch (e) {
                this.techError = 'Terjadi kesalahan koneksi.';
            } finally {
                this.loadingTech = false;
            }
        },

        async deleteTechnology(id, name) {
            if (!confirm(`Hapus teknologi '${name}'?`)) return;

            this.techError = '';
            try {
                const res = await fetch(`/admin/technologies/${id}`, {
                    method: "DELETE",
                    headers: {
                        "Accept": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    }
                });
                const data = await res.json();
                if (!res.ok) {
                    alert(data.message || 'Gagal menghapus teknologi.');
                } else {
                    this.technologies = this.technologies.filter(t => t.id !== id);
                }
            } catch (e) {
                alert('Terjadi kesalahan koneksi saat menghapus teknologi.');
            }
        }
    }
}
</script>
@endsection