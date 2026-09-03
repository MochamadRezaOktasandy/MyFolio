@extends('layouts.admin')

@section('title', 'Manajemen Proyek')
@section('page_title', 'Daftar Semua Proyek')

@section('content')
<div class="space-y-6">

  <!-- Header & Action Button -->
  <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
    <div>
      <h2 class="text-xl font-bold text-slate-900 dark:text-white">Daftar Proyek & Portofolio</h2>
      <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Kelola karya, aplikasi, dan studi kasus yang Anda
        tampilkan ke publik.</p>
    </div>
    <a href="{{ route('admin.projects.create') }}"
      class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-slate-900 hover:bg-slate-800 dark:bg-brand-600 dark:hover:bg-brand-700 text-white font-semibold text-xs transition shadow-md self-start sm:self-auto">
      <span>+ Tambah Proyek Baru</span>
    </a>
  </div>

  <!-- Tabel Proyek -->
  <div
    class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
      <table class="w-full text-left text-sm text-slate-600 dark:text-slate-300">
        <thead
          class="text-xs uppercase bg-slate-50 dark:bg-slate-800 text-slate-400 font-semibold border-b border-slate-200 dark:border-slate-800">
          <tr>
            <th class="px-6 py-4">Proyek</th>
            <th class="px-6 py-4">Kategori</th>
            <th class="px-6 py-4">Teknologi</th>
            <th class="px-6 py-4">Status</th>
            <th class="px-6 py-4 text-right">Aksi</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
          @forelse($projects as $proj)
          <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/50 transition">
            <!-- Thumbnail & Judul -->
            <td class="px-6 py-4">
              <div class="flex items-center gap-3">
                <img src="{{ $proj->thumbnail }}" alt="{{ $proj->title }}"
                  class="w-14 h-10 rounded-lg object-cover bg-slate-100 dark:bg-slate-800 border border-slate-200 dark:border-slate-700">
                <div>
                  <div class="font-bold text-slate-900 dark:text-white flex items-center gap-2">
                    <span>{{ $proj->title }}</span>
                    @if($proj->is_featured)
                    <span
                      class="px-1.5 py-0.5 rounded text-[10px] bg-amber-100 text-amber-800 dark:bg-amber-950/60 dark:text-amber-400 font-semibold">Featured</span>
                    @endif
                  </div>
                  <div class="text-xs text-slate-400 truncate max-w-xs">{{ $proj->role ?? 'Full-Stack Developer' }}
                  </div>
                </div>
              </div>
            </td>

            <!-- Kategori -->
            <td class="px-6 py-4 text-xs font-medium">
              <span class="px-2.5 py-1 rounded-full bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-300">
                {{ $proj->category->name ?? '-' }}
              </span>
            </td>

            <!-- Teknologi -->
            <td class="px-6 py-4">
              <div class="flex flex-wrap gap-1 max-w-xs">
                @foreach($proj->technologies as $tech)
                <span
                  class="px-2 py-0.5 rounded text-[10px] bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-400">
                  {{ $tech->name }}
                </span>
                @endforeach
              </div>
            </td>

            <!-- Publikasi Status -->
            <td class="px-6 py-4 text-xs">
              @if($proj->is_published)
              <span class="inline-flex items-center gap-1.5 font-semibold text-emerald-600 dark:text-emerald-400">
                <span class="w-2 h-2 rounded-full bg-emerald-500"></span> Live
              </span>
              @else
              <span class="inline-flex items-center gap-1.5 font-semibold text-slate-400">
                <span class="w-2 h-2 rounded-full bg-slate-400"></span> Draft
              </span>
              @endif
            </td>

            <!-- Aksi -->
            <td class="px-6 py-4 text-right space-x-2">
              <a href="{{ route('projects.show', $proj->slug) }}" target="_blank"
                class="inline-flex items-center px-2.5 py-1.5 rounded-lg text-xs font-semibold text-slate-500 hover:bg-slate-100 dark:hover:bg-slate-800 transition">
                Pratinjau &#8599;
              </a>
              <a href="{{ route('admin.projects.edit', $proj->id) }}"
                class="inline-flex items-center px-3 py-1.5 rounded-lg bg-slate-100 dark:bg-slate-800 hover:bg-slate-200 dark:hover:bg-slate-700 text-xs font-semibold text-slate-700 dark:text-slate-200 transition">
                Edit
              </a>
              <form action="{{ route('admin.projects.destroy', $proj->id) }}" method="POST" class="inline"
                onsubmit="return confirm('Apakah Anda yakin ingin menghapus proyek ini?')">
                @csrf
                @method('DELETE')
                <button type="submit"
                  class="inline-flex items-center px-3 py-1.5 rounded-lg text-xs font-semibold text-rose-500 hover:bg-rose-50 dark:hover:bg-rose-950/50 transition">
                  Hapus
                </button>
              </form>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="5" class="px-6 py-12 text-center text-slate-400 text-sm">
              Belum ada proyek yang dibuat.
            </td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    @if($projects->hasPages())
    <div class="p-6 border-t border-slate-100 dark:border-slate-800">
      {{ $projects->links() }}
    </div>
    @endif
  </div>

</div>
@endsection