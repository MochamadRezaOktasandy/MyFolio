@extends('layouts.admin')

@section('title', 'Edit Pengalaman — ' . $experience->position)
@section('page_title', 'Edit Pengalaman Kerja')

@section('content')
<div class="max-w-3xl">
  <a href="{{ route('admin.experiences.index') }}"
    class="inline-flex items-center gap-2 text-xs font-semibold text-brand-500 hover:underline mb-6">
    &larr; Kembali ke Daftar Pengalaman
  </a>

  <!-- Alert Validasi -->
  @if ($errors->any())
  <div
    class="mb-6 p-4 rounded-xl bg-rose-50 border border-rose-300 text-rose-800 dark:bg-rose-950/60 dark:border-rose-700 dark:text-rose-300 text-xs">
    <p class="font-bold mb-1">Mohon periksa data berikut:</p>
    <ul class="list-disc list-inside space-y-0.5">
      @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
  @endif

  <form action="{{ route('admin.experiences.update', $experience->id) }}" method="POST"
    x-data="{ isCurrent: {{ old('is_current', $experience->is_current) ? 'true' : 'false' }} }"
    class="p-6 sm:p-8 bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-sm space-y-6">
    @csrf
    @method('PUT')

    <h2 class="text-base font-bold text-slate-900 dark:text-white border-b border-slate-100 dark:border-slate-800 pb-3">
      Perbarui Pengalaman Kerja
    </h2>

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
      <div>
        <label
          class="block text-xs font-semibold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">Posisi /
          Jabatan</label>
        <input type="text" name="position" value="{{ old('position', $experience->position) }}" required
          class="w-full rounded-xl border border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 px-4 py-2.5 text-sm focus:ring-2 focus:ring-brand-500 focus:outline-none dark:text-white">
        @error('position') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
      </div>

      <div>
        <label class="block text-xs font-semibold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">Nama
          Perusahaan / Instansi</label>
        <input type="text" name="company" value="{{ old('company', $experience->company) }}" required
          class="w-full rounded-xl border border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 px-4 py-2.5 text-sm focus:ring-2 focus:ring-brand-500 focus:outline-none dark:text-white">
        @error('company') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
      </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
      <div>
        <label
          class="block text-xs font-semibold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">Jenis
          Pekerjaan</label>
        <select name="employment_type"
          class="w-full rounded-xl border border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 px-4 py-2.5 text-sm focus:ring-2 focus:ring-brand-500 focus:outline-none dark:text-white">
          <option value="Full-time" {{ old('employment_type', $experience->employment_type) == 'Full-time' ? 'selected'
            : '' }}>Full-time (Purna Waktu)</option>
          <option value="Part-time" {{ old('employment_type', $experience->employment_type) == 'Part-time' ? 'selected'
            : '' }}>Part-time (Paruh Waktu)</option>
          <option value="Contract" {{ old('employment_type', $experience->employment_type) == 'Contract' ? 'selected' :
            '' }}>Contract (Kontrak)</option>
          <option value="Freelance" {{ old('employment_type', $experience->employment_type) == 'Freelance' ? 'selected'
            : '' }}>Freelance (Lepas)</option>
          <option value="Internship" {{ old('employment_type', $experience->employment_type) == 'Internship' ?
            'selected' : '' }}>Internship (Magang)</option>
        </select>
      </div>

      <div>
        <label
          class="block text-xs font-semibold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">Lokasi
          Kerja</label>
        <input type="text" name="location" value="{{ old('location', $experience->location) }}"
          class="w-full rounded-xl border border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 px-4 py-2.5 text-sm focus:ring-2 focus:ring-brand-500 focus:outline-none dark:text-white">
      </div>
    </div>

    <!-- Periode Kerja dengan Alpine Toggle -->
    <div class="pt-4 border-t border-slate-100 dark:border-slate-800 space-y-4">
      <label class="flex items-center gap-2 cursor-pointer text-sm font-semibold text-slate-800 dark:text-slate-200">
        <input type="checkbox" name="is_current" value="1" x-model="isCurrent"
          class="rounded border-slate-300 text-brand-500 focus:ring-brand-500">
        <span>Saat ini saya masih bekerja di posisi ini (Present)</span>
      </label>

      <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
        <div>
          <label
            class="block text-xs font-semibold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">Tanggal
            Mulai Bekerja</label>
          <input type="date" name="start_date"
            value="{{ old('start_date', $experience->start_date ? \Carbon\Carbon::parse($experience->start_date)->format('Y-m-d') : '') }}"
            required
            class="w-full rounded-xl border border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 px-4 py-2.5 text-sm focus:ring-2 focus:ring-brand-500 focus:outline-none dark:text-white">
          @error('start_date') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
        </div>

        <div :class="isCurrent ? 'opacity-40 cursor-not-allowed' : ''">
          <label class="block text-xs font-semibold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">
            Tanggal Selesai Bekerja
            <span x-show="isCurrent" class="text-emerald-500 font-bold lowercase">(sekarang)</span>
          </label>
          <input type="date" name="end_date"
            value="{{ old('end_date', $experience->end_date ? \Carbon\Carbon::parse($experience->end_date)->format('Y-m-d') : '') }}"
            :disabled="isCurrent"
            class="w-full rounded-xl border border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 px-4 py-2.5 text-sm focus:ring-2 focus:ring-brand-500 focus:outline-none dark:text-white disabled:cursor-not-allowed">
          @error('end_date') <span class="text-red-500 text-xs mt-1 block font-semibold">{{ $message }}</span> @enderror
        </div>
      </div>
    </div>

    <div>
      <label
        class="block text-xs font-semibold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">Deskripsi
        Tanggung Jawab & Capaian</label>
      <textarea name="description" rows="4"
        class="w-full rounded-xl border border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 px-4 py-2.5 text-sm focus:ring-2 focus:ring-brand-500 focus:outline-none dark:text-white">{{ old('description', $experience->description) }}</textarea>
    </div>

    <div>
      <label class="block text-xs font-semibold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">Urutan
        Tampil (Sort Order)</label>
      <input type="number" name="sort_order" value="{{ old('sort_order', $experience->sort_order) }}"
        class="w-full sm:w-1/3 rounded-xl border border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 px-4 py-2.5 text-sm focus:ring-2 focus:ring-brand-500 focus:outline-none dark:text-white">
    </div>

    <button type="submit"
      class="w-full py-3.5 px-6 rounded-xl bg-slate-900 hover:bg-slate-800 dark:bg-brand-600 dark:hover:bg-brand-700 text-white font-semibold text-sm transition shadow-lg">
      Perbarui Pengalaman Kerja
    </button>
  </form>
</div>
@endsection