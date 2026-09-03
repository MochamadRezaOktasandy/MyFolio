@extends('layouts.admin')

@section('title', 'Tambah Sertifikat Baru')
@section('page_title', 'Tambah Sertifikat')

@section('content')
<div class="max-w-3xl">
  <a href="{{ route('admin.certificates.index') }}"
    class="inline-flex items-center gap-2 text-xs font-semibold text-brand-500 hover:underline mb-6">
    &larr; Kembali ke Daftar Sertifikat
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

  <form action="{{ route('admin.certificates.store') }}" method="POST" enctype="multipart/form-data"
    x-data="{ hasExpiration: {{ old('has_expiration') ? 'true' : 'false' }} }"
    class="p-6 sm:p-8 bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-sm space-y-6">
    @csrf

    <h2 class="text-base font-bold text-slate-900 dark:text-white border-b border-slate-100 dark:border-slate-800 pb-3">
      Informasi Sertifikat / Lisensi
    </h2>

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
      <div>
        <label class="block text-xs font-semibold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">Nama
          Sertifikasi / Lisensi</label>
        <input type="text" name="title" value="{{ old('title') }}" required
          placeholder="cth: AWS Certified Solutions Architect"
          class="w-full rounded-xl border border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 px-4 py-2.5 text-sm focus:ring-2 focus:ring-brand-500 focus:outline-none dark:text-white">
        @error('title') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
      </div>

      <div>
        <label
          class="block text-xs font-semibold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">Penerbit
          / Organisasi</label>
        <input type="text" name="issuer" value="{{ old('issuer') }}" required
          placeholder="cth: Amazon Web Services / Dicoding"
          class="w-full rounded-xl border border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 px-4 py-2.5 text-sm focus:ring-2 focus:ring-brand-500 focus:outline-none dark:text-white">
        @error('issuer') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
      </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
      <div>
        <label class="block text-xs font-semibold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">ID
          Kredensial (Opsional)</label>
        <input type="text" name="credential_id" value="{{ old('credential_id') }}" placeholder="cth: AWS-89234812"
          class="w-full rounded-xl border border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 px-4 py-2.5 text-sm focus:ring-2 focus:ring-brand-500 focus:outline-none dark:text-white font-mono text-xs">
      </div>

      <div>
        <label class="block text-xs font-semibold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">URL
          Verifikasi Resmi</label>
        <input type="url" name="credential_url" value="{{ old('credential_url') }}" placeholder="https://..."
          class="w-full rounded-xl border border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 px-4 py-2.5 text-sm focus:ring-2 focus:ring-brand-500 focus:outline-none dark:text-white">
      </div>
    </div>

    <!-- Tanggal Terbit & Kedaluwarsa -->
    <div class="pt-4 border-t border-slate-100 dark:border-slate-800 space-y-4">
      <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
        <div>
          <label
            class="block text-xs font-semibold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">Tanggal
            Penerbitan</label>
          <input type="date" name="issue_date" value="{{ old('issue_date') }}" required
            class="w-full rounded-xl border border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 px-4 py-2.5 text-sm focus:ring-2 focus:ring-brand-500 focus:outline-none dark:text-white">
          @error('issue_date') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
        </div>

        <div :class="!hasExpiration ? 'opacity-40 cursor-not-allowed' : ''">
          <label class="block text-xs font-semibold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">
            Tanggal Kedaluwarsa
            <span x-show="!hasExpiration" class="text-emerald-500 font-bold lowercase">(seumur hidup)</span>
          </label>
          <input type="date" name="expiration_date" value="{{ old('expiration_date') }}" :disabled="!hasExpiration"
            class="w-full rounded-xl border border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 px-4 py-2.5 text-sm focus:ring-2 focus:ring-brand-500 focus:outline-none dark:text-white disabled:cursor-not-allowed">
          @error('expiration_date') <span class="text-red-500 text-xs mt-1 block font-semibold">{{ $message }}</span>
          @enderror
        </div>
      </div>

      <label class="flex items-center gap-2 cursor-pointer text-xs font-semibold text-slate-700 dark:text-slate-300">
        <input type="checkbox" name="has_expiration" value="1" x-model="hasExpiration"
          class="rounded border-slate-300 text-brand-500 focus:ring-brand-500">
        <span>Sertifikat ini memiliki batas masa berlaku / expiration date</span>
      </label>
    </div>

    <!-- Unggah Foto/Gambar Sertifikat -->
    <div>
      <label class="block text-xs font-semibold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">Unggah
        Berkas / Foto Sertifikat (JPG/PNG/WEBP, Max 3MB)</label>
      <input type="file" name="image" accept="image/*"
        class="w-full text-xs text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-slate-100 dark:file:bg-slate-800 file:text-slate-700 dark:file:text-slate-300 hover:file:bg-slate-200 cursor-pointer">
      @error('image') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
    </div>

    <div>
      <label
        class="block text-xs font-semibold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">Deskripsi
        Keterampilan yang Diuji (Opsional)</label>
      <textarea name="description" rows="3" placeholder="Materi atau topik utama yang dikuasai dalam sertifikasi ini..."
        class="w-full rounded-xl border border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 px-4 py-2.5 text-sm focus:ring-2 focus:ring-brand-500 focus:outline-none dark:text-white">{{ old('description') }}</textarea>
    </div>

    <div class="flex flex-wrap items-center gap-6 pt-4 border-t border-slate-100 dark:border-slate-800">
      <label class="flex items-center gap-2 cursor-pointer text-sm font-semibold text-slate-800 dark:text-slate-200">
        <input type="checkbox" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}
          class="rounded border-slate-300 text-brand-500 focus:ring-brand-500">
        <span>Jadikan Sertifikasi Pilihan (Featured)</span>
      </label>

      <div class="flex items-center gap-2">
        <span class="text-xs font-semibold text-slate-500">Urutan:</span>
        <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}"
          class="w-20 rounded-xl border border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 px-3 py-1.5 text-sm focus:ring-2 focus:ring-brand-500 focus:outline-none dark:text-white">
      </div>
    </div>

    <button type="submit"
      class="w-full py-3.5 px-6 rounded-xl bg-slate-900 hover:bg-slate-800 dark:bg-brand-600 dark:hover:bg-brand-700 text-white font-semibold text-sm transition shadow-lg">
      Simpan Sertifikat
    </button>
  </form>
</div>
@endsection