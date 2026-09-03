@extends('layouts.app')

@section('title', 'Semua Proyek & Karya — Portfolio')
@section('meta_description', 'Kumpulan proyek pengembangan perangkat lunak, web application, dan arsitektur sistem.')

@section('content')
<div class="py-16 sm:py-24">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

    <!-- Header -->
    <div class="max-w-3xl mb-12">
      <a href="{{ route('home') }}"
        class="text-sm font-semibold text-emerald-500 hover:text-emerald-600 transition flex items-center gap-2 mb-4">
        &larr; Kembali ke Beranda
      </a>
      <h1 class="text-4xl sm:text-5xl font-extrabold text-slate-900 dark:text-white tracking-tight mb-4">
        Arsip Proyek & Eksplorasi
      </h1>
      <p class="text-lg text-slate-600 dark:text-slate-400">
        Daftar lengkap solusi perangkat lunak, sistem informasi, dan eksperimen teknis yang pernah saya bangun.
      </p>
    </div>

    <!-- Filter Kategori Kustom -->
    <div class="flex flex-wrap gap-2 mb-10">
      <a href="{{ route('projects.index') }}"
        class="px-4 py-2 rounded-xl text-xs font-semibold tracking-wide transition {{ !request('category') ? 'bg-slate-900 text-white dark:bg-emerald-500 dark:text-slate-950 shadow-md' : 'bg-white dark:bg-slate-900 text-slate-600 dark:text-slate-400 border border-slate-200 dark:border-slate-800 hover:border-emerald-500' }}">
        Semua Proyek
      </a>
      @foreach($categories as $cat)
      <a href="{{ route('projects.index', ['category' => $cat->slug]) }}"
        class="px-4 py-2 rounded-xl text-xs font-semibold tracking-wide transition {{ request('category') == $cat->slug ? 'bg-slate-900 text-white dark:bg-emerald-500 dark:text-slate-950 shadow-md' : 'bg-white dark:bg-slate-900 text-slate-600 dark:text-slate-400 border border-slate-200 dark:border-slate-800 hover:border-emerald-500' }}">
        {{ $cat->name }}
      </a>
      @endforeach
    </div>

    <!-- Grid Proyek -->
    @if($projects->count() > 0)
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
      @foreach($projects as $project)
      <div
        class="group rounded-2xl overflow-hidden bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 flex flex-col shadow-sm hover:shadow-xl transition-all duration-300">
        <!-- Thumbnail -->
        <div class="aspect-video w-full overflow-hidden bg-slate-100 dark:bg-slate-800 relative">
          <img src="{{ $project->thumbnail }}" alt="{{ $project->title }}"
            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
          <span
            class="absolute top-3 left-3 px-2.5 py-1 bg-slate-900/80 backdrop-blur-md text-white text-[11px] font-semibold rounded-full">
            {{ $project->category->name }}
          </span>
        </div>

        <!-- Info Card -->
        <div class="p-6 flex flex-col flex-grow">
          <h3 class="font-bold text-lg text-slate-900 dark:text-white mb-2 group-hover:text-emerald-500 transition">
            <a href="{{ route('projects.show', $project->slug) }}">
              {{ $project->title }}
            </a>
          </h3>
          <p class="text-slate-600 dark:text-slate-400 text-sm mb-6 flex-grow line-clamp-3">
            {{ $project->short_description }}
          </p>

          <!-- Technologies -->
          <div class="flex flex-wrap gap-1.5 mb-6">
            @foreach($project->technologies as $tech)
            <span
              class="px-2 py-0.5 rounded text-[11px] font-medium bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300">
              {{ $tech->name }}
            </span>
            @endforeach
          </div>

          <div class="pt-4 border-t border-slate-100 dark:border-slate-800 flex items-center justify-between text-xs">
            <a href="{{ route('projects.show', $project->slug) }}"
              class="font-semibold text-emerald-500 hover:underline flex items-center gap-1">
              Studi Kasus &rarr;
            </a>
            @if($project->live_url)
            <a href="{{ $project->live_url }}" target="_blank"
              class="font-medium text-slate-400 hover:text-slate-600 dark:hover:text-white">
              Live Demo &#8599;
            </a>
            @endif
          </div>
        </div>
      </div>
      @endforeach
    </div>

    <!-- Pagination -->
    <div class="mt-12">
      {{ $projects->links() }}
    </div>
    @else
    <div class="text-center py-20 bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800">
      <p class="text-slate-400 text-base">Belum ada proyek yang ditemukan pada kategori ini.</p>
      <a href="{{ route('projects.index') }}"
        class="mt-4 inline-block text-sm font-semibold text-emerald-500 hover:underline">
        Lihat Semua Kategori
      </a>
    </div>
    @endif

  </div>
</div>
@endsection