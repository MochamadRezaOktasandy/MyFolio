@extends('layouts.admin')

@section('title', 'Edit Keahlian — ' . $skill->name)
@section('page_title', 'Edit Keahlian')

@section('content')
<div class="max-w-2xl">
  <a href="{{ route('admin.skills.index') }}"
    class="inline-flex items-center gap-2 text-xs font-semibold text-brand-500 hover:underline mb-6">
    &larr; Kembali ke Daftar Keahlian
  </a>

  <form action="{{ route('admin.skills.update', $skill->id) }}" method="POST"
    class="p-6 sm:p-8 bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-sm space-y-6">
    @csrf
    @method('PUT')

    <h2 class="text-base font-bold text-slate-900 dark:text-white border-b border-slate-100 dark:border-slate-800 pb-3">
      Perbarui Keahlian
    </h2>

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
      <div>
        <label class="block text-xs font-semibold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">Nama
          Keahlian</label>
        <input type="text" name="name" value="{{ old('name', $skill->name) }}" required
          class="w-full rounded-xl border border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 px-4 py-2.5 text-sm focus:ring-2 focus:ring-brand-500 focus:outline-none dark:text-white">
        @error('name') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
      </div>

      <div>
        <label
          class="block text-xs font-semibold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">Kategori
          Keahlian</label>
        <select name="skill_category_id" required
          class="w-full rounded-xl border border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 px-4 py-2.5 text-sm focus:ring-2 focus:ring-brand-500 focus:outline-none dark:text-white">
          @foreach($categories as $cat)
          <option value="{{ $cat->id }}" {{ old('skill_category_id', $skill->skill_category_id) == $cat->id ? 'selected'
            : '' }}>{{ $cat->name }}</option>
          @endforeach
        </select>
      </div>
    </div>

    <!-- Slider Persentase Interaktif -->
    <div x-data="{ pct: {{ old('percentage', $skill->percentage) }} }">
      <div class="flex justify-between items-center mb-2">
        <label class="text-xs font-semibold uppercase tracking-wider text-slate-700 dark:text-slate-300">Tingkat
          Penguasaan</label>
        <span class="text-sm font-extrabold text-emerald-500" x-text="pct + '%'"></span>
      </div>
      <input type="range" name="percentage" min="10" max="100" step="5" x-model="pct"
        class="w-full accent-emerald-500 cursor-pointer">
      <div class="flex justify-between text-[11px] text-slate-400 mt-1">
        <span>10% (Dasar)</span>
        <span>50% (Menengah)</span>
        <span>100% (Mahir/Expert)</span>
      </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
      <div>
        <label
          class="block text-xs font-semibold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">Level
          Pengalaman</label>
        <select name="experience_level"
          class="w-full rounded-xl border border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 px-4 py-2.5 text-sm focus:ring-2 focus:ring-brand-500 focus:outline-none dark:text-white">
          <option value="Beginner" {{ old('experience_level', $skill->experience_level) == 'Beginner' ? 'selected' : ''
            }}>Beginner</option>
          <option value="Intermediate" {{ old('experience_level', $skill->experience_level) == 'Intermediate' ?
            'selected' : '' }}>Intermediate</option>
          <option value="Advanced" {{ old('experience_level', $skill->experience_level) == 'Advanced' ? 'selected' : ''
            }}>Advanced</option>
          <option value="Expert" {{ old('experience_level', $skill->experience_level) == 'Expert' ? 'selected' : ''
            }}>Expert</option>
        </select>
      </div>

      <div>
        <label
          class="block text-xs font-semibold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">Urutan
          Tampil (Sort Order)</label>
        <input type="number" name="sort_order" value="{{ old('sort_order', $skill->sort_order) }}"
          class="w-full rounded-xl border border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 px-4 py-2.5 text-sm focus:ring-2 focus:ring-brand-500 focus:outline-none dark:text-white">
      </div>
    </div>

    <!-- Toggles -->
    <div class="flex flex-wrap items-center gap-6 pt-4 border-t border-slate-100 dark:border-slate-800">
      <label class="flex items-center gap-2 cursor-pointer text-sm font-semibold text-slate-800 dark:text-slate-200">
        <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $skill->is_featured) ? 'checked' : ''
        }} class="rounded border-slate-300 text-brand-500 focus:ring-brand-500">
        <span>Jadikan Keahlian Utama (Featured)</span>
      </label>

      <label class="flex items-center gap-2 cursor-pointer text-sm font-semibold text-slate-800 dark:text-slate-200">
        <input type="checkbox" name="is_active" value="1" {{ old('is_active', $skill->is_active) ? 'checked' : '' }}
        class="rounded border-slate-300 text-brand-500 focus:ring-brand-500">
        <span>Aktifkan & Tampilkan di Web</span>
      </label>
    </div>

    <button type="submit"
      class="w-full py-3.5 px-6 rounded-xl bg-slate-900 hover:bg-slate-800 dark:bg-brand-600 dark:hover:bg-brand-700 text-white font-semibold text-sm transition shadow-lg">
      Perbarui Keahlian
    </button>
  </form>
</div>
@endsection