@extends('layouts.app')

@section('title', 'Sertifikasi & Lisensi Profesional — Portfolio')
@section('meta_description', 'Kumpulan sertifikasi resmi, lisensi teknis, dan uji kompetensi perangkat lunak.')

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
        Sertifikasi & Lisensi
      </h1>
      <p class="text-lg text-slate-600 dark:text-slate-400">
        Bukti kompetensi teknis, kredensial industri, dan pencapaian profesional yang telah divalidasi.
      </p>
    </div>

    <!-- Grid Sertifikat -->
    @if($certificates->count() > 0)
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
      @foreach($certificates as $cert)
      <div
        class="group rounded-2xl overflow-hidden bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 flex flex-col shadow-sm hover:shadow-xl transition-all duration-300">
        <!-- Preview Gambar Sertifikat -->
        <div
          class="aspect-[4/3] w-full overflow-hidden bg-slate-100 dark:bg-slate-800 relative flex items-center justify-center">
          @if($cert->image)
          <img src="{{ asset('storage/' . $cert->image) }}" alt="{{ $cert->title }}"
            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
          @else
          <div class="flex flex-col items-center justify-center p-6 text-center text-slate-400">
            <span class="text-5xl mb-2">📜</span>
            <span class="text-xs font-medium uppercase tracking-wider text-slate-500">{{ $cert->issuer }}</span>
          </div>
          @endif
          <span
            class="absolute top-3 left-3 px-3 py-1 bg-slate-900/80 backdrop-blur-md text-white text-[11px] font-semibold rounded-full">
            {{ $cert->issuer }}
          </span>
        </div>

        <!-- Info Kredensial -->
        <div class="p-6 flex flex-col flex-grow">
          <h3 class="font-bold text-lg text-slate-900 dark:text-white mb-2 leading-snug">
            {{ $cert->title }}
          </h3>

          @if($cert->credential_id)
          <p class="font-mono text-xs text-slate-400 mb-4 truncate">
            ID: {{ $cert->credential_id }}
          </p>
          @endif

          @if($cert->description)
          <p class="text-slate-600 dark:text-slate-400 text-xs mb-6 flex-grow leading-relaxed">
            {{ $cert->description }}
          </p>
          @else
          <div class="flex-grow"></div>
          @endif

          <div class="pt-4 border-t border-slate-100 dark:border-slate-800 flex items-center justify-between text-xs">
            <span class="text-slate-400">
              Terbit: {{ \Carbon\Carbon::parse($cert->issue_date)->format('M Y') }}
            </span>

            @if($cert->credential_url)
            <a href="{{ $cert->credential_url }}" target="_blank" rel="noopener noreferrer"
              class="font-bold text-emerald-500 hover:text-emerald-600 flex items-center gap-1">
              Verifikasi Resmi &#8599;
            </a>
            @endif
          </div>
        </div>
      </div>
      @endforeach
    </div>

    <!-- Pagination -->
    <div class="mt-12">
      {{ $certificates->links() }}
    </div>
    @else
    <div class="text-center py-20 bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800">
      <span class="text-4xl block mb-3">📜</span>
      <p class="text-slate-400 text-base">Belum ada sertifikat yang dipublikasikan.</p>
    </div>
    @endif

  </div>
</div>
@endsection