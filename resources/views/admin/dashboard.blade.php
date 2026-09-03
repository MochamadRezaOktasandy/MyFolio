@extends('layouts.admin')

@section('title', 'Dashboard Utama')
@section('page_title', 'Ringkasan Portofolio')

@section('content')
<div class="space-y-8">

  <!-- Metric Stat Cards -->
  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

    <!-- Total Projects -->
    <div
      class="p-6 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 shadow-sm flex items-center justify-between">
      <div>
        <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Total Proyek</p>
        <h3 class="text-3xl font-extrabold text-slate-900 dark:text-white mt-1">{{ $totalProjects }}</h3>
      </div>
      <div class="w-12 h-12 rounded-xl bg-emerald-500/10 text-emerald-500 flex items-center justify-center text-xl">
        🚀
      </div>
    </div>

    <!-- Total Skills -->
    <div
      class="p-6 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 shadow-sm flex items-center justify-between">
      <div>
        <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Total Keahlian</p>
        <h3 class="text-3xl font-extrabold text-slate-900 dark:text-white mt-1">{{ $totalSkills }}</h3>
      </div>
      <div class="w-12 h-12 rounded-xl bg-blue-500/10 text-blue-500 flex items-center justify-center text-xl">
        ⚡
      </div>
    </div>

    <!-- Total Sertifikat -->
    <div
      class="p-6 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 shadow-sm flex items-center justify-between">
      <div>
        <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Sertifikat</p>
        <h3 class="text-3xl font-extrabold text-slate-900 dark:text-white mt-1">{{ $totalCertificates }}</h3>
      </div>
      <div class="w-12 h-12 rounded-xl bg-purple-500/10 text-purple-500 flex items-center justify-center text-xl">
        📜
      </div>
    </div>

    <!-- Unread Messages -->
    <div
      class="p-6 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 shadow-sm flex items-center justify-between">
      <div>
        <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Pesan Baru</p>
        <h3 class="text-3xl font-extrabold text-emerald-600 dark:text-emerald-400 mt-1">{{ $unreadMessagesCount }}</h3>
      </div>
      <div class="w-12 h-12 rounded-xl bg-amber-500/10 text-amber-500 flex items-center justify-center text-xl">
        ✉️
      </div>
    </div>

  </div>

  <!-- Recent Messages Table -->
  <div
    class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl shadow-sm overflow-hidden">
    <div class="p-6 border-b border-slate-200 dark:border-slate-800 flex items-center justify-between">
      <div>
        <h2 class="font-bold text-lg text-slate-900 dark:text-white">Pesan Masuk Terbaru</h2>
        <p class="text-xs text-slate-400 mt-0.5">Pesan yang dikirim oleh pengunjung melalui formulir kontak.</p>
      </div>
    </div>

    <div class="overflow-x-auto">
      <table class="w-full text-left text-sm text-slate-600 dark:text-slate-300">
        <thead
          class="text-xs uppercase bg-slate-50 dark:bg-slate-800 text-slate-400 font-semibold border-b border-slate-200 dark:border-slate-800">
          <tr>
            <th class="px-6 py-4">Pengirim</th>
            <th class="px-6 py-4">Subjek</th>
            <th class="px-6 py-4">Tanggal</th>
            <th class="px-6 py-4">Status</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
          @forelse($recentMessages as $msg)
          <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/50 transition">
            <td class="px-6 py-4">
              <div class="font-semibold text-slate-900 dark:text-white">{{ $msg->name }}</div>
              <div class="text-xs text-slate-400">{{ $msg->email }}</div>
            </td>
            <td class="px-6 py-4 max-w-xs truncate">
              {{ $msg->subject }}
            </td>
            <td class="px-6 py-4 text-xs text-slate-400">
              {{ $msg->created_at->diffForHumans() }}
            </td>
            <td class="px-6 py-4">
              @if($msg->status === 'unread')
              <span
                class="px-2.5 py-1 text-[11px] font-bold rounded-full bg-emerald-100 text-emerald-800 dark:bg-emerald-950/60 dark:text-emerald-400">
                Baru
              </span>
              @else
              <span
                class="px-2.5 py-1 text-[11px] font-medium rounded-full bg-slate-100 text-slate-600 dark:bg-slate-800 dark:text-slate-400">
                Dibaca
              </span>
              @endif
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="4" class="px-6 py-8 text-center text-slate-400 text-xs">
              Belum ada pesan yang masuk.
            </td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

</div>
@endsection