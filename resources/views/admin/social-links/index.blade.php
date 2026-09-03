@extends('layouts.admin')

@section('title', 'Manajemen Tautan Sosial')
@section('page_title', 'Tautan Sosial Media')

@section('content')
<div class="space-y-6">

  <!-- Header & Action Button -->
  <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
    <div>
      <h2 class="text-xl font-bold text-slate-900 dark:text-white">Daftar Tautan Sosial & Profil Online</h2>
      <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Kelola tautan akun media sosial, GitHub, dan jejaring
        profesional yang tampil di beranda dan footer.</p>
    </div>
    <a href="{{ route('admin.social-links.create') }}"
      class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-slate-900 hover:bg-slate-800 dark:bg-brand-600 dark:hover:bg-brand-700 text-white font-semibold text-xs transition shadow-md self-start sm:self-auto">
      <span>+ Tambah Tautan Baru</span>
    </a>
  </div>

  <!-- Tabel Tautan Sosial -->
  <div
    class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
      <table class="w-full text-left text-sm text-slate-600 dark:text-slate-300">
        <thead
          class="text-xs uppercase bg-slate-50 dark:bg-slate-800 text-slate-400 font-semibold border-b border-slate-200 dark:border-slate-800">
          <tr>
            <th class="px-6 py-4">Platform</th>
            <th class="px-6 py-4">Label Teks</th>
            <th class="px-6 py-4">URL Profil</th>
            <th class="px-6 py-4">Status</th>
            <th class="px-6 py-4 text-right">Aksi</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
          @forelse($socialLinks as $item)
          <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/50 transition">
            <!-- Platform -->
            <td class="px-6 py-4">
              <span class="font-bold text-slate-900 dark:text-white">{{ $item->platform }}</span>
            </td>

            <!-- Label -->
            <td class="px-6 py-4 text-xs font-mono text-slate-600 dark:text-slate-400">
              {{ $item->label }}
            </td>

            <!-- URL Profil -->
            <td class="px-6 py-4 text-xs">
              <a href="{{ $item->url }}" target="_blank"
                class="text-emerald-500 hover:underline flex items-center gap-1">
                <span class="truncate max-w-xs">{{ $item->url }}</span> &#8599;
              </a>
            </td>

            <!-- Status Aktif -->
            <td class="px-6 py-4 text-xs">
              @if($item->is_active)
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
              <a href="{{ route('admin.social-links.edit', $item->id) }}"
                class="inline-flex items-center px-3 py-1.5 rounded-lg bg-slate-100 dark:bg-slate-800 hover:bg-slate-200 dark:hover:bg-slate-700 text-xs font-semibold text-slate-700 dark:text-slate-200 transition">
                Edit
              </a>
              <form action="{{ route('admin.social-links.destroy', $item->id) }}" method="POST" class="inline"
                onsubmit="return confirm('Hapus tautan ini?')">
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
              Belum ada tautan sosial yang ditambahkan.
            </td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

</div>
@endsection