@extends('layouts.admin')

@section('title', 'Edit Tautan Sosial — ' . $socialLink->platform)
@section('page_title', 'Edit Tautan Sosial')

@section('content')
<div class="max-w-xl">
  <a href="{{ route('admin.social-links.index') }}"
    class="inline-flex items-center gap-2 text-xs font-semibold text-brand-500 hover:underline mb-6">
    &larr; Kembali ke Daftar Tautan
  </a>

  <form action="{{ route('admin.social-links.update', $socialLink->id) }}" method="POST"
    class="p-6 sm:p-8 bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-sm space-y-6">
    @csrf
    @method('PUT')

    <h2 class="text-base font-bold text-slate-900 dark:text-white border-b border-slate-100 dark:border-slate-800 pb-3">
      Perbarui Tautan Sosial
    </h2>

    <div>
      <label
        class="block text-xs font-semibold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">Platform
        Media Sosial</label>
      <input type="text" name="platform" value="{{ old('platform', $socialLink->platform) }}" required
        class="w-full rounded-xl border border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 px-4 py-2.5 text-sm focus:ring-2 focus:ring-brand-500 focus:outline-none dark:text-white">
      @error('platform') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
    </div>

    <div>
      <label class="block text-xs font-semibold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">Label
        Teks Tampilan</label>
      <input type="text" name="label" value="{{ old('label', $socialLink->label) }}" required
        class="w-full rounded-xl border border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 px-4 py-2.5 text-sm focus:ring-2 focus:ring-brand-500 focus:outline-none dark:text-white">
      @error('label') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
    </div>

    <div>
      <label class="block text-xs font-semibold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">Tautan
        URL Lengkap</label>
      <input type="url" name="url" value="{{ old('url', $socialLink->url) }}" required
        class="w-full rounded-xl border border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 px-4 py-2.5 text-sm focus:ring-2 focus:ring-brand-500 focus:outline-none dark:text-white">
      @error('url') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
    </div>

    <div class="grid grid-cols-2 gap-4">
      <div>
        <label
          class="block text-xs font-semibold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">Urutan
          Tampil</label>
        <input type="number" name="sort_order" value="{{ old('sort_order', $socialLink->sort_order) }}"
          class="w-full rounded-xl border border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 px-4 py-2.5 text-sm focus:ring-2 focus:ring-brand-500 focus:outline-none dark:text-white">
      </div>

      <div class="flex items-end pb-2">
        <label class="flex items-center gap-2 cursor-pointer text-sm font-semibold text-slate-800 dark:text-slate-200">
          <input type="checkbox" name="is_active" value="1" {{ old('is_active', $socialLink->is_active) ? 'checked' : ''
          }} class="rounded border-slate-300 text-brand-500 focus:ring-brand-500">
          <span>Aktifkan</span>
        </label>
      </div>
    </div>

    <button type="submit"
      class="w-full py-3.5 px-6 rounded-xl bg-slate-900 hover:bg-slate-800 dark:bg-brand-600 dark:hover:bg-brand-700 text-white font-semibold text-sm transition shadow-lg">
      Perbarui Tautan
    </button>
  </form>
</div>
@endsection