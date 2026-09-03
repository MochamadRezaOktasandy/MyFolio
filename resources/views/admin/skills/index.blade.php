@extends('layouts.admin')

@section('title', 'Manajemen Keahlian')
@section('page_title', 'Keahlian & Teknologi')

@section('content')
<div class="space-y-6">

  <!-- Header & Action Button -->
  <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
    <div>
      <h2 class="text-xl font-bold text-slate-900 dark:text-white">Daftar Keahlian (Tech Stack)</h2>
      <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Kelola kemampuan pemrograman, tools, dan basis data
        yang ditampilkan di beranda.</p>
    </div>
    <a href="{{ route('admin.skills.create') }}"
      class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-slate-900 hover:bg-slate-800 dark:bg-brand-600 dark:hover:bg-brand-700 text-white font-semibold text-xs transition shadow-md self-start sm:self-auto">
      <span>+ Tambah Skill Baru</span>
    </a>
  </div>

  <!-- Tabel Keahlian -->
  <div
    class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
      <table class="w-full text-left text-sm text-slate-600 dark:text-slate-300">
        <thead
          class="text-xs uppercase bg-slate-50 dark:bg-slate-800 text-slate-400 font-semibold border-b border-slate-200 dark:border-slate-800">
          <tr>
            <th class="px-6 py-4">Nama Keahlian</th>
            <th class="px-6 py-4">Kategori</th>
            <th class="px-6 py-4">Tingkat Penguasaan</th>
            <th class="px-6 py-4">Level</th>
            <th class="px-6 py-4">Status</th>
            <th class="px-6 py-4 text-right">Aksi</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
          @forelse($skills as $skill)
          <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/50 transition">
            <!-- Nama & Featured -->
            <td class="px-6 py-4">
              <div class="font-bold text-slate-900 dark:text-white flex items-center gap-2">
                <span>{{ $skill->name }}</span>
                @if($skill->is_featured)
                <span
                  class="px-1.5 py-0.5 rounded text-[10px] bg-amber-100 text-amber-800 dark:bg-amber-950/60 dark:text-amber-400 font-semibold">Featured</span>
                @endif
              </div>
            </td>

            <!-- Kategori -->
            <td class="px-6 py-4 text-xs">
              <span
                class="px-2.5 py-1 rounded-full bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-300 font-medium">
                {{ $skill->category->name ?? '-' }}
              </span>
            </td>

            <!-- Visualisasi Progress Bar -->
            <td class="px-6 py-4 w-48">
              <div class="flex items-center gap-3">
                <div class="w-full bg-slate-100 dark:bg-slate-800 rounded-full h-2">
                  <div class="bg-emerald-500 h-2 rounded-full" style="width: {{ $skill->percentage }}%"></div>
                </div>
                <span class="text-xs font-bold text-slate-700 dark:text-slate-300">{{ $skill->percentage }}%</span>
              </div>
            </td>

            <!-- Level Kemahiran -->
            <td class="px-6 py-4 text-xs font-semibold text-slate-700 dark:text-slate-300">
              {{ $skill->experience_level ?? 'Intermediate' }}
            </td>

            <!-- Status Aktif -->
            <td class="px-6 py-4 text-xs">
              @if($skill->is_active)
              <span class="inline-flex items-center gap-1.5 font-semibold text-emerald-600 dark:text-emerald-400">
                <span class="w-2 h-2 rounded-full bg-emerald-500"></span> Aktif
              </span>
              @else
              <span class="inline-flex items-center gap-1.5 font-semibold text-slate-400">
                <span class="w-2 h-2 rounded-full bg-slate-400"></span> Nonaktif
              </span>
              @endif
            </td>

            <!-- Tombol Aksi -->
            <td class="px-6 py-4 text-right space-x-2">
              <a href="{{ route('admin.skills.edit', $skill->id) }}"
                class="inline-flex items-center px-3 py-1.5 rounded-lg bg-slate-100 dark:bg-slate-800 hover:bg-slate-200 dark:hover:bg-slate-700 text-xs font-semibold text-slate-700 dark:text-slate-200 transition">
                Edit
              </a>
              <form action="{{ route('admin.skills.destroy', $skill->id) }}" method="POST" class="inline"
                onsubmit="return confirm('Hapus keahlian ini?')">
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
            <td colspan="6" class="px-6 py-12 text-center text-slate-400 text-sm">
              Belum ada keahlian yang ditambahkan.
            </td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    @if($skills->hasPages())
    <div class="p-6 border-t border-slate-100 dark:border-slate-800">
      {{ $skills->links() }}
    </div>
    @endif
  </div>

</div>
@endsection