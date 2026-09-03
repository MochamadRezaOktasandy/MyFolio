@extends('layouts.admin')

@section('title', 'Pesan Pengunjung')
@section('page_title', 'Kotak Pesan Masuk')

@section('content')
<div class="space-y-6">

  <!-- Header & Info -->
  <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
    <div>
      <h2 class="text-xl font-bold text-slate-900 dark:text-white">Daftar Pesan Pengunjung</h2>
      <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">
        Semua pesan yang dikirim oleh pengunjung atau calon klien melalui formulir kontak portofolio Anda.
      </p>
    </div>
  </div>

  <!-- Tabel Pesan Masuk -->
  <div
    class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
      <table class="w-full text-left text-sm text-slate-600 dark:text-slate-300">
        <thead
          class="text-xs uppercase bg-slate-50 dark:bg-slate-800 text-slate-400 font-semibold border-b border-slate-200 dark:border-slate-800">
          <tr>
            <th class="px-6 py-4">Status</th>
            <th class="px-6 py-4">Pengirim</th>
            <th class="px-6 py-4">Subjek</th>
            <th class="px-6 py-4">Waktu</th>
            <th class="px-6 py-4 text-right">Aksi</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
          @forelse($messages as $msg)
          <tr
            class="hover:bg-slate-50 dark:hover:bg-slate-800/50 transition {{ $msg->status === 'unread' ? 'font-semibold bg-emerald-500/5' : '' }}">
            <!-- Status Badge -->
            <td class="px-6 py-4">
              @if($msg->status === 'unread')
              <span
                class="inline-flex items-center gap-1.5 px-2.5 py-1 text-[11px] font-bold rounded-full bg-emerald-100 text-emerald-800 dark:bg-emerald-950/60 dark:text-emerald-400">
                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                Baru
              </span>
              @else
              <span
                class="inline-flex items-center px-2.5 py-1 text-[11px] font-medium rounded-full bg-slate-100 text-slate-600 dark:bg-slate-800 dark:text-slate-400">
                Dibaca
              </span>
              @endif
            </td>

            <!-- Info Pengirim -->
            <td class="px-6 py-4">
              <div class="text-slate-900 dark:text-white">{{ $msg->name }}</div>
              <div class="text-xs text-slate-400 font-normal">{{ $msg->email }}</div>
            </td>

            <!-- Subjek -->
            <td class="px-6 py-4 max-w-xs truncate">
              {{ $msg->subject }}
            </td>

            <!-- Waktu Kirim -->
            <td class="px-6 py-4 text-xs text-slate-400 font-normal">
              {{ $msg->created_at->diffForHumans() }}
            </td>

            <!-- Tombol Aksi -->
            <td class="px-6 py-4 text-right space-x-2">
              <a href="{{ route('admin.messages.show', $msg->id) }}"
                class="inline-flex items-center px-3 py-1.5 rounded-lg bg-slate-100 dark:bg-slate-800 hover:bg-slate-200 dark:hover:bg-slate-700 text-xs font-semibold text-slate-700 dark:text-slate-200 transition">
                Baca
              </a>

              <form action="{{ route('admin.messages.destroy', $msg->id) }}" method="POST" class="inline"
                onsubmit="return confirm('Apakah Anda yakin ingin menghapus pesan ini?')">
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
              Belum ada pesan yang masuk.
            </td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <!-- Pagination -->
    @if($messages->hasPages())
    <div class="p-6 border-t border-slate-100 dark:border-slate-800">
      {{ $messages->links() }}
    </div>
    @endif
  </div>

</div>
@endsection