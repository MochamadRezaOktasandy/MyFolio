@extends('layouts.admin')

@section('title', 'Manajemen Pengalaman')
@section('page_title', 'Pengalaman Kerja')

@section('content')
<div class="space-y-6">

  <!-- Header & Action Button -->
  <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
    <div>
      <h2 class="text-xl font-bold text-slate-900 dark:text-white">Riwayat Karir & Pengalaman</h2>
      <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Kelola riwayat karir profesional yang ditampilkan di
        timeline portofolio.</p>
    </div>
    <a href="{{ route('admin.experiences.create') }}"
      class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-slate-900 hover:bg-slate-800 dark:bg-brand-600 dark:hover:bg-brand-700 text-white font-semibold text-xs transition shadow-md self-start sm:self-auto">
      <span>+ Tambah Pengalaman Baru</span>
    </a>
  </div>

  <!-- Tabel Pengalaman Kerja -->
  <div
    class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
      <table class="w-full text-left text-sm text-slate-600 dark:text-slate-300">
        <thead
          class="text-xs uppercase bg-slate-50 dark:bg-slate-800 text-slate-400 font-semibold border-b border-slate-200 dark:border-slate-800">
          <tr>
            <th class="px-6 py-4">Posisi & Perusahaan</th>
            <th class="px-6 py-4">Tipe Pekerjaan</th>
            <th class="px-6 py-4">Lokasi</th>
            <th class="px-6 py-4">Periode Kerja</th>
            <th class="px-6 py-4 text-right">Aksi</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
          @forelse($experiences as $exp)
          <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/50 transition">
            <!-- Posisi & Perusahaan -->
            <td class="px-6 py-4">
              <div class="font-bold text-slate-900 dark:text-white flex items-center gap-2">
                <span>{{ $exp->position }}</span>
                @if($exp->is_current)
                <span
                  class="px-2 py-0.5 rounded-full text-[10px] bg-emerald-100 text-emerald-800 dark:bg-emerald-950/60 dark:text-emerald-400 font-bold">Saat
                  Ini</span>
                @endif
              </div>
              <div class="text-xs text-slate-400 font-medium mt-0.5">{{ $exp->company }}</div>
            </td>

            <!-- Tipe -->
            <td class="px-6 py-4 text-xs font-medium">
              <span class="px-2.5 py-1 rounded-full bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-300">
                {{ $exp->employment_type }}
              </span>
            </td>

            <!-- Lokasi -->
            <td class="px-6 py-4 text-xs">
              {{ $exp->location ?? '-' }}
            </td>

            <!-- Periode Kerja -->
            <td class="px-6 py-4 text-xs font-semibold text-slate-700 dark:text-slate-300">
              {{ \Carbon\Carbon::parse($exp->start_date)->format('M Y') }} —
              @if($exp->is_current)
              <span class="text-emerald-500 font-bold">Sekarang</span>
              @else
              {{ \Carbon\Carbon::parse($exp->end_date)->format('M Y') }}
              @endif
            </td>

            <!-- Tombol Aksi -->
            <td class="px-6 py-4 text-right space-x-2">
              <a href="{{ route('admin.experiences.edit', $exp->id) }}"
                class="inline-flex items-center px-3 py-1.5 rounded-lg bg-slate-100 dark:bg-slate-800 hover:bg-slate-200 dark:hover:bg-slate-700 text-xs font-semibold text-slate-700 dark:text-slate-200 transition">
                Edit
              </a>
              <form action="{{ route('admin.experiences.destroy', $exp->id) }}" method="POST" class="inline"
                onsubmit="return confirm('Hapus riwayat pengalaman ini?')">
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
              Belum ada riwayat pengalaman kerja yang dicatat.
            </td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    @if($experiences->hasPages())
    <div class="p-6 border-t border-slate-100 dark:border-slate-800">
      {{ $experiences->links() }}
    </div>
    @endif
  </div>

</div>
@endsection