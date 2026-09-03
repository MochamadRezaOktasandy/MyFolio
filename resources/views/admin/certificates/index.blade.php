@extends('layouts.admin')

@section('title', 'Manajemen Sertifikat')
@section('page_title', 'Sertifikat & Lisensi')

@section('content')
<div class="space-y-6">

  <!-- Header & Action Button -->
  <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
    <div>
      <h2 class="text-xl font-bold text-slate-900 dark:text-white">Daftar Sertifikasi & Kredensial</h2>
      <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Kelola lisensi profesional, sertifikat pelatihan, dan
        uji kompetensi Anda.</p>
    </div>
    <a href="{{ route('admin.certificates.create') }}"
      class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-slate-900 hover:bg-slate-800 dark:bg-brand-600 dark:hover:bg-brand-700 text-white font-semibold text-xs transition shadow-md self-start sm:self-auto">
      <span>+ Tambah Sertifikat Baru</span>
    </a>
  </div>

  <!-- Tabel Sertifikat -->
  <div
    class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
      <table class="w-full text-left text-sm text-slate-600 dark:text-slate-300">
        <thead
          class="text-xs uppercase bg-slate-50 dark:bg-slate-800 text-slate-400 font-semibold border-b border-slate-200 dark:border-slate-800">
          <tr>
            <th class="px-6 py-4">Sertifikat</th>
            <th class="px-6 py-4">Penerbit</th>
            <th class="px-6 py-4">ID / Kredensial</th>
            <th class="px-6 py-4">Masa Berlaku</th>
            <th class="px-6 py-4 text-right">Aksi</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
          @forelse($certificates as $cert)
          <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/50 transition">
            <!-- Sertifikat & Gambar -->
            <td class="px-6 py-4">
              <div class="flex items-center gap-3">
                @if($cert->image)
                <img src="{{ asset('storage/' . $cert->image) }}" alt="{{ $cert->title }}"
                  class="w-12 h-9 rounded-lg object-cover border border-slate-200 dark:border-slate-700 bg-slate-100 dark:bg-slate-800">
                @else
                <div
                  class="w-12 h-9 rounded-lg bg-purple-500/10 text-purple-500 flex items-center justify-center font-bold text-xs">
                  📜
                </div>
                @endif
                <div>
                  <div class="font-bold text-slate-900 dark:text-white flex items-center gap-2">
                    <span>{{ $cert->title }}</span>
                    @if($cert->is_featured)
                    <span
                      class="px-1.5 py-0.5 rounded text-[10px] bg-amber-100 text-amber-800 dark:bg-amber-950/60 dark:text-amber-400 font-semibold">Featured</span>
                    @endif
                  </div>
                  <div class="text-xs text-slate-400 truncate max-w-xs">{{ $cert->issuer }}</div>
                </div>
              </div>
            </td>

            <!-- Penerbit -->
            <td class="px-6 py-4 text-xs font-semibold text-slate-800 dark:text-slate-200">
              {{ $cert->issuer }}
            </td>

            <!-- ID & URL Kredensial -->
            <td class="px-6 py-4 text-xs">
              <div class="font-mono text-slate-600 dark:text-slate-400">{{ $cert->credential_id ?? '-' }}</div>
              @if($cert->credential_url)
              <a href="{{ $cert->credential_url }}" target="_blank"
                class="text-[11px] text-emerald-500 hover:underline mt-0.5 inline-block">
                Verifikasi Resmi &#8599;
              </a>
              @endif
            </td>

            <!-- Masa Berlaku -->
            <td class="px-6 py-4 text-xs">
              <span class="font-medium text-slate-700 dark:text-slate-300">
                Terbit: {{ \Carbon\Carbon::parse($cert->issue_date)->format('M Y') }}
              </span>
              <div class="text-slate-400 text-[11px] mt-0.5">
                @if($cert->expiration_date)
                Kedaluwarsa: {{ \Carbon\Carbon::parse($cert->expiration_date)->format('M Y') }}
                @else
                <span class="text-emerald-500 font-medium">Seumur Hidup</span>
                @endif
              </div>
            </td>

            <!-- Aksi -->
            <td class="px-6 py-4 text-right space-x-2">
              <a href="{{ route('admin.certificates.edit', $cert->id) }}"
                class="inline-flex items-center px-3 py-1.5 rounded-lg bg-slate-100 dark:bg-slate-800 hover:bg-slate-200 dark:hover:bg-slate-700 text-xs font-semibold text-slate-700 dark:text-slate-200 transition">
                Edit
              </a>
              <form action="{{ route('admin.certificates.destroy', $cert->id) }}" method="POST" class="inline"
                onsubmit="return confirm('Hapus sertifikat ini?')">
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
              Belum ada sertifikat yang dicatat.
            </td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    @if($certificates->hasPages())
    <div class="p-6 border-t border-slate-100 dark:border-slate-800">
      {{ $certificates->links() }}
    </div>
    @endif
  </div>

</div>
@endsection