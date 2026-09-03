@extends('layouts.app')

@section('title', $project->title . ' — Studi Kasus')
@section('meta_description', $project->short_description)

@section('content')
<article class="py-16 sm:py-24">
  <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

    <!-- Navigasi Balik -->
    <a href="{{ route('projects.index') }}"
      class="inline-flex items-center gap-2 text-sm font-semibold text-emerald-500 hover:text-emerald-600 mb-8 transition">
      &larr; Kembali ke Daftar Proyek
    </a>

    <!-- Header Proyek -->
    <div class="mb-10">
      <div class="flex flex-wrap items-center gap-3 mb-4">
        <span
          class="px-3 py-1 bg-emerald-100 text-emerald-800 dark:bg-emerald-950/60 dark:text-emerald-400 text-xs font-semibold rounded-full border border-emerald-300 dark:border-emerald-800">
          {{ $project->category->name ?? 'Project' }}
        </span>
        <span class="text-xs text-slate-400 font-medium">
          Status: <span class="text-slate-700 dark:text-slate-300 font-semibold">{{ $project->status }}</span>
        </span>
        @if(!$project->is_published)
        <span
          class="px-2.5 py-0.5 rounded text-[11px] bg-amber-100 text-amber-800 dark:bg-amber-950/60 dark:text-amber-400 font-bold">
          Mode Pratinjau Draft (Belum Publik)
        </span>
        @endif
      </div>

      <h1 class="text-3xl sm:text-5xl font-extrabold text-slate-900 dark:text-white tracking-tight mb-6">
        {{ $project->title }}
      </h1>

      <p class="text-lg text-slate-600 dark:text-slate-300 leading-relaxed mb-8">
        {{ $project->short_description }}
      </p>

      <!-- Metadata Box: Role, Client, Dates, Links -->
      <div
        class="grid grid-cols-2 sm:grid-cols-4 gap-4 p-6 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 text-xs shadow-sm mb-8">
        <div>
          <span class="block text-slate-400 dark:text-slate-500 mb-1">Peran:</span>
          <span class="font-bold text-slate-800 dark:text-slate-200">{{ $project->role ?? 'Full-Stack Developer'
            }}</span>
        </div>
        <div>
          <span class="block text-slate-400 dark:text-slate-500 mb-1">Klien/Organisasi:</span>
          <span class="font-bold text-slate-800 dark:text-slate-200">{{ $project->client ?? 'Internal/Personal'
            }}</span>
        </div>
        <div>
          <span class="block text-slate-400 dark:text-slate-500 mb-1">Periode:</span>
          <span class="font-bold text-slate-800 dark:text-slate-200">
            {{ $project->start_date ? \Carbon\Carbon::parse($project->start_date)->format('M Y') : '-' }}
            &bull;
            {{ $project->end_date ? \Carbon\Carbon::parse($project->end_date)->format('M Y') : 'Sekarang' }}
          </span>
        </div>
        <div>
          <span class="block text-slate-400 dark:text-slate-500 mb-1">Tautan:</span>
          <div class="flex items-center gap-3">
            @if($project->live_url)
            <a href="{{ $project->live_url }}" target="_blank" class="font-bold text-emerald-500 hover:underline">
              Demo &#8599;
            </a>
            @endif
            @if($project->github_url)
            <a href="{{ $project->github_url }}" target="_blank"
              class="font-bold text-slate-600 dark:text-slate-300 hover:underline">
              GitHub &#8599;
            </a>
            @endif
          </div>
        </div>
      </div>

      <!-- Tech Stack Pills -->
      <div class="flex flex-wrap items-center gap-2">
        <span class="text-xs font-semibold text-slate-400 dark:text-slate-500 mr-2">Teknologi:</span>
        @foreach($project->technologies as $tech)
        <span
          class="px-3 py-1 rounded-lg text-xs font-semibold bg-slate-200/70 dark:bg-slate-800 text-slate-700 dark:text-slate-300">
          {{ $tech->name }}
        </span>
        @endforeach
      </div>
    </div>

    <!-- Gambar Utama / Thumbnail -->
    <div
      class="aspect-video w-full rounded-2xl overflow-hidden bg-slate-100 dark:bg-slate-800 border border-slate-200 dark:border-slate-800 shadow-lg mb-12">
      <img src="{{ $project->thumbnail }}" alt="{{ $project->title }}" class="w-full h-full object-cover">
    </div>

    <!-- Deskripsi Mendalam / Studi Kasus -->
    <div class="mb-14">
      <h2 class="text-2xl font-extrabold text-slate-900 dark:text-white mb-4">Ringkasan & Gambaran Umum</h2>
      <div
        class="prose prose-slate dark:prose-invert max-w-none text-slate-600 dark:text-slate-300 leading-relaxed text-base space-y-4">
        {!! nl2br(e($project->description)) !!}
      </div>
    </div>

    <!-- Fitur & Arsitektur Utama (Jika Ada) -->
    @if($project->features && $project->features->count() > 0)
    <div class="mb-14">
      <h2 class="text-2xl font-extrabold text-slate-900 dark:text-white mb-6">Fitur & Arsitektur Utama</h2>
      <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        @foreach($project->features as $feature)
        <div class="p-5 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 shadow-sm">
          <div class="flex items-center gap-3 mb-2">
            <div
              class="w-8 h-8 rounded-lg bg-emerald-500/10 text-emerald-500 flex items-center justify-center font-bold text-sm">
              ✓
            </div>
            <h3 class="font-bold text-slate-900 dark:text-white text-base">{{ $feature->title }}</h3>
          </div>
          <p class="text-xs text-slate-500 dark:text-slate-400 leading-relaxed pl-11">
            {{ $feature->description }}
          </p>
        </div>
        @endforeach
      </div>
    </div>
    @endif

    <!-- CTA Bawah -->
    <div class="p-8 rounded-2xl bg-slate-900 text-white dark:bg-slate-900/60 border border-slate-800 text-center">
      <h3 class="text-xl font-bold mb-2">Tertarik dengan hasil implementasi proyek ini?</h3>
      <p class="text-slate-400 text-sm mb-6">Mari diskusikan kebutuhan teknis aplikasi atau peluang kolaborasi bersama
        saya.</p>
      <a href="{{ route('home') }}#contact"
        class="inline-flex px-6 py-3 rounded-xl bg-emerald-500 hover:bg-emerald-600 text-slate-950 font-bold text-sm transition">
        Hubungi Saya Sekarang
      </a>
    </div>

  </div>
</article>
@endsection