@extends('layouts.admin')

@section('title', 'Manajemen Pendidikan')
@section('page_title', 'Riwayat Pendidikan')

@section('content')
<div class="space-y-6">

  <!-- Header & Action Button -->
  <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
    <div>
      <h2 class="text-xl font-bold text-slate-900 dark:text-white">Riwayat Pendidikan Formal</h2>
      <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Kelola latar belakang studi dan pendidikan akademis
        Anda.</p>
    </div>
    <a href="{{ route('admin.educations.create') }}"
      class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-slate-900 hover:bg-slate-800 dark:bg-brand-600 dark:hover:bg-brand-700 text-white font-semibold text-xs transition shadow-md self-start sm:self-auto">
      <span>+ Tambah Pendidikan Baru</span>
    </a>
  </div>

  <!-- Tabel Pendidikan -->
  <div
    class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
      <table class="w-full text-left text-sm text-slate-600 dark:text-slate-300">
        <thead
          class="text-xs uppercase bg-slate-50 dark:bg-slate-800 text-slate-400 font-semibold border-b border-slate-200 dark:border-slate-800">
          <tr>
            <th class="px-6 py-4">Institusi / Universitas</th>
            <th class="px-6 py-4">Gelar & Jurusan</th>
            <th class="px-6 py-4">Periode Studi</th>
            <th class="px-6 py-4 text-right">Aksi</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
          @forelse($educations as $edu)
          <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/50 transition">
            <!-- Institusi -->
            <td class="px-6 py-4">
              <div class="font-bold text-slate-900 dark:text-white flex items-center gap-2">
                <span>{{ $edu->institution }}</span>
                @if($edu->is_current)
                <span
                  class="px-2 py-0.5 rounded-full text-[10px] bg-teal-100 text-teal-800 dark:bg-teal-950/60 dark:text-teal-400 font-bold">Sedang
                  Studi</span>
                @endif
              </div>
            </td>

            <!-- Gelar & Bidang Studi -->
            <td class="px-6 py-4 text-xs">
              <div class="font-bold text-slate-800 dark:text-slate-200">{{ $edu->degree }}</div>
              <div class="text-slate-400 mt-0.5">{{ $edu->field_of_study }}</div>
            </td>

            <!-- Periode Studi -->
            <td class="px-6 py-4 text-xs font-semibold text-slate-700 dark:text-slate-300">
              {{ \Carbon\Carbon::parse($edu->start_date)->format('Y') }} —
              @if($edu->is_current)
              <span class="text-teal-500 font-bold">Sekarang</span>
              @else
              {{ \Carbon\Carbon::parse($edu->end_date)->format('Y') }}
              @endif
            </td>

            <!-- Tombol Aksi -->
            <td class="px-6 py-4 text-right space-x-2">
              <a href="{{ route('admin.educations.edit', $edu->id) }}"
                class="inline-flex items-center px-3 py-1.5 rounded-lg bg-slate-100 dark:bg-slate-800 hover:bg-slate-200 dark:hover:bg-slate-700 text-xs font-semibold text-slate-700 dark:text-slate-200 transition">
                Edit
              </a>
              <form action="{{ route('admin.educations.destroy', $edu->id) }}" method="POST" class="inline"
                onsubmit="return confirm('Hapus riwayat pendidikan ini?')">
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
            <td colspan="4" class="px-6 py-12 text-center text-slate-400 text-sm">
              Belum ada riwayat pendidikan yang dicatat.
            </td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    @if($educations->hasPages())
    <div class="p-6 border-t border-slate-100 dark:border-slate-800">
      {{ $educations->links() }}
    </div>
    @endif
  </div>

</div>
@endsection