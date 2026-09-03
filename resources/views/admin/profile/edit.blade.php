@extends('layouts.admin')

@section('title', 'Edit Profil & Biodata')
@section('page_title', 'Profil & Identitas Diri')

@section('content')
<div class="max-w-4xl">
  <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
    @csrf
    @method('PUT')

    <!-- Card Identitas Pokok -->
    <div
      class="p-6 sm:p-8 bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-sm space-y-6">
      <h2
        class="text-base font-bold text-slate-900 dark:text-white border-b border-slate-100 dark:border-slate-800 pb-3">
        Informasi Utama
      </h2>

      <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
        <div>
          <label
            class="block text-xs font-semibold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">Nama
            Lengkap</label>
          <input type="text" name="name" value="{{ old('name', $profile->name) }}" required
            class="w-full rounded-xl border border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 px-4 py-2.5 text-sm focus:ring-2 focus:ring-brand-500 focus:outline-none dark:text-white">
          @error('name') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
        </div>

        <div>
          <label
            class="block text-xs font-semibold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">Headline
            / Job Title</label>
          <input type="text" name="headline" value="{{ old('headline', $profile->headline) }}" required
            class="w-full rounded-xl border border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 px-4 py-2.5 text-sm focus:ring-2 focus:ring-brand-500 focus:outline-none dark:text-white">
          @error('headline') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
        </div>
      </div>

      <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
        <div>
          <label
            class="block text-xs font-semibold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">Domisili
            / Lokasi</label>
          <input type="text" name="location" value="{{ old('location', $profile->location) }}" required
            class="w-full rounded-xl border border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 px-4 py-2.5 text-sm focus:ring-2 focus:ring-brand-500 focus:outline-none dark:text-white">
          @error('location') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
        </div>

        <div>
          <label
            class="block text-xs font-semibold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">Status
            Ketersediaan</label>
          <select name="availability_status"
            class="w-full rounded-xl border border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 px-4 py-2.5 text-sm focus:ring-2 focus:ring-brand-500 focus:outline-none dark:text-white">
            <option value="Available for Work" {{ old('availability_status', $profile->availability_status) ==
              'Available for Work' ? 'selected' : '' }}>Available for Work (Terbuka untuk Tawaran)</option>
            <option value="Open for Freelance" {{ old('availability_status', $profile->availability_status) == 'Open for
              Freelance' ? 'selected' : '' }}>Open for Freelance (Proyek Lepas)</option>
            <option value="Currently Employed" {{ old('availability_status', $profile->availability_status) ==
              'Currently Employed' ? 'selected' : '' }}>Currently Employed (Bekerja)</option>
          </select>
        </div>
      </div>

      <div>
        <label class="block text-xs font-semibold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">Bio
          Singkat (Ditampilkan di Hero Section)</label>
        <textarea name="short_bio" rows="2" required
          class="w-full rounded-xl border border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 px-4 py-2.5 text-sm focus:ring-2 focus:ring-brand-500 focus:outline-none dark:text-white">{{ old('short_bio', $profile->short_bio) }}</textarea>
        @error('short_bio') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
      </div>

      <div>
        <label
          class="block text-xs font-semibold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">Biografi
          Lengkap (Ditampilkan di About Section)</label>
        <textarea name="bio" rows="5" required
          class="w-full rounded-xl border border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 px-4 py-2.5 text-sm focus:ring-2 focus:ring-brand-500 focus:outline-none dark:text-white">{{ old('bio', $profile->bio) }}</textarea>
        @error('bio') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
      </div>
    </div>

    <!-- Card Kontak & Berkas -->
    <div
      class="p-6 sm:p-8 bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-sm space-y-6">
      <h2
        class="text-base font-bold text-slate-900 dark:text-white border-b border-slate-100 dark:border-slate-800 pb-3">
        Kontak & Berkas Portofolio
      </h2>

      <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
        <div>
          <label
            class="block text-xs font-semibold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">Email
            Publik</label>
          <input type="email" name="email" value="{{ old('email', $profile->email) }}" required
            class="w-full rounded-xl border border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 px-4 py-2.5 text-sm focus:ring-2 focus:ring-brand-500 focus:outline-none dark:text-white">
        </div>
        <div>
          <label
            class="block text-xs font-semibold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">Nomor
            Telepon / WhatsApp</label>
          <input type="text" name="phone" value="{{ old('phone', $profile->phone) }}"
            class="w-full rounded-xl border border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 px-4 py-2.5 text-sm focus:ring-2 focus:ring-brand-500 focus:outline-none dark:text-white">
        </div>
      </div>

      <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 pt-4 border-t border-slate-100 dark:border-slate-800">
        <!-- Foto Profil -->
        <div>
          <label
            class="block text-xs font-semibold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">Foto
            Profil (JPG/PNG/WEBP, Max 2MB)</label>
          @if($profile->profile_image)
          <div class="mb-3 flex items-center gap-3">
            <img src="{{ asset('storage/' . $profile->profile_image) }}"
              class="w-16 h-16 rounded-xl object-cover border border-slate-200 dark:border-slate-700">
            <span class="text-xs text-slate-400">Foto profil saat ini</span>
          </div>
          @endif
          <input type="file" name="profile_image" accept="image/*"
            class="w-full text-xs text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-slate-100 dark:file:bg-slate-800 file:text-slate-700 dark:file:text-slate-300 hover:file:bg-slate-200 cursor-pointer">
        </div>

        <!-- CV File PDF -->
        <div>
          <label
            class="block text-xs font-semibold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">Berkas
            CV (PDF Only, Max 5MB)</label>
          @if($profile->cv_file)
          <div class="mb-3 flex items-center gap-2 text-xs text-emerald-600 dark:text-emerald-400 font-semibold">
            <span>📄 CV Tersedia</span>
            <a href="{{ route('resume.download') }}" target="_blank" class="underline hover:text-emerald-700">Unduh &
              Periksa</a>
          </div>
          @endif
          <input type="file" name="cv_file" accept=".pdf"
            class="w-full text-xs text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-slate-100 dark:file:bg-slate-800 file:text-slate-700 dark:file:text-slate-300 hover:file:bg-slate-200 cursor-pointer">
        </div>
      </div>
    </div>

    <button type="submit"
      class="px-6 py-3.5 rounded-xl bg-slate-900 hover:bg-slate-800 dark:bg-brand-600 dark:hover:bg-brand-700 text-white font-semibold text-sm transition shadow-lg flex items-center gap-2">
      <span>Simpan Perubahan Profil</span>
    </button>
  </form>
</div>
@endsection