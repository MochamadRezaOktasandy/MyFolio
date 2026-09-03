@extends('layouts.admin')

@section('title', 'Edit Pendidikan — ' . $education->institution)
@section('page_title', 'Edit Pendidikan')

@section('content')
<div class="max-w-3xl">
  <a href="{{ route('admin.educations.index') }}"
    class="inline-flex items-center gap-2 text-xs font-semibold text-brand-500 hover:underline mb-6">
    &larr; Kembali ke Daftar Pendidikan
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

  <form action="{{ route('admin.educations.update', $education->id) }}" method="POST"
    x-data="{ isCurrent: {{ old('is_current', $education->is_current) ? 'true' : 'false' }} }"
    class="p-6 sm:p-8 bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-sm space-y-6">
    @csrf
    @method('PUT')

    <h2 class="text-base font-bold text-slate-900 dark:text-white border-b border-slate-100 dark:border-slate-800 pb-3">
      Perbarui Riwayat Pendidikan
    </h2>

    <div>
      <label class="block text-xs font-semibold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">Nama
        Universitas / Institusi Pendidikan</label>
      <input type="text" name="institution" value="{{ old('institution', $education->institution) }}" required
        class="w-full rounded-xl border border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 px-4 py-2.5 text-sm focus:ring-2 focus:ring-brand-500 focus:outline-none dark:text-white">
      @error('institution') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
      <div>
        <label
          class="block text-xs font-semibold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">Jenjang
          Pendidikan (Degree)</label>
        <input type="text" name="degree" value="{{ old('degree', $education->degree) }}" required
          class="w-full rounded-xl border border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 px-4 py-2.5 text-sm focus:ring-2 focus:ring-brand-500 focus:outline-none dark:text-white">
        @error('degree') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
      </div>

      <div>
        <label
          class="block text-xs font-semibold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">Jurusan /
          Bidang Studi</label>
        <input type="text" name="field_of_study" value="{{ old('field_of_study', $education->field_of_study) }}"
          required
          class="w-full rounded-xl border border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 px-4 py-2.5 text-sm focus:ring-2 focus:ring-brand-500 focus:outline-none dark:text-white">
        @error('field_of_study') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
      </div>
    </div>

    <!-- Periode Studi dengan Alpine Toggle -->
    <div class="pt-4 border-t border-slate-100 dark:border-slate-800 space-y-4">
      <label class="flex items-center gap-2 cursor-pointer text-sm font-semibold text-slate-800 dark:text-slate-200">
        <input type="checkbox" name="is_current" value="1" x-model="isCurrent"
          class="rounded border-slate-300 text-brand-500 focus:ring-brand-500">
        <span>Saat ini saya masih menempuh studi di sini (Aktif)</span>
      </label>

      <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
        <div>
          <label
            class="block text-xs font-semibold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">Tanggal
            / Tahun Mulai</label>
          <input type="date" name="start_date"
            value="{{ old('start_date', $education->start_date ? \Carbon\Carbon::parse($education->start_date)->format('Y-m-d') : '') }}"
            required
            class="w-full rounded-xl border border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 px-4 py-2.5 text-sm focus:ring-2 focus:ring-brand-500 focus:outline-none dark:text-white">
          @error('start_date') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
        </div>

        <div :class="isCurrent ? 'opacity-40 cursor-not-allowed' : ''">
          <label class="block text-xs font-semibold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">
            Tanggal / Tahun Kelulusan
            <span x-show="isCurrent" class="text-teal-500 font-bold lowercase">(sekarang)</span>
          </label>
          <input type="date" name="end_date"
            value="{{ old('end_date', $education->end_date ? \Carbon\Carbon::parse($education->end_date)->format('Y-m-d') : '') }}"
            :disabled="isCurrent"
            class="w-full rounded-xl border border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 px-4 py-2.5 text-sm focus:ring-2 focus:ring-brand-500 focus:outline-none dark:text-white disabled:cursor-not-allowed">
          @error('end_date') <span class="text-red-500 text-xs mt-1 block font-semibold">{{ $message }}</span> @enderror
        </div>
      </div>
    </div>

    <div>
      <label
        class="block text-xs font-semibold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">Deskripsi /
        Capaian Akademis (Opsional)</label>
      <textarea name="description" rows="4"
        class="w-full rounded-xl border border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 px-4 py-2.5 text-sm focus:ring-2 focus:ring-brand-500 focus:outline-none dark:text-white">{{ old('description', $education->description) }}</textarea>
    </div>

    <div>
      <label class="block text-xs font-semibold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">Urutan
        Tampil (Sort Order)</label>
      <input type="number" name="sort_order" value="{{ old('sort_order', $education->sort_order) }}"
        class="w-full sm:w-1/3 rounded-xl border border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 px-4 py-2.5 text-sm focus:ring-2 focus:ring-brand-500 focus:outline-none dark:text-white">
    </div>

    <button type="submit"
      class="w-full py-3.5 px-6 rounded-xl bg-slate-900 hover:bg-slate-800 dark:bg-brand-600 dark:hover:bg-brand-700 text-white font-semibold text-sm transition shadow-lg">
      Perbarui Riwayat Pendidikan
    </button>
  </form>
</div>
@endsection